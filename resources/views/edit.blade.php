@extends('layouts.layout')
@section('content')
<title>item</title>		
	<body>
		<form class="form-group" method="POST" action="<?= URL::to('update')?>/{{$invoices->id}}">
			{{ csrf_field() }}
			{{ method_field('PUT')}}	
			<div class="container">		
			<label><b>Invoice Name</b></label>
			<input type="text" name="invoice_name" value="{{$invoices->invoice_name}}" />
			<table id="itemtable" class="table">
					<thead>
						<tr>
						    <td><b>Item Name</b></td>
							<td><b>#of items</b></td>
							<td><b>Price</b></td>
							<td><b>Total</b></td>
							<td><b>Action</b></td>
						</tr>
					</thead>
					<tbody class="line_item" id="row0">
							<table id="tbl">
							@foreach($items as $item)						
								<tr>
									<td><input type="text" class="itemname input" name="items_name[]" id="items_name" value="{{$item->items_name}}" required/></td>
									<td><input type="text" class="no_items input" name="no_items[]" id="no_items" value="{{$item->no_items}}" required/></td> 
									<td><input type="text" class="price input" name="prices[]" id="prices" value="{{$item->prices}}" required/></td>
									<td><input type="text" class="itemprice input" name="items_prices[]" id="items_prices" value="{{$item->items_prices}}" readonly="true"  required/></td>
									<td><input type="button" class="input" value="Delete" id="delete" onclick="SomeDeleteRowFunction(this)"/></td>          
								</tr>
							@endforeach
							</table>
							<input type="button" class="button add_another" value="Add another line"/>
					
							<div style="margin-left:1000px;">
								<label>Sub Total</label>
								<input type="text" name="subtotal" id="subtotal" class="subtotal input is-primary" value="{{$invoices->subtotal}}" readonly="true">
								<label>Tax</label>
								<input type="text" name="tax" id="tax" class="tax input is-primary" value="{{$invoices->tax}}">
								<label>Total</label>
								<input type="text" name="total" id="total" class="total input is-primary" value="{{$invoices->total}}" readonly="true">
							</div>	
							<div class="form-group">
							<button class="button is-primary" title="update"> Update </button>
									@include('layouts.errors')
							<a type="button" class="button is-primary" href="<?= URL::to('/')?>" title="back">Back</a>
							</div>		
			  			</tbody>
		  	</table>
		  	</div>
		</form>	
	</body>

<script type="text/javascript">
	$('document').ready(function() {
			$('.add_another').click(function() {
			
			$("#tbl").append('<tr><td><input type="text" class="itemname input" name="items_name[]" id="items_name" /></td><td><input type="text" class="no_items input" name="no_items[]" id="no_items" value=""/></td><td><input type="text" class="price input" name="prices[]" id="prices" value="" /></td><td><input type="text" class="itemprice input" name="items_prices[]" id="items_prices" value="" /></td><td><input type="button" class="input" value="Delete" id="delete" onclick="SomeDeleteRowFunction(this)"/></td></tr>');
		});
	})
	window.SomeDeleteRowFunction = function SomeDeleteRowFunction(o) {
		var p=o.parentNode.parentNode;
		p.parentNode.removeChild(p);
		subtotal();
		tax();
	}
	$('body').delegate('.no_items,.price,.tax','keyup',function(){
			var x=$(this).parent().parent();
			var textValue1 = x.find('.no_items').val();
			var textValue2 =x.find('.price').val();
			calc =textValue1*textValue2;
			x.find('.itemprice').val(calc);
			subtotal();
			tax();
			    
	});
	function subtotal(){
		var sum = 0;
			$('.itemprice').each(function(){
				sum += +$(this).val();                           
			});                       
			$('#subtotal').val(sum);  

	}
	function tax(){
		$(document).ready(function(){
			var a =parseInt($("#subtotal").val());
			var b =parseInt($("#tax").val());
			var totals = (a/100 * b)+a;
			$('#total').val(totals);
			
		});
	}
</script>
@endsection
