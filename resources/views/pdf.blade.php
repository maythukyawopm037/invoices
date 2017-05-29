@extends('layouts.layout')
@section('content')	
@foreach($invoices as $invoice)

{{$invoice->invoice_name}}

@endforeach
<table id="itemtable" class="table">
					<thead>
					<tr>
					    <td>Item Name</td>
						<td>#of items</td>
						<td>Price</td>
						<td>Total  </td>
					</tr>
					</thead>
					
	@foreach($invoice->items as $item)
	<tr>
		<td>{{$item->items_name}}</td>
		<td>{{$item->no_items}}</td>
		<td>{{$item->prices}}</td>
		<td>{{$item->items_prices}}</td>
	</tr>
	@endforeach
	@foreach($invoices as $invoice)
		<div style="margin-left:600px;">
		Subtotal<br>
			<input type="text" value="{{$invoice->subtotal}}"><br>
		Tax<br>
	        <input type="text" value="{{$invoice->tax}}"><br>
	    Total<br>
			<input type="text" value="{{$invoice->total}}"><br>
		</div>	
	@endforeach
</table>
@endsection

