@extends('admin.layouts.master')
@section('title','Password')
@section('content')
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Password</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('admin#change')}} " method="post" novalidate="novalidate">
                                        @csrf
                                        @if(session('notMatch'))
                                            <div class="row mt-3">
                                                <div class="alert alert-danger alert-dismissible fade show col-12" role="alert"><i class="fa-solid fa-triangle-exclamation"></i>
                                                    {{session('notMatch')}}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if(session('changeSuccess'))
                                        <div class="row mt-3">
                                            <div class="alert alert-success alert-dismissible fade show col-12" role="alert"><i class="fa-solid fa-cloud-arrow-down"></i>
                                                {{session('changeSuccess')}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                        <div class="form-group">
                                            <label class="control-label mb-1">Old password</label>
                                            <input name="oldPassword" type="password" class="form-control @error('oldPassword')is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter old password">
                                            @error('oldPassword')
                                            <div class="invalid-feedback">{{$message}} </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">New password</label>
                                            <input name="newPassword" type="password" class="form-control @error('newPassword')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter new password">
                                            @error('newPassword')
                                            <div class="invalid-feedback">{{$message}} </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Confirmed password</label>
                                            <input name="confirmedPassword" type="password" class="form-control @error('confirmedPassword')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter comfirmed password">
                                            @error('confirmedPassword')
                                            <div class="invalid-feedback">{{$message}} </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Change Password</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-key"></i>
                                            </button>
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
