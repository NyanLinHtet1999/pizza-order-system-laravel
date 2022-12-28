@extends('admin.layouts.master')
@section('title','Category List')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('product#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item
                                </button>
                            </a>
                        </div>
                    </div>
                    {{-- search bar  --}}
                    <div class="row">
                        <h5 class="text-muted col-4">
                            Search Key:{{request('key')}} <br>
                            Total:{{count($products)}}
                        </h5>
                        <form action="{{route('product#list')}}" method="get" class="col-4 offset-4">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" id="" value="{{request('key')}}" class="form-control">
                                <button type="submit" class="btn btn-dark btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    {{-- delete success message --}}
                    @if(session('deleteSuccess'))
                    <div class="row mt-3">
                        <div class="alert alert-warning alert-dismissible fade show col-6 offset-6" role="alert">
                            {{session('deleteSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                      {{-- delete success message end  --}}
                    @if(count($products) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>IAMGE</th>
                                    <th>NAME</th>
                                    <th>CATEGORY</th>
                                    <th>VIEW COUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($products as $product)
                                    <tr class="tr-shadow">
                                        <td  style="width:300px;"><img src="{{asset('storage/'.$product->image)}}" alt="" width="100px"></td>
                                        <td>
                                            {{$product->name}}
                                        </td>
                                        <td>
                                            @if($product->category_name != null)
                                            {{$product->category_name}}
                                            @else
                                            ---
                                            @endif
                                        </td>
                                        <td>{{$product->view_count}} <i class="fa-solid fa-eye ms-1"></i></td>
                                            <td>
                                                <div class="table-data-feature gap-2">
                                                    <a href="{{route('product#detail',$product->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{route('product#editPage',$product->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                   <a href="{{route('product#delete',$product->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                   </a>
                                            </div>
                                        </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <h4 class="text-muted text-center mt-5">There is no product!</h4>
                    @endif
                    <div class="mt-2">{{$products->appends(request()->query())->links()}} </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
 @endsection

