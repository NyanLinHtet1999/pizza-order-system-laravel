@extends('admin.layouts.master')
@section('title','User List')
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
                                <h2 class="title-1">User List</h2>
                            </div>
                        </div>
                    </div>
                    {{-- search bar  --}}
                    <div class="row">
                        <h5 class="text-muted col-4">
                            Search Key:{{request('key')}} <br>
                            {{-- Total:{{$admins->total()}} --}}
                        </h5>
                        <form action="{{route('admin#userList')}}" method="get" class="col-4 offset-4">
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
                       @if(count($users) != '0')
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>PHONE</th>
                                    <th>GENDER</th>
                                    <th>ADDRESS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $u)
                                @if($u->role != 'admin')
                                <tr class="tr-shadow">
                                    <td>{{$u->id}} </td>
                                    <td style="width:200px;">
                                        @if($u->image != null)
                                            <img src="{{asset('storage/'.$u->image)}}"  >
                                        @else
                                            @if($u->gender == 'male')
                                                <img src="{{asset('image/default_profile.jpg')}}" >
                                            @else
                                                <img src="{{asset('image/default_female_profile.jpg')}}" >
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{$u->name}} </td>
                                    <td>{{$u->email}}</td>
                                    <td>{{$u->phone}}</td>
                                    <td>{{$u->gender}}</td>
                                    <td>{{$u->address}}</td>
                                    <td>
                                        <div class="table-data-feature gap-2">

                                            <form action="{{route('admin#userToAdmin',$u->id)}}" method="post">
                                                @csrf
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Change user to admin" type="submit">
                                                    <i class="fa-sharp fa-solid fa-people-arrows"></i>
                                                </button>
                                                <select name="role" class="d-none">
                                                    <option value="admin" selected>admin</option>
                                                </select>
                                            </form>
                                            <a href="{{route('admin#userDelete',$u->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Dlete">
                                                    <i class="zmdi zmdi-delete fs-5"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <h4 class="text-muted text-center mt-5">There is no user!</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
