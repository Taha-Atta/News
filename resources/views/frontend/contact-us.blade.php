@extends('layouts.frontend.app')

@section('title')
Contact_us
@endsection
@push('headers')
 <link rel="canonical" href="{{url()->full()}}">
@endpush
@section('body')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>

  <li class="breadcrumb-item active">Contact</li>

@endsection

    <!-- Contact Start -->
    <div class="contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <form action="{{route('frontend.contact.store')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" />
                                   <span class="text-danger"> @error('name') {{$message}}@enderror </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email" />
                                    <span class="text-danger"> @error('email') {{$message}}@enderror</span>
                                </div>
                                <div class="form-group  col-md-6">
                                    <input type="text" class="form-control" name="phone" placeholder="phone" />
                                    <span class="text-danger"> @error('phone') {{$message}}@enderror </span>
                                </div>
                            </div>

                            <div class="form-group ">
                                <input type="text" class="form-control" name="title" placeholder="Subject" />
                              <span class="text-danger">  @error('title') {{$message}}@enderror  </span>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="body" rows="5" placeholder="Message"></textarea>
                              <span class="text-danger">   @error('body') {{$message}}@enderror </span>
                            </div>
                            <div>
                                <button class="btn" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <p class="mb-4">
                            The contact form is currently inactive. Get a functional and
                            working contact form with Ajax & PHP in a few minutes. Just copy
                            and paste the files, add a little code and you're done.

                        </p>
                        <h4><i class="fa fa-map-marker"></i>{{$setting_info->street}}, {{$setting_info->city}}, {{$setting_info->country}}</h4>
                        <h4><i class="fa fa-envelope"></i> {{$setting_info->email}}</h4>
                        <h4><i class="fa fa-phone"></i> {{$setting_info->phone}}</h4>
                        <div class="social">
                            <a href=" {{$setting_info->twitter}}"><i class="fab fa-twitter"></i></a>
                            <a href=" {{$setting_info->facebook}}"><i class="fab fa-facebook-f"></i></a>
                            <a href=" {{$setting_info->instagram}}"><i class="fab fa-instagram"></i></a>
                            <a href=" {{$setting_info->youtube}}"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
