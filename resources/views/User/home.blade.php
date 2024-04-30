@extends('User.layout')
@section('title')
    E-commerce
@endsection
@section('content')
<div class="latest-products">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          @include('User.error')
          @include('User.success')
          <h2>Latest Products</h2>
          <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
          <form action="{{url("search")}}" method="get">
          <input type="text" name="key" value="{{old("key")}}" class="form-control">
          <button type="submit" class="btn btn-info mt-2">Search</button>
        </form>
        </div>
      </div>
      @foreach ($products as $product)
          
      <div class="col-md-4">
        <div class="product-item">
          <a href="{{url("show/$product->id")}}"><img src="{{asset("storage/$product->image")}}" alt=""></a>
          <div class="down-content">
            <a href="{{url("
            
            show/$product->id")}}"><h4>{{$product->name}}</h4></a>
            <h6>${{$product->price}}</h6>
            <p>{{$product->description}}</p>
            <p>Availble Quantity : {{$product->quantity}}</p>
            <form action="{{url("addToCart/$product->id")}}" method="post">
            @csrf
            <select name="quantity" class="w-25">
              @for ($i=1;$i<= $product->quantity;$i++)
              <option value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
            {{--<input type="number"  min="1" name="quantity" class="w-25">--}}
            <button type="submit" class="mt-0.5 btn btn-info">Submit</button>
            </form>
            
          </div>
        </div>
      </div>
      @endforeach
      
    </div>
  </div>
</div>
@endsection