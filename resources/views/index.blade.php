@extends('layouts.layout')
@section('content')
    <title>invoices</title>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h1 style="font-size:50px;">Invoices</h1>
                    </div>
                    <div class="pull-right">
                    <button type="button" class="button is-danger" title="add invoices">
                      <a href="newitems">+Add Invoices</a>
                    </button>
                    <form method="post" action="<?= URL::to('search')?>">
                        {{ csrf_field() }}  
                       <input type="text" name="search" style="margin-left:700px;">
                       <button class="btn btn-danger" title="search">Search</button>
                    </form>
                    </div>
                </div>
            </div>             
            <table class="table table-bordered">
                <tr>
                    <th><abbr title="Played">Invoice Name</abbr></th>
                    <th><abbr title="Won">#of Items</abbr></th>
                    <th><abbr title="Drawn">Total</abbr></th>
                    <th><abbr title="Lost"></abbr></th>
                </tr>
                <tr v-for="item in items">
                    @foreach($invoice as $invoices)
                        <tr>
                                <td>
                                    <a href="invoices/{{$invoices->id}}">
                                    {{$invoices->invoice_name}}</a>
                                </td>
                                <td>{{$invoices->total_items}}</td>
                                <td>{{$invoices->total}}</td>
                                <form method="post" action="<?= URL::to('delete')?>/{{$invoices->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE')}}    
                                    <td> <button class="btn btn-danger">
                                        <a href="pdf/{{$invoices->id}}">PDF</a></button>
                                        <button type="submit" class="btn btn-danger">
                                        Remove</button>
                                    </td>
                                </form>
                        </tr>
                    @endforeach
                </tr>         
            </table>
            <div style="width:150px;margin-left:800px;">
                {{ $invoice->links() }} 
            </div> 
       </div>
@endsection