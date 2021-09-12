@extends('layouts.app')

@section('title')
search
@endsection

@section('content')

<nav class="navbar navbar-light bg-light">
	<a class="navbar-brand">Find your product</a>
	<form class="form-inline" action="{{route('search')}}">
		<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
		 name="query">
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form>
</nav>


<!-- <div class ="container my-5">
  @forelse($products as $item)
  <div class="card border-success mb-3" style="max-width: 18rem;">
      <div class="card-body text-success">
        <img src="{{asset('storage/product_images/' . $item->product_image)}}" alt="">
        <h5 class="card-title">PRODUCT NAME</h5>
        {{$item->product_name}}
        <h5 class="card-title">PRODUCT PRICE</h5>
        {{$item->product_price}}
        <h5 class="card-title">PRODUCT CATEGORY</h5>
        {{$item->product_category}}
      
      </div>
    </div>
  @empty
  <span>0 Search results</span>
  @endforelse

  
</div> -->


<div class ="container my-5">
<div class="row">
  @forelse($products as $item)
  <div class="col-md-4 col-lg-3 col-12">
    <div class="card edit-margin-card">
      <img src="{{asset('storage/product_images/' . $item->product_image)}}" class="card-img-top" alt="...">
      <div class="card-body">
      <p class="card-title"><b>Name</b> :  {{$item->product_name}}</p>     
      <p class="card-title"><b>Price</b> :  {{$item->product_price}}</p> 
      <p class="card-title"><b>Category</b> : {{$item->product_category}}</p>    
    </div>
</div>
</div>

@empty
  <span>0 Search results</span>
  @endforelse
</div>
</div>




@endsection