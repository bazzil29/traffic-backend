<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('admin/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin/plugins/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="container">

    <!-- /.login-logo -->
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            {{--<div class="login-box-body">--}}
            <div class="panel-heading text-center"><h4>Đăng nhập vào ban quản trị</h4></div>
            <div class="panel-body">
                <form action="{{route('postAdminLogin')}}" method="post" class="form-horizontal">
                    {{csrf_field()}}
                    <div class="form-group has-feedback {{$errors->has('email') ? ' has-error' : ''}}">
                        <label for="email" class="control-label col-md-4">E-Mail Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="Email" name="email"
                                   value="{{old('email')}}">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            @if($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback {{$errors->has('password') ? ' has-error' : ''}}">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            @if($errors->has('password'))
                                <span class="help-block">
                                <strong>{{$errors->first('password')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                        @if(session('login_fail'))
                            <span class="col-md-offset-4 text-danger"><strong>{{session('login_fail')}}</strong></span>
                        @endif
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember" {{old('remember')? 'checked' : ''}}> Remember
                                    Me
                                </label>
                            </div>
                        </div>
                    </div>
                        <!-- /.col -->
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-facebook">Sign In</button>
                            </div>
                        </div>
                        <!-- /.col -->

                </form>
                {{--</div>--}}
            </div>
            <!-- /.login-box-body -->
        </div>
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('admin/plugins/jQuery/jquery-3.1.1.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('admin/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('admin/plugins/iCheck/icheck.min.js')}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
