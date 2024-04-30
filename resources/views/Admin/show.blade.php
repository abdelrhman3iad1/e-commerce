@extends('Admin.layout')
@section('title')
    Show Product
@endsection
@section('content')
@include('errors')
@include('success')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Product</h4>
          <div class="row">
            <div class="col-md-5">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      
                      <td>Name :</td>
                      <td class="text-right">  {{$product->name}} </td>
                      
                    </tr>
                    <tr>
                      
                      <td>Price :</td>
                      <td class="text-right">  {{$product->price}} </td>
                      
                    </tr>
                    <tr>
                      
                      <td>Quantity :</td>
                      <td class="text-right">  {{$product->quantity}} </td>
                      
                    </tr>
                    <tr>
                      
                      <td>Created At :</td>
                      <td class="text-right">  {{$product->created_at}} </td>
                      
                    </tr>
                    
                    <tr>
                      
                      <td>Actions :</td>
                      <td class="text-right"> 
                      <h6>
                        <a class="btn btn-success" href="{{url("products/edit/$product->id")}}" >Edit</a>
                      </h6>
                        <form action="{{url("products/$product->id")}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                      
                      </td>
                      
                    </tr>
                    
                    </tbody>
                </table>
              </div>
            </div>
            @if ($product->image)
            <div class="col-md-7">
              <img src="{{asset("storage/$product->image")}}" width="750px" alt="" srcset="">
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>

@endsection