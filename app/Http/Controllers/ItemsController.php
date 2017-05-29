<?php

namespace App\Http\Controllers;
use App\Items;
use App\Invoices;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
	 public function create() {
    	return view('item');
    }  
}
