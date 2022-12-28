@extends('user.layouts.master')
@section('content')
    <div class=" m-3">
        <a href="{{route('user#home')}}" class="text-dark text-decoration-none">
            <i class="fa-solid fa-arrow-left"></i>back
        </a>
    </div>
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id='pizzaData'>
                        @foreach ($cartList as $cL)
                        <tr>
                            <td class="align-middle">
                                <img src=" {{asset('storage/'.$cL->pizza_image)}} " alt="" width="100px">
                                <input type="hidden" value=" {{Auth::user()->id}} " id="userId">
                            </td>
                            <td class="align-middle">
                                {{$cL-> pizza_name}}
                                <input type="hidden" value="{{$cL->product_id}} " id="productId">
                            </td>
                            <td class="align-middle" id="price">{{$cL->pizza_price}}Ks
                            <input type="hidden" value="{{$cL->id}}" id="cartId">
                            </td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$cL->qty}}" id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{$cL->pizza_price * $cL->qty}}Ks </td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{$subTotal}}Ks </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000Ks</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="final">{{$subTotal + 3000}}Ks </h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                        <button type="button"class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearAllBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('scriptSource')
<script src="{{ asset('js/cart.js') }}"></script>
<script>
    $(document).ready(function(){
        // for order btn
        $('#orderBtn').click(function(){
            $subTotal = $('#subTotal').text().replace('Ks','');
            // console.log($subTotal);
            if($subTotal != 0){
                $orderCode= Date.now()+Math. floor(Math. random() * 100)+$("#userId").val().replace(" ","");
            $orderList= [];
            $("#pizzaData tr").each(function(index,row){
                $userId=$(row).find('#userId').val();
                $productId=$(row).find('#productId').val();
                $qty= $(row).find('#qty').val();
                $total =Number($(row).find('#total').text().replace('Ks',''));
                $final = $('#final').text().replace('Ks','');
                    $orderList.push({
                        'userId' : $userId,
                        "productId" : $productId,
                        "qty" : $qty,
                        "total" : $total,
                        "orderCode" : $orderCode,
                        "final" : $final
                    });
                });
                $.ajax({
                    type:'get',
                    url:"http://127.0.0.1:8000/user/ajax/pizza/order/orderList",
                    data: Object.assign({}, $orderList),
                    dataType:"Json",
                    success:function(response){
                        if(response.status == 'Success'){
                            window.location.href="http://127.0.0.1:8000/user/home";
                        };
                    }
                })
            }

            });
            // for remove btn
        $('.btn-remove').click(function(){
            $parentNode = $(this).parents('tr');
            $($parentNode).remove();
            $subTotal=0;
            $('#pizzaData tr').each(function(index,row) {
                $subTotal += Number($(row).find('#total').text().replace("Ks",'')) ;
            });
            $("#subTotal").html($subTotal+'Ks');
            $('#final').html($subTotal+3000+'Ks');
            $cartId = $($parentNode).find('#cartId').val();
            // console.log($cartId);
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/ajax/pizza/cart/single/remove',
                data : { 'cartId' : $cartId},
                dataType : 'Json',
                // success :function(response){
                //     console.log(response)
                // }
            })
        });
        // Clear all btn
        $('#clearAllBtn').click(function(){
            $userId=$('#userId').val();
            $('#pizzaData tr').remove();
            $("#subTotal").html(0+'Ks');
            $('#final').html(3000+'Ks');
            $.ajax({
                type : 'get',
                url : '/user/ajax/pizza/cart/all/remove',
                data : { 'userId' : $userId},
                dataType : 'Json'
            })

        })
    });
</script>
@endsection
