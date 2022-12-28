@extends('admin.layouts.master')
@section('title','Order List')
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
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                        {{-- sorting  --}}
                        <div class="table-data__tool-right">
                            <form action="{{route('order#changeStatus')}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <select name="orderStatus" id="" class="form-control">
                                        <option value="3" @if(request('orderStatus')== 3)selected @endif>All</option>
                                        <option value="0" @if(request('orderStatus')== 0)selected @endif>Pending</option>
                                        <option value="1" @if(request('orderStatus')== 1)selected @endif>Accept</option>
                                        <option value="2" @if(request('orderStatus')== 2)selected @endif>Reject</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-dark">Sort</button>
                                </div>
                            </form>
                        </div>
                        {{-- sorting end  --}}
                    </div>


                    {{-- search bar  --}}
                    <div class="row">
                        <h5 class="text-muted col-4">
                            Search Key:{{request('key')}} <br>
                            Total:{{count($order)}}
                        </h5>
                        <form action="{{route('order#list')}}" method="get" class="col-4 offset-4">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" id="" value="{{request('key')}}" class="form-control" placeholder="Name or Order Code">
                                <button type="submit" class="btn btn-dark btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    {{-- search bar end  --}}

                    @if(count($order) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="orderList">
                               @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <td>
                                            {{$o->user_id}}
                                        </td>
                                        <td >
                                            {{$o->user_name}}
                                            <input type="hidden" id="orderId" value="{{$o->id}}">
                                        </td>
                                        <td>
                                            {{$o->created_at->format('F-d-Y')}}
                                        </td>
                                        <td>
                                            <a href="{{route('order#codePage',$o->order_code)}}" class="text-decoration-none">{{$o->order_code}}</a>
                                        </td>
                                        <td>
                                            {{$o->total_price}}Ks
                                        </td>
                                        <td>
                                            <select name="" id="" class="form-control eachOption">
                                                <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                                <option value="1" @if($o->status == 1) selected @endif>Accept</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <h4 class="text-muted text-center mt-5">There is no order!</h4>
                    @endif
                    {{-- <div class="mt-2">{{$products->appends(request()->query())->links()}} </div>  --}}
                    <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
    <!-- END MAIN CONTENT-->
 @endsection
 @section('scripSource')
 <script>
$(document).ready(function(){
    $('#sortingOption').change(function(){
        $so=$('#sortingOption').val();
        // console.log($so);
        $.ajax({
            type : 'get',
            url : '/order/ajax/orderList',
            data : {'sortingOption' : $so},
            dataType : 'Json',
            //September-22-2022 05:00 PM
            success : function(response){
                $months =["January","Faburary",'March','April','May','June','July','Auguest','September','October','November','December']
                $list = ``;
                console.log($so);


                for($i = 0; $i < response.length; $i++){
                    // Data format change
                    $dbDate = new Date(response[$i].created_at);
                    $formatDate = ($months[$dbDate.getMonth()]+'-'+$dbDate.getDay()+'-'+$dbDate.getFullYear());
                    console.log($formatDate);
                    // status change for sorting
                    if(response[$i].status == 0){
                    $status = `
                    <select name="" id="" class="form-control">
                        <option value="0" selected>Pending</option>
                        <option value="1" >Accept</option>
                        <option value="2" >Reject</option>
                    </select>
                    `;
                    }else if(response[$i].status == 1){
                    $status = `
                    <select name="" id="" class="form-control">
                        <option value="0" >Pending</option>
                        <option value="1" selected>Accept</option>
                        <option value="2" >Reject</option>
                    </select>
                    `;
                    }else if(response[$i].status  == 2){
                    $status =`
                    <select name="" id="" class="form-control">
                        <option value="0" >Pending</option>
                        <option value="1" >Accept</option>
                        <option value="2" selected>Reject</option>
                    </select>
                    `;
                }

                    $list += `
                    <tr class="tr-shadow">
                                        <td>
                                           ${response[$i].user_id}
                                        </td>
                                        <td >
                                            ${response[$i].user_name}
                                        </td>
                                        <td>
                                            ${$formatDate}
                                        </td>
                                        <td>
                                            ${response[$i].order_code}
                                        </td>
                                        <td>
                                            ${response[$i].total_price}Ks
                                        </td>
                                        <td>
                                            ${$status}
                                        </td>
                                    </tr>
                    `;
                }
                $('#orderList').html($list);
            }
        })
    })
    $('.eachOption').change(function(){
        // console.log('hello');
        $parentNode = $(this).parents('tr');
        $orderId = $($parentNode).find('#orderId').val();
        $status = $(this).val();
        $.ajax({
            type : 'get',
            url : '/order/ajax/order/status/change',
            data: {'orderId' : $orderId,'status' : $status},
            dataType: 'Json',
            success :function(response){

            }
        })
    })
});

 </script>
 @endsection

