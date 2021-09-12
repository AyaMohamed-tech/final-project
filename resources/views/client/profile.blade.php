@extends('layouts.app')

@section('title')
    profile
@endsection

@section('content')
 
<div class="container mt-5  " >

<div class="card " >
  <h5 class="card-header">PERSONAL DATA :</h5>
  <div class="card-body">
    <!-- <h5 class="card-title">PERSONAL DATA</h5> -->
  
    <p class="card-text">   full name :{{ auth()->user()->name }} <br> email adress :{{ auth()->user()->email }} </p>  
    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
  </div>
</div>
</div>




    <!-- <div class="container">
        <div class="col-4 mt-5">
            <h4>MY FAVOURITES :</h4>
        </div>
    </div> -->

    <!-- <div class="container mt-4"> -->
        <!-- <div class="row">

            <div class="col-md-4">
                <div class="card p-md-5 mt-3">
                    <div class="card-body">
                        <img src="frontend/images/product-3.jpg" class="img-fluid d-block" alt="... ">
                        <h6 class="card-subtitle mb-2 text-muted">product name</h6>
                        <h6 class="card-subtitle mb-2 text-muted">product price</h6>

                    </div>
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="card p-md-5 mt-3">
                    <div class="card-body">
                        <img src="frontend/images/product-4.jpg" class="img-fluid d-block" alt="... ">
                        <h6 class="card-subtitle mb-2 text-muted">product name</h6>
                        <h6 class="card-subtitle mb-2 text-muted">product price</h6>

                    </div>
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="card p-md-5 mt-3">
                    <div class="card-body">
                        <img src="frontend/images/product-5.jpg" class="img-fluid d-block" alt="... ">
                        <h6 class="card-subtitle mb-2 text-muted">product name</h6>
                        <h6 class="card-subtitle mb-2 text-muted">product price</h6>

                    </div>
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="card p-md-5 mt-3">
                    <div class="card-body">
                        <img src="frontend/images/product-7.jpg" class="img-fluid d-block" alt="... ">
                        <h6 class="card-subtitle mb-2 text-muted">product name</h6>
                        <h6 class="card-subtitle mb-2 text-muted">product price</h6>

                    </div>
                </div>
            </div>

        </div> -->

        <div class="container">

        <div class="card mt-5 mb-5">
            {{ Form::hidden('', $increment = 1) }}
            <div class="card-body">
                <h4 class="card-title">MY ORDERS :</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Client Name</th>
                                        <th>Address</th>
                                        <th>Cart</th>
                                        <!-- <th>Payment_id</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $increment }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>
                                                @foreach ($order->cart->items as $item)
                                                    {{ $item['product_name'] . ',' }}
                                                @endforeach
                                            </td>
                                            <!-- <td>{{ $order->payment_id }}</td> -->
                                            <td>
                                                <!-- Banned -->
                                                @if($order->status == 0)
                                                <span>Banned</span>
                                                <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <!-- In progress -->
                                                @elseif($order->status == 1)
                                                <span>In progress</span>
                                                <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <!-- shipped -->
                                                @elseif($order->status == 2) 
                                                <a href="{{url('/orders/' . $order->id . '/delivered')}}">Delivered</a>
                                                <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                @else 
                                                <!-- Order delivered successfully -->
                                                <span>Delivered Successfully!</span>
                                                <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>

                                                @endif

                                                
  



                                            </td>
                                        </tr>
                                        {{ Form::hidden('', $increment = $increment + 1) }}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    </div>
    @endsection
