@extends('admin.layouts.master')
@section('title','Product Detail')
@section('content')
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3 ms-2">
                                            <i class="fa-solid fa-angles-left" onclick="history.back()"></i>
                                    </div>
                                    <div class="row">
                                        <div class="col-5  ms-3">
                                            <img src="{{asset('storage/'.$product->image)}}" alt="">
                                        </div>
                                        <div class="col-6 ms-3">
                                            <div class="btn btn-danger mb-2">{{$product->name}}</div><br>
                                            <div class="btn btn-dark btn-sm mb-2">
                                                @if($product->category_name != null)
                                                {{$product->category_name}}
                                                @else
                                                ---
                                                @endif
                                            </div><br>
                                            <div class='mb-2'>
                                                <span class="btn btn-dark btn-sm">{{$product->price}}Ks</span>
                                                <span class="btn btn-dark btn-sm">{{$product->waiting_time}}Min</span>
                                            </div>
                                            <div class="mb-2">
                                                <span class="btn btn-dark btn-sm">{{$product->view_count}}
                                                    @if($product->view_count > 1)
                                                    views
                                                    @else
                                                    view
                                                    @endif
                                                </span>
                                                <span class="btn btn-dark btn-sm">{{$product->created_at->format('d/m/y')}}</span>
                                            </div>
                                            <div>
                                                <div class='text-muted'>
                                                    <i class="fa-solid fa-file-lines"></i>
                                                </div>
                                                <div>
                                                    {{$product->description}}
                                                </div>
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
