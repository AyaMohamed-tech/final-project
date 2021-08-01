@extends('layouts.appadmin')
@section('title')
  Add product
@endsection
@section('content')
<div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create product</h4>
                  {!!Form::open(['action' => 'AdminController@addproduct', 'class' => 'cmxform','method' => 'POST','id' => 'commentForm'])!!}
                  {{csrf_field()}}
                      <div class="form-group">
                        {{Form::label('','Product Name',['for' => 'cname'])}}
                        {{Form::text('product_name','',['class' => 'form-control','minlength' => '2'])}}
                       
                      </div>

                      <div class="form-group">
                      {{Form::label('','Product Price',['for' => 'cname'])}}
                      {{Form::number('product_price','',['class' => 'form-control'])}}
                      
                      </div>
                      <div class="form-group">
                      {{Form::label('','Product category',['for' => 'cname'])}}
                      {{Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['placeholder' => 'Select category','class' => 'form-control'])}}
                      </div>
                      <div class="form-group">
                      {{Form::label('','Product image',['for' => 'cname'])}}
                      {{Form::file('product_image',['class' => 'form-control'])}} 
                      </div>
                      <div class="form-group">
                      {{Form::label('','Product status',['for' => 'cname'])}}
                      {{Form::checkbox('product_status','','true',['class' => 'form-control'])}}
                      
                      </div>

                      {{Form::submit('Save',['class' => 'btn btn-primary'])}}
                  {!!Form::close()!!}
                </div>
              </div>
            </div>
          </div>
@endsection

@section('scripts')
  <script src="{{asset('backend/js/bt-maxLength.js')}}"></script>
@endsection