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
                <button type="button" class="button is-danger">
                  <a href="newitems">New Items</a>
                </button>
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
                @foreach($search as $searchs)
            	        <tr>
                            <td><a href="edit/{{$searchs->id}}">           
                            {{$searchs->invoice_name}}</a>
                            </td>
                            <td>{{$searchs->total_items}}</td>
                            <td>{{$searchs->total}}</td>
                            <form method="post" action="<?= URL::to('deletes')?>/{{$searchs->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}    
                                <td> <button class="btn btn-danger">
                                   <a href="searchpdf/{{$searchs->id}}">PDF</a></button>
                                    <button type="submit" class="btn btn-danger">
                                    Remove</button>
                                </td>
                            </form>
                        </tr>
            	@endforeach
                {{ csrf_field() }}
            </tr>
        </table>
        <a type="button" class="button is-primary" href="<?= URL::to('/')?>">Back</a>
    </div>
@endsection