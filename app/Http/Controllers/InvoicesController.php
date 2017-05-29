<?php
namespace App\Http\Controllers;
use App\Invoices;
use App\Items;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InvoicesController extends Controller
{

    public function index() {

      $invoice =Invoices::paginate(6);

      return view('index',['invoice'=>$invoice]);
    }
    //store the request data in database  
    public function store(Request $request){
      $this->validate(request(),[
         'invoice_name'=>'required',         
         'total' => 'required',
         'subtotal' =>'required',
         'tax' => 'required'
      ]);
      $items_length =$request->get('items_name');
      
      $count = count($items_length);

      $invoices = new Invoices;
      $invoices->invoice_name=$request->get('invoice_name');
      $invoices->total_items= $count;
      $invoices->subtotal=$request->get('subtotal');
      $invoices->tax=$request->get('tax');
      $invoices->total=$request->get('total');
      $invoices->save();

      $id = $invoices->id;
      
      $items = new Items;

      $items = array();

      for($i=0; $i<count($items_length);$i++){

      $items[$i]['items_name']=$request->get('items_name')[$i];
      $items[$i]['no_items']=$request->get('no_items')[$i];
      $items[$i]['prices']=$request->get('prices')[$i];
      $items[$i]['items_prices']=$request->get('items_prices')[$i];
      $items[$i]['invoices_id'] =$id;
    
      }
      Items::insert($items);

      return redirect('/');
    }
    //edit data 
    public function edit($id){
      $invoices = Invoices::where('id',$id)->first();
      $items = Items::where('invoices_id', $id)->get();
      return view('edit',['items'=>$items,'invoices'=>$invoices]);
    }
    //update data from database
    public function update(Request $request,$id){
      $this->validate(request(),[
         'invoice_name'=>'required',         
         'total' => 'required',
         'subtotal' =>'required',
         'tax' => 'required'
      ]);

      $invoices = Invoices::find($id);
      $items_length =$request->get('items_name');
      // return($items_length);
      $count = count($items_length);

      $invoices->invoice_name=$request->get('invoice_name');
      $invoices->total_items= $count;
      $invoices->subtotal=$request->get('subtotal');
      $invoices->tax=$request->get('tax');
      $invoices->total=$request->get('total');

      $invoices->save();

      $id = $invoices->id;
      Items::where('invoices_id',$id)->delete();
      $items = array();

      for($i=0; $i<count($items_length);$i++){
      $items[$i]['items_name']=$request->get('items_name')[$i];
      $items[$i]['no_items']=$request->get('no_items')[$i];
      $items[$i]['prices']=$request->get('prices')[$i];
      $items[$i]['items_prices']=$request->get('items_prices')[$i];
      $items[$i]['invoices_id'] =$id;
      }
      Items::insert($items);

      return redirect('/');    
    }
    //search by invoice name
    public function search(Request $request){

      $searchs = $request->get('search');

      $search= Invoices::where('invoice_name',  'LIKE', '%' . $searchs . '%')->get();
      return view('search',compact('search'));
    }
    //retrieve pdf
    public function pdf($id){

      $invoice = Invoices::where('id',$id)->get();
      view()->share('invoices',$invoice);
      $pdf = PDF::loadView('pdf');
      return $pdf->download('invoices.pdf');
    }
    //delete data from database
    public function destroy($id){
      Invoices::where('id',$id)->delete();
      Items::where('invoices_id',$id)->delete();
      return redirect('/');
    }   
}
