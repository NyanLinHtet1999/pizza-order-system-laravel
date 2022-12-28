@extends('admin.layouts.master')
@section('title','Editing Profile')
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
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Editing Product</h3>
                                    </div>
                                    <form action="{{route('product#edit')}}" method="post" enctype=multipart/form-data>
                                        @csrf
                                        <div class="row">
                                            <div class="col-5">
                                                    <img src="{{asset('storage/'.$product->image)}}"  />
                                                <div class="form-group mt-3">
                                                    <label class="control-label mb-1">Image</label>
                                                    <input name="image" type="file" class="form-control @error('image')is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{old('image',$product->image)}}">
                                                    @error('image')
                                                    <div class="invalid-feedback">{{$message}} </div>
                                                    @enderror
                                                    </div>
                                                <div class="mt-3">
                                                    <button id="payment-button" type="submit" class="btn btn-sm btn-dark btn-block">
                                                        <span id="payment-button-amount">Edit</span>
                                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                        <i class="fa-solid fa-circle-up"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <input type="hidden" name="id" value="{{$product->id}}">
                                                <div class="form-group">
                                                <label class="control-label mb-1">Name</label>
                                                <input name="name" type="text" class="form-control @error('name')is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{old('name',$product->name)}}">
                                                @error('name')
                                                <div class="invalid-feedback">{{$message}} </div>
                                                @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Description</label>
                                                    <textarea name="description" class="form-control @error('description')is-invalid @enderror"  aria-required="true" aria-invalid="false" cols="30" rows="10">{{old('description',$product->description)}}</textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback">{{$message}} </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Category</label>
                                                    <select name="category_id" class="form-control @error('category_id')is-invalid @enderror">
                                                        <option value="" @if (old('category_id') ==null ) selected @endif>Choose category...</option>
                                                        @foreach($categories as $c)
                                                        <option value="{{$c->id}}" @if ( $c->id == $product->category_id)
                                                            selected @endif>{{$c->name}} </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <div class="invalid-feedback">{{$message}} </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Price</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="price" class="form-control @error('price')is-invalid @enderror"  value="{{old('price',$product->price)}}" aria-label="Username" aria-describedby="basic-addon1"><span class="input-group-text" id="basic-addon1">Ks</span>
                                                        @error('price')
                                                            <div class="invalid-feedback">{{$message}} </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Waiting Time</label>
                                                    <div class="input-group mb-3">
                                                        <input name="waiting_time" type="text" class="form-control @error('waiting_time')is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{old('waiting_time',$product->waiting_time)}}">
                                                        <span class="input-group-text" id="basic-addon1">Min</span>
                                                        @error('waiting_time')
                                                            <div class="invalid-feedback">{{$message}} </div>
                                                         @enderror
                                                    </div>
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
