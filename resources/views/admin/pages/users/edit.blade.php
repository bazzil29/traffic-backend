@extends('admin.layout.master')
@section('title')
    Edit profile
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Users
                <small>Edit profile</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{url()->current()}}</li>
            </ol>
        </section>
        <section class="content">
            @if(session('success'))
                <div class="alert alert-success myAlert">
                    <a href="#" class="close">&times;</a>
                    {{session('success')}}
                </div>
            @endif

            @if(session('fail'))
                <div class="alert alert-danger myAlert">
                    <a href="#" class="close">&times;</a>
                    {{session('fail')}}
                </div>
            @endif
            <div class="row">
                <div class="col-md-5">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle"
                                 src="{{asset("uploads/img_profile/$user->img")}}" alt="User profile picture">

                            <h3 class="profile-username text-center">{{$user->name}}</h3>

                            @if($user->id == 1)
                                <p class="text-muted text-center">Super Admin</p>
                            @else
                                <p class="text-muted text-center">Admin</p>
                            @endif
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <strong>Phone Number</strong> <span class="pull-right">{{$user->phone}}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Address</strong> <span class="pull-right">{{$user->address}}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Email</strong> <span class="pull-right">{{$user->email}}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Member Since</strong> <span
                                            class="pull-right">{{$user->created_at->toFormattedDateString()}}</span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form action="{{route('users.update',['id' => $user->id])}}" method="post" role="form"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <legend>Update your profile</legend>
                                </div>

                                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">Name (*)</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name ..."
                                           value="{{$user->name}}" required autofocus>
                                    @if($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                                    <label for="email" class="control-label">Email (*)</label>
                                    <input type="email" class="form-control" name="email" value="{{$user->email}}"
                                           placeholder="Enter email ...">
                                    @if($errors->has('email'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('email')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {{--<div class="checkbox icheck">--}}
                                        <label class="control-label" for="change_password">Change password</label>
                                            <input type="checkbox" value="1" style="width: 20px"
                                                   name="change_password" id="change_password">

                                    {{--</div>--}}
                                </div>

                                <div class="form-group {{session('err_password') ? 'has-error' : ''}}">
                                    <label for="password" class="control-label">Password (*)</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="Enter password ..." disabled>

                                    @if(session('err_password'))
                                        <span class="help-block">
                                    <strong>{{session('err_password')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('newpassword') ? 'has-error' : ''}}">
                                    <label for="newpassword" class="control-label">New Password (*)</label>
                                    <input type="password" class="form-control" id="newpassword" name="newpassword" disabled
                                           placeholder="New password ..." value="{{old('newpassword')}}">

                                    @if($errors->has('newpassword'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('newpassword')}}</strong>
                                         </span>
                                    @endif
                                </div>

                           {{--     <div class="form-group">
                                    <label for="repassword" class="control-label">ReEnter Password (*)</label>
                                    <input type="password" class="form-control" disabled id="reenterpassword"
                                           placeholder="ReEnter password ...">
                                </div>--}}

                                <div class="form-group {{$errors->has('img') ? 'has-error' : ''}}">
                                    <label for="img" class="control-label">Image Profile (*)</label>
                                    <input type="file" name="img">
                                    @if($errors->has('img'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('img')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
                                    <label for="phone" class="control-label">Phone Number (*)</label>
                                    <input type="text" class="form-control" name="phone" value="{{$user->phone}}"
                                           placeholder="Enter Phone Number ...">
                                    @if($errors->has('phone'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('phone')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
                                    <label for="address" class="control-label">Address (*)</label>
                                    <input type="text" class="form-control" name="address" value="{{$user->address}}"
                                           placeholder="Enter Address ...">
                                    @if($errors->has('address'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('address')}}</strong>
                                         </span>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button class="btn btn-github" type="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $("#change_password").change(function () {
                if($(this).is(":checked")){
                    $("#password").removeAttr('disabled');
                    $("#newpassword").removeAttr('disabled');
                }else{
                    $("#password").attr('disabled','');
                    $("#newpassword").attr('disabled','');
                }
            });
        /*                $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });*/
        });
    </script>
@endsection