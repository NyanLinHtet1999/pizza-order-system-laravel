@extends('user.layouts.master')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                        <form action="{{route('user#editProfile')}}" method="post" enctype=multipart/form-data>
                            @csrf
                            <div class="row">
                                <div class="col-5">
                                        @if(Auth::user()->image != null)
                                        <img src="{{asset('storage/'.Auth::user()->image)}}" class="img-thumbnail" >
                                    @else
                                        @if(Auth::user()->gender == 'male')
                                            <img src="{{asset('image/default_profile.jpg')}}" class="img-thumbnail">
                                        @else
                                            <img src="{{asset('image/default_female_profile.jpg')}}" class="img-thumbnail">
                                        @endif
                                    @endif
                                    <div class="form-group mt-3">
                                        <label class="control-label mb-1">Image</label>
                                        <input name="image" type="file" class="form-control @error('image')is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{old('image',Auth::user()->image)}}">
                                        @error('image')
                                        <div class="invalid-feedback">{{$message}} </div>
                                        @enderror
                                        </div>
                                    <div class="mt-3">
                                        <button id="payment-button" type="submit" class="btn btn-sm btn-dark btn-block">
                                            <span id="payment-button-amount">Update</span>
                                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                                            <i class="fa-solid fa-circle-up"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input name="name" type="text" class="form-control @error('name')is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{old('name',Auth::user()->name)}}">
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}} </div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input name="email" type="email" class="form-control @error('email')is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{old('email',Auth::user()->email)}}">
                                        @error('email')
                                        <div class="invalid-feedback">{{$message}} </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input name="phone" type="text" class="form-control @error('phone')is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{old('phone',Auth::user()->phone)}}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{$message}} </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender')is-invalid @enderror">
                                            <option value="">Choose gender...</option>
                                            <option value="male" @if(Auth::user()->gender == 'male')
                                                selected @endif>Male</option>
                                            <option value="female" @if(Auth::user()->gender == 'female')
                                                selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">{{$message}} </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <textarea name="address" class="form-control @error('address')is-invalid @enderror" aria-required="true" aria-invalid="false">{{old('address',Auth::user()->address)}}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{$message}} </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
