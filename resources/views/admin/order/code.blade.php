@extends('admin.layouts.master')
@section('title','Order List')
@section('content')
     <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                    <!-- DATA TABLE -->
                    {{-- <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <button onclick="history.back()"><i class="fa-solid fa-arrow-left"></i>Back</button>
                            <div class="overview-wrap">
                                <h2 class="title-1">Order Info</h2>
                          </div>
                        </div>
                    </div> --}}
                    <button onclick="history.back()"><i class="fa-solid fa-arrow-left"></i>Back</button>
                    <div class="card col-6">

                        <h3 class="card-title col-6 pt-2">
                            Order Info
                        </h3>
                        <div style="height:2px" class="bg-dark col-10 offset-1"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <i class="fa-solid fa-user-tie"></i>Customer name
                                </div>
                                <div class="col">
                                    {{$order->user_name}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <i class="fa-solid fa-barcode"></i>Order Code
                                </div>
                                <div class="col">
                                    {{$order->order_code}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <i class="fa-regular fa-clock"></i>Order Date
                                </div>
                                <div class="col">
                                    {{$order->created_at->format('d/m/y h:i A')}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <i class="fa-solid fa-money-bill-1-wave"></i>Total
                                </div>
                                <div class="col">
                                    {{$order->total_price}}ks<span class="text-warning">(including delivery charges)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="orderList">
                               @foreach ($orderList as $ol)
                                    <tr class="tr-shadow">
                                        <td>
                                            <img src="{{ asset('storage/' . $ol->product_image) }}" alt="" width="100px">
                                        </td>
                                        <td >
                                            {{$ol->product_name}}
                                        </td>
                                        <td>
                                            {{$ol->qty}}
                                        </td>
                                        <td>
                                            {{$ol->total}}Ks
                                        </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
        </div>
    </div>
</div>
    <!-- END MAIN CONTENT-->
 @endsection
 @section('scripSource')
 <script>
 </script>
 @endsection

