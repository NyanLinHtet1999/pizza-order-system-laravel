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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('category#createPage')}}">
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
                            Total:{{$categories->total()}}
                        </h5>
                        <form action="{{route('category#list')}}" method="get" class="col-4 offset-4">
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
                    @if(count($categories) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CATEGORY NAME</th>
                                    <th>CREATED DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($categories as $category)
                                    <tr class="tr-shadow">
                                        <td>{{$category->id}} </td>
                                        <td>
                                            {{$category->name}}
                                        </td>
                                        <td>{{$category->created_at->format('d-m-y h:i A')}}</td>
                                        <td>
                                            <td>
                                                <div class="table-data-feature gap-2">
                                                    <a href="{{route('category#edit',$category->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                   <a href="{{route('category#delete',$category->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                   </a>
                                                </div>
                                            </td>
                                        </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <h4 class="text-muted text-center mt-5">There is no category!</h4>
                    @endif
                    <div class="mt-2">{{$categories->appends(request()->query())->links()}} </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
