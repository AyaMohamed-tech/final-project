@extends('layouts.appadmin')

@section('content')
<div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit category</h4>
                  {!!Form::open(['action' => 'CategoryController@updatecategory', 'class' => 'cmxform','method' => 'POST','id' => 'commentForm'])!!}
                  {{csrf_field()}}
                  
                      <div class="form-group">
                        {{Form::hidden('id', $category->id)}}
                        {{Form::label('','Product Category',['for' => 'cname'])}}
                        {{Form::text('category_name', $category->category_name,['class' => 'form-control','minlength' => '2'])}}
                       </div>

                        <div class="form-group">
                        {{Form::submit('Update',['class' => 'btn btn-primary'])}}
                        </div>

                  {!!Form::close()!!}
                </div>
              </div>
            </div>
          </div>
@endsection

@section('scripts')
  <script src="{{asset('backend/js/bt-maxLength.js')}}"></script>
@endsection