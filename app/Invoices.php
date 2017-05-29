<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model{
    protected $fillable = ['invoice_name','total_items','subtotal','tax','total'];

    public function items(){

      return $this->hasMany(Items::class);
      
    }
}
