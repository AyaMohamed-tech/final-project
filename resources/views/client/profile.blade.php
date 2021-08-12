@extends('layouts.app')

@section('title')
profile
@endsection

@section('content')

    <div class="person">
      <div class="container">
          <div class="card mb-3 px-0">
              <div class="row g-0 ">
                  <div class="col-md-6">
                      <img src="frontend/images/welcome.jpg" class="img-fluid d-block" alt="... " >
                  </div>
                  <div class="col-md-6 ">
                      <div class="card-body ">
                          <br><br><br>
                          <p class="h2 ">MY PERSONAL DATA :</p><br>
                          <p class=" ">full name : <br> email adress : <br> discription : </p>
                          <!-- <p class="small ">Mollit anim laborum duis adseu dolor iuyn foluprcate velit<br>Mollit anim laborum duis adseu dolor iuyn foluprcate velit<br> ess cillum dolore egru lofrre dsu.</p> -->
                        </div>

                    </div>
          </div>
      </div>
  </div>
  </div>


    <div class="container">
        <div class="col-4 mt-5">
          <h4>MY favourites :</h4>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">

            <div class="col-md-4">
                <div class="card p-md-5 mt-3">
                    <div class="card-body">
                    <img src="frontend/images/product-3.jpg" class="img-fluid d-block" alt="... " >
                        <h6 class="card-subtitle mb-2 text-muted">product name</h6>
                        <h6 class="card-subtitle mb-2 text-muted">product price</h6>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->

                    </div>
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="card p-md-5 mt-3">
                    <div class="card-body">
                    <img src="frontend/images/product-4.jpg" class="img-fluid d-block" alt="... " >
                        <h6 class="card-subtitle mb-2 text-muted">product name</h6>
                        <h6 class="card-subtitle mb-2 text-muted">product price</h6>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->

                    </div>
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="card p-md-5 mt-3">
                    <div class="card-body">
                    <img src="frontend/images/product-5.jpg" class="img-fluid d-block" alt="... " >
                        <h6 class="card-subtitle mb-2 text-muted">product name</h6>
                        <h6 class="card-subtitle mb-2 text-muted">product price</h6>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->

                    </div>
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="card p-md-5 mt-3">
                    <div class="card-body">
                    <img src="frontend/images/product-7.jpg" class="img-fluid d-block" alt="... " >
                        <h6 class="card-subtitle mb-2 text-muted">product name</h6>
                        <h6 class="card-subtitle mb-2 text-muted">product price</h6>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->

                    </div>
                </div>
            </div>

        </div>

<div class="card mt-5 mb-5">
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
                                <th>Payment_id</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection