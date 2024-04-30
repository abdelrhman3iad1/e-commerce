@extends('Admin.layout')
@section('title')
    All Products
@endsection
@section('content')
@include('success')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Image</th>
        <th scope="col">Aciton</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $product )
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
        <td>{{$product->name}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->quantity}}</td>
        <td><img src="{{asset("storage/$product->image")}}" width="100px" alt="" srcset=""></td>
        <td>
        
          <a class="btn btn-success" href="{{url("products/edit/$product->id")}}" >Edit</a>
          
          
            <h1>
                
                <form action="{{url("products/$product->id")}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
              </form>
              <a class="btn btn-success" href="{{url("products/show/$product->id")}}" >Show</a>
            </h1>
        </td>
    </tr>
    @endforeach

    </tbody>
  </table>

  @endsection