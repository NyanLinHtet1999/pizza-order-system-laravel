@extends('admin.layouts.master')
@section('title','Profile')
@section('content')
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="table-data__tool-left mb-3">
                            <div class="overview-wrap">
                                <h2 class="title-1">User Suggessions</h2>
                            </div>
                        </div>
                        @if(count($message) != '0')
                        <div class="col-10 offset-1">
                           @foreach ($message as $m)
                           <div class="shadow bg-white p-2 text-dark mb-2" id="messageContainerId">
                            <input type="hidden" name="" value="{{$m->id}}" id="messageId">
                            <div class="">
                                <i class="fa-solid fa-user me-2"></i>{{$m->name}}
                            </div>
                            <div class="">
                                <i class="fa-solid fa-envelope me-2"></i>{{$m->email}}
                            </div>
                            <div class="">
                                <i class="fa-solid fa-envelope me-2"></i>{{$m->created_at->format('d/m/y h:i A')}}
                            </div>
                            <div id="message" class='message'>
                                <span>{{Str::words($m->message,10,'.....')}}</span>
                            </div>
                        </div>
                           @endforeach
                        </div>
                        @else
                            <h4 class="text-muted text-center mt-5">There is no message!</h4>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection
@section('scripSource')
<script>
    $(document).ready(function(){
        $('.message').click(function(){
            $parentNode = $(this).parents("#messageContainerId");
            $contactId = $parentNode.find('#messageId').val();
            $.ajax({
                type : 'get',
                url :'/message/ajax/seeMore',
                data : {'id' : $contactId},
                dataType : 'Json',
                success : function(response){
                   $parentNode.find('#message').text(response['message']);
                }
            })
        })
    })
</script>
@endsection
