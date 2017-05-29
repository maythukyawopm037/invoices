<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Items extends Model{

    protected $fillable = ['invoices_id','items_name','no_items','prices','items_prices'];

    public function invoices(){
      return $this->belongsTo(Invoices::class);
    }
}
