@extends('admin.layout.master')
@section('title')
    Create new admin
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Admin
                <small>Create new admin</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{url()->current()}}</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form action="{{route('users.store')}}" method="post" role="form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <legend>Create new User</legend>
                                </div>
                                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">Name (*)</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name ..."
                                           value="{{old('name')}}" required autofocus>
                                    @if($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                                    <label for="email" class="control-label">Email (*)</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email ..."
                                           value="{{old('email')}}" required>
                                    @if($errors->has('email'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('email')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                                    <label for="password" class="control-label">Password (*)</label>
                                    <input type="password" class="form-control" required name="password" value="{{old('password')}}"
                                           placeholder="Enter User Password ...">
                                    @if($errors->has('password'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('password')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
                                    <label for="phone" class="control-label">Phone Number (*)</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter User Phone ..."
                                           value="{{old('phone')}}">
                                    @if($errors->has('phone'))
                                        <span class="help-block">
                                    <strong>{{$errors->first('phone')}}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
                                    <label for="address" class="control-label">Address (*)</label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter User Address ..."
                                           value="{{old('address')}}">
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
            $(".textarea").wysihtml5();
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection