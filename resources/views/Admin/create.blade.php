@extends('Admin.layout')
@section('title')
    Add Product
@endsection
@section('content')
@include('errors')
@include('success')
<form method="POST" action="{{route('store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="name">Product Name</label>
      <input type="text" name="name" class="form-control text-white" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
    </div>

    <div class="form-group">
        <label for="description">Product Description</label>
        <textarea type="text" name="description" class="form-control text-white" id="description" aria-describedby="emailHelp" placeholder="Enter Description"></textarea>
      </div>

      <div class="form-group">
        <label for="price">Product Price</label>
        <input type="number" name="price" class="form-control text-white" id="price" aria-describedby="emailHelp" placeholder="Enter Price">
      </div>

      <div class="form-group">
        <label for="quantity">Product Quantity</label>
        <input type="text" name="quantity" class="form-control text-white" id="quantity" aria-describedby="emailHelp" placeholder="Enter Quantity">
      </div>

      <div class="form-group">
        <label for="category_id">Category Name</label>
        <div>
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>    
            @endforeach
        </select>
        </div>
      </div>

      <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" name="image" class="form-control text-white" id="image" aria-describedby="emailHelp" placeholder="Enter email">
      </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection