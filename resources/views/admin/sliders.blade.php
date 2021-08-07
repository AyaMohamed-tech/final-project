
@extends('layouts.appadmin')
@section('title')
sliders
@endsection

@section('content')         




<div class="card">
            <div class="card-body">
              <h4 class="card-title">sliders</h4>
              @if(Session::has('status'))
                      <div class="alert alert-success">
                            {{Session::get('status')}}
                      </div>
                  @endif
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Image</th>
                            <th>Description 1</th>
                            <th>Description 2</th>
                            <th> Status</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $sliders as $slider)
                        <tr>
                            <td>{{$slider->id}}</td>
                            <td><img src="/storage/slider_images/.{{$slider->slider_image}}"></td>
                            <td>{{$slider->description1}}</td>
                            <td>{{$slider->description2}}</td>

                            @if($slider->status ==1)
                                <td>
                                  <label class="badge badge-success" >Activated</label>
                                </td>
                             @else
                             <td>
                                  <label class="badge badge-danger" >Unactivated</label>
                                </td>
                             @endif   
</td>
                               <td>
                              <button class="btn btn-outline-primary" onclick="window.location='{{url('/edit_slider/'.$slider->id)}}' ">Edit</button>
                              <button class="btn btn-outline-danger" onclick="window.location='{{url('/delete_slider/'.$slider->id)}}' ">Delete</button>
                              @if($slider->status ==1)
                               <button class="btn btn-outline-warning" onclick="window.location='{{url('/unactivate_slider/'.$slider->id)}}' ">Unactivated</button>
                               @else
                               <button class="btn btn-outline-success" onclick="window.location='{{url('/activate_slider/'.$slider->id)}}' ">Activated</button>
                               @endif
                            </td>
                        </tr>
                       @endforeach
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          

@endsection



@section('scripts')
<script src="{{asset('frontend/js/data-table.js')}}"></script>
@endsection


