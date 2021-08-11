<!-- ======= Contact Section ======= -->

@extends('layouts.app')
@section('title')
Contact US
@endsection
@section('content')
<section id="contact" class="contact section-bg">
      <div class="container-fluid">

        <div class="text-center mt-3 ">
          <h2>Contact</h2>
          <h3>Get In Touch With <span style="color: red;">Us</span></h3>
                 @if(Session::has('status'))
                      <div class="alert alert-success">
                            {{Session::get('status')}}
                      </div>
                  @endif
          <div data-aos="fade-up ">
        <iframe class="mt-3" style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
      </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-xl-10">
            <div class="row mt-3">

              <div class="col-lg-6">

                <div class="row justify-content-center">

                  <div class="col-md-6 info d-flex flex-column align-items-stretch">
                    <i class="bx bx-map"></i>
                    <h4>Address</h4>
                    <p>Egypt<br>Mansoura</p>
                  </div>
                  <div class="col-md-6 info d-flex flex-column align-items-stretch">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                    <h4>Call Us</h4>
                    <p>+02 100 3230 950<br>+02 100 3230 950</p>
                  </div>
                  <div class="col-md-6 info d-flex flex-column align-items-stretch">
                    <i class="bx bx-envelope"></i>
                    <h4>Email Us</h4>
                    <p>kholod.o@yahoo.com<br>app@yahoo.com</p>
                  </div>
                  <div class="col-md-6 info d-flex flex-column align-items-stretch">
                    <i class="bx bx-time-five"></i>
                    <h4>Working Hours</h4>
                    <p>Mon - Fri: 9AM to 5PM<br>Sunday: 9AM to 1PM</p>
                  </div>

                </div>

              </div>

              <div class="col-lg-6">
                <!-- <form action="{{url('/datacontact')}}" method="post" role="form" class="php-email-form"> -->
                {!!Form::open(['action' => 'ClientController@datacontact', 'class' => 'php-email-form','method' => 'POST','role'=>'form'])!!}
                  {{csrf_field()}}
                
                  <div class="form-row">
                    <div class="col-md-6 form-group">
                      <!-- <label for="name">Your Name</label>
                      <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" /> -->
                      {{Form::label('','name',['for' => 'name'])}}
                        {{Form::text('name','',['class' => 'form-control','data-msg' => 'Please enter at least 4 chars' ,'id' => 'name'])}}
                       
                      <div class="validate"></div>
                    </div>
                    <div class="col-md-6 form-group">
                      <!-- <label for="email">Your Email</label>
                      <input type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" /> -->
                      {{Form::label('','email',['for' => 'email'])}}
                        {{Form::email('email','',['class' => 'form-control','data-msg' => 'Please enter a valid email' , 'id' => 'email'])}}
                       
                      <div class="validate"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <!-- <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" /> -->
                    {{Form::label('','subject',['for' => 'subject'])}}
                        {{Form::text('subject','',['class' => 'form-control','data-msg' => 'Please enter at least 5 chars of subject' , 'id' => 'subject'])}}
                       
                    <div class="validate"></div>
                  </div>
                  <div class="form-group">
                    <!-- <label for="message">Message</label>
                    <textarea class="form-control" name="message" rows="8" data-rule="required" data-msg="Please write something for us"></textarea> -->
                    {{Form::label('','message',['for' => 'message'])}}
                        {{Form::text('message','',['class' => 'form-control','data-msg' => 'Please write something for us' , 'rows' => '8'])}}
                     
                    <div class="validate"></div>
                  </div>
                  <!-- <div class="mb-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                  </div> -->
                  <!-- <div class="text-center btn btn-black"><button type="submit">Send Message</button></div> -->
                  <div class="text-center btn">
                  {{Form::submit('Send Message',['class' => 'btn btn-danger'])}}
                  </div>
                  {!!Form::close()!!}
                <!-- </form> -->
              </div>

            </div>
          </div>
        </div>

      </div>
      <hr style="border: lawngreen 2px solid;">
    </section>
    <!-- End Contact Section -->
    @endsection
