@extends('admin.layouts.master')
@section('title','Product Create')
@section('content')
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Product Form</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input name="name" type="text" class="form-control @error('name')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product..." value="{{old('name')}}">
                                            @error('name')
                                            <div class="invalid-feedback">{{$message}} </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                                <option value="">Choose category...</option>
                                                @foreach($categories as $c)
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <div class="invalid-feedback">{{$message}} </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                           <textarea name="description" id="" cols="30" rows="3" class="form-control @error('description')is-invalid @enderror" placeholder="Enter Description..." value="">{{old('description')}}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{$message}} </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Image</label>
                                            <input name="image" type="file" class="form-control @error('image')is-invalid @enderror" aria-required="true" aria-invalid="false">
                                            @error('image')
                                            <div class="invalid-feedback">{{$message}} </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="price" class="form-control @error('price')is-invalid @enderror" placeholder="Enter Price..." value="{{old('price')}}" aria-label="Username" aria-describedby="basic-addon1"><span class="input-group-text" id="basic-addon1">Ks</span>
                                                @error('price')
                                                    <div class="invalid-feedback">{{$message}} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <div class="input-group mb-3">
                                                <input name="waiting_time" type="text" class="form-control @error('waiting_time')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time..." value="{{old('waiting_time')}}">
                                                <span class="input-group-text" id="basic-addon1">Min</span>
                                                @error('waiting_time')
                                                    <div class="invalid-feedback">{{$message}} </div>
                                                 @enderror
                                            </div>
                                        </div>
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Create</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i>
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
