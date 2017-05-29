<?php 

Route::get('/','InvoicesController@index');
Route::get('/{items}','ItemsController@create');

Route::post('items','InvoicesController@store');
Route::put('update/{update}','InvoicesController@update');
Route::get('invoices/{invoices}','InvoicesController@edit');

Route::delete('delete/{invoices}','InvoicesController@destroy');

Route::post('/search','InvoicesController@search');
Route::delete('deletes/{searchs}','InvoicesController@destroy');
Route::get('edit/{searchs}','InvoicesController@edit');

Route::get('pdf/{invoice}',array('as'=>'htmltopdfview','uses'=>'InvoicesController@pdf'));
Route::get('searchpdf/{search}',array('as'=>'htmltopdfview','uses'=>'InvoicesController@pdf'));