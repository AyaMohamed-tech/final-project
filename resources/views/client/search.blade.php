@extends('layouts.app')

@section('title')
search
@endsection

@section('content')

<!-- <div class ="container">
<div class="col-sm-4">
    <div class="trending-wr apper">
        <h4>result for search</h4>
        
        @foreach($products as $item)
        <div class ="searched-item">
            <div class="">
            <h5>product name </h5>    {{$item->product_name}}<br>
            <h5>product price </h5> {{$item->product_price}}<br>
            </div>  
        </div>

        @endforeach
     </div>
</div>
</div><br> -->

<nav class="navbar navbar-light bg-light">
	<a class="navbar-brand">Find your product</a>
	<form class="form-inline" action="{{route('search')}}">
		<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
		 name="query">
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form>
</nav>


<div class ="container my-5">
  @forelse($products as $item)
  <div class="card border-success mb-3" style="max-width: 18rem;">
    <!-- <div class="card-header bg-transparent border-success">product details</div> -->
      <div class="card-body text-success">
      <!-- <h5> product details</h5> -->
        <img src="{{asset('storage/product_images/' . $item->product_image)}}" alt="">
        <h5 class="card-title">PRODUCT NAME</h5>
        {{$item->product_name}}
        <h5 class="card-title">PRODUCT PRICE</h5>
        {{$item->product_price}}
        <h5 class="card-title">PRODUCT CATEGORY</h5>
        {{$item->product_category}}
      
      </div>
    </div>
  <!-- </div> -->
  @empty
  <span>0 Search results</span>
  @endforelse

  
</div>


@endsection