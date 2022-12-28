@extends('user.layouts.master')
@section('content')
  <!-- Cart Start -->
  <div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5 offset-2 "  style="height:400px">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Data</th>
                        <th>OrderID</th>
                        <th>TotalPrice</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle" >
                   @foreach ($history as $h)
                   <tr>
                        <td class="align-middle">
                            {{$h->created_at->format('F/d/y h:i A')}}
                        </td>
                        <td class="align-middle">
                            {{$h->order_code}}
                        </td>
                        <td class="align-middle">
                            {{$h->total_price}}Ks
                        </td>
                        <td class="align-middle">
                            @if ($h->status == 0)
                                <span class="text-info">Pending...</span>
                            @elseif ($h->status == 1)
                                <span class="text-success">Success</span>
                            @elseif ($h->status == 2)
                                <span class="text-danger">Reject</span>
                            @endif
                        </td>
                </tr>
                   @endforeach
                </tbody>
            </table>
            {{$history->links()}}
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection
