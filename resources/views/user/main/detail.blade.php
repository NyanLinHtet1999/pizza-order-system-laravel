@extends('user.layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    {{-- <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div> --}}
    <!-- Breadcrumb End -->

    <div class=" m-3">
        <div onclick="history.back()"><i class="fa-solid fa-arrow-left"></i>back</div>
    </div>
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class=" bg-light">
                        <div class="">
                            <img class="w-100 h-100" src="{{asset('storage/'.$product->image)}}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$product->name}}</h3>
                    <div class="d-flex mb-3">
                        <small class="pt-1" id="viewCountId">{{$product->view_count}} <i class="fa-solid fa-eye"></i></small>
                        <small class="pt-1 ms-3">{{$product->waiting_time}} Min</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$product->price}}Kyats</h3>
                    <p class="mb-4">
                        {{$product->description}}
                    </p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id="qtyId" >
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning px-3" id="addBtn" ><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                            <input type="hidden" name="" id="userId" value="{{Auth::user()->id}}">
                            <input type="hidden" name="" id="productId" value="{{$product->id}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $pL)
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100"{{asset('storage/'.$pL->image)}} src="{{asset('storage/'.$pL->image)}}" alt="" style="height:200px;">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail',$pL->id)}}"> <i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$pL->name}} </a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$pL->price}} Kyats</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
        // view count
        $productId = $('#productId').val();
        $viewCount = $('#viewCountId').text();
        console.log($viewCount);
        $.ajax({
                type :'get',
                url : '/user/ajax/pizza/view/count',
                data : {'productId' : $productId,
                        'viewCount' : $viewCount},
                dataType : 'Json',
            })
        // click add btn
        $('#addBtn').click(function(){
            $userId = $('#userId').val();
            $productId = $('#productId').val();
            $qtyId = $('#qtyId').val();
            $data = {
                    'userId' : $userId,
                    'productId' : $productId,
                    'qty' : $qtyId,
                };
            $.ajax({
                type :'get',
                url : 'http://127.0.0.1:8000/user/ajax/pizza/order/info',
                data : $data,
                dataType : 'Json',
                success : function (response){
                    window.location.href = "http://127.0.0.1:8000/user/home";
                }
            })

        });
    });
</script>

@endsection



