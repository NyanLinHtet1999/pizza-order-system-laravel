@extends('admin.layouts.master')
@section('title','Profile')
@section('content')
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Account Info</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3 offset-1">
                                            @if(Auth::user()->image != null)
                                                <img src="{{asset('storage/'.Auth::user()->image)}}"  >
                                            @else
                                                @if(Auth::user()->gender == 'male')
                                                    <img src="{{asset('image/default_profile.jpg')}}" >
                                                @else
                                                    <img src="{{asset('image/default_female_profile.jpg')}}" >
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col-7 offset-1">
                                            <p><i class="fa-solid fa-user mr-3"></i></i>{{Auth::user()->name}}</p>
                                            <p><i class="fa-solid fa-envelope mr-3"></i>{{Auth::user()->email}}</p>
                                            <p><i class="fa-solid fa-phone mr-3"></i>{{Auth::user()->phone}}</p>
                                           <p><i class="fa-solid fa-venus-mars mr-3"></i>{{Auth::user()->gender}}</p>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="offset-4">
                                                <a href="{{route('admin#edit')}}"><button class="btn btn-dark btn-sm"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit Profile</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection
