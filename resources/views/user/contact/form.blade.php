@extends('user.layouts.master')
@section('content')
  <!-- Cart Start -->
  <div class="container-fluid">
            @if(session('sendSuccess'))
            <div class="row mt-3">
                <div class="alert alert-success alert-dismissible fade show col-6 offset-6" role="alert">
                    {{session('sendSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif
    <div class="row gap-5" style="min-height:500px;">
        <div class="col-6 offset-3">
           <div class="" >
            <form action="{{route('user#contactSendBtn')}}" method="post">
                @csrf
                <label for="" class="form-label">Suggesstion</label>
                <textarea name="message" id="" cols="30" rows="10" class="form-control @error('message')
                is-invalid @enderror" style="resize:none;"></textarea>
                @error('message')
                    <small class="text-danger d-block">{{$message}} </small>
                @enderror
                <button type="submit" class="btn btn-sm btn-dark text-white mt-2 ms-2">Send</button>
            </form>
           </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection
