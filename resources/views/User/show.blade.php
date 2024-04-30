<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$product->name}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg bg-body-tertiary"><!--navbar navbar-expand-lg bg-body-tertiary-->
        <div class="container-fluid">
          <a class="navbar-brand" href="{{url("")}}">Home</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown link
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="card"  style="position: absolute;
      top: 12%;
      left: 33%;
    width: 35rem;">
        <img src="{{asset("storage/$product->image")}}" class="card-img-top" alt="...">
        <div class="card-body">

          <h2 class="card-text">{{$product->name}}</h2>
          <p class="card-text">{{$product->description}}</p>
          <p class="card-text">Price : ${{$product->price}}</p>
          <p class="card-text">{{$product->quantity}}</p>
          <form action="{{url("addToCart/$product->id")}}" method="post">
            @csrf
            <input type="number" name="quantity" class="w-25">
            <button type="submit" class="mt-0.5 btn btn-info">Submit</button>
            </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>


{{--@extends('User.layout')
@section('title')
    E-commerce
@endsection
@section('content')
<div class="latest-products">
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <div class="section-heading">
          <h2>Latest Products</h2>
          <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
      
          
      <div class="col-md-4">
        <div class="product-item">
          <a href="{{url("products/show/$product->id")}}"><img src="{{asset("storage/$product->image")}}" alt=""></a>
          <div class="down-content">
            <a href="{{url("products/show/$product->id")}}"><h4>{{$product->name}}</h4></a>
            <h6>${{$product->price}}</h6>
            <p>{{$product->description}}</p>
            
            
          </div>
        </div>
      </div>
      
      
    </div>
  </div>
</div>
@endsection>--}}