@extends('user.layouts.master')
@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5>
                <div class="bg-light p-3 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark px-3 py-2">
                            <label class=" text-white" for="price-all">All Categories</label>
                            <span class="badge border font-weight-normal text-white">{{ $categories->count() }}</span>
                        </div>
                        @if (count($categories) != 0)
                        <a href="{{route('user#home')}}" class=" text-decoration-none text-dark">
                            <div class=" d-flex align-items-center justify-content-between mb-3">
                                <label class="" for="price-1">All</label>
                            </div>
                        </a>
                        @foreach ($categories as $c)
                            <a href="{{route('user#pizzaFilter',$c->id)}}" class=" text-decoration-none text-dark">
                                <div class=" d-flex align-items-center justify-content-between mb-3">
                                    <label class="" for="price-1">{{ $c->name }} </label>
                                </div>
                            </a>
                        @endforeach
                        @else
                            <h3>There is no categories</h3>
                        @endif
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                  <a href="{{route('user#cartPage')}}" class="text-decoration-none">
                                        <button type="button" class="btn btn-dark text-white position-relative">
                                        cart<i class="fa-solid fa-cart-plus"></i>
                                            <span       class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{$carts->count()}}
                                            </span>
                                        </button>
                                  </a>
                                  <a href="{{route('user#historyPage')}}" class="ms-3">
                                    <button type="button" class="btn btn-dark text-white position-relative">
                                    <i class="fa-solid fa-clock-rotate-left"></i>History
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{$history->count()}}
                                        </span>
                                    </button>
                              </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="" id="sortingOption" class="form-control">
                                        <option value="">Sorting</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span id="dataList" class="row">

                        @if (count($products) != 0)
                            @foreach ($products as $p)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">

                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}"
                                            style="width:200px;">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail',$p->id)}}">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">{{ $p->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $p->price }}kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             @endforeach
                        @else
                            <h2 class='text-center'>There is no food! </h2>
                        @endif
                    </span>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();
                if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'Json',
                        success: function(response) {
                            $list = ``;
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                                @if (count($products) != 0)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}"
                                                style="width:200px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price}kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <h2 class='text-center'>There is no food! </h2>
                                @endif
                            `;
                            }
                            $('#dataList').html($list);
                            // console.log($list);
                        }
                    })
                } else if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'Json',
                        success: function(response) {
                            $list = ``;
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                                @if (count($products) != 0)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}"
                                                style="width:200px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail',$p->id)}}"><i
                                                        class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="{{route('user#pizzaDetail',$p->id)}}">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price}kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <h2 class='text-center'>There is no food! </h2>
                                @endif
                            `;
                            }
                            $('#dataList').html($list);
                            // console.log($list);
                        }
                    })
                }
            })

        });
    </script>
@endsection
