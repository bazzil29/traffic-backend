@extends('admin.layout.master')
@section('title')
    Admin
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                <small>List of user</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{url()->current()}}</li>
            </ol>

        </section>

        <!-- Main content -->
        <section class="content">
            @if($currentUser->id == 1)
                <div class="row" style="margin-bottom: 15px">
                    <div class="col-md-12">
                        <a class="btn btn-facebook" href="{{route('users.create')}}">+ Add new user</a>
                    </div>
                </div>
            @endif
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
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            @if(!isset($query))
                                <h3 class="box-title">List of users</h3>
                            @else
                                <h3 class="box-title">show result of {{$query}}</h3>
                            @endif
                            <div class="box-tools">
                                <div class="input-group">
                                    <form action="{{route('users.index')}}" method="get" id="cate_search">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control pull-right"
                                                   placeholder="Enter name to search">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-default"><i
                                                            class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Join date</th>
                                    <th>Image Profile</th>
                                    <th>Role</th>
                                    @if($currentUser->id == 1)
                                        <th style="width: 7%;">Delete</th>
                                    @endif
                                </tr>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td style="width: 15%;">{{$user->email}}</td>
                                        <td style="width: 15%;">{{$user->phone }}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{date_format($user->updated_at,'Y-m-d')}}</td>
                                        <td><img src="{!! asset("uploads/img_profile/$user->img") !!}" class="img-thumbnail" width="150px" alt="img profile"></td>
                                        <td>
                                            @if($user->id == 1)
                                                <span class="badge bg-blue">Super admin</span>
                                            @else
                                                <span class="badge bg-red">admin</span>
                                            @endif
                                        </td>
                                        @if($currentUser->id == 1 && $user->id != 1)
                                            <td>
                                                <a href="javascript:;"
                                                   class="btn btn-xs btn-danger delete"
                                                   dataId="{{$user->id}}"><i class="fa fa-trash"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>
                            <div class="box-tools">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        @if(!isset($query))
                                            {{$users->links()}}
                                        @else
                                            {{$users->appends(['search'=>$query])->links()}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- start modal delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Are you sure to delete this User?</h4>
                </div>

                <div class="modal-body">
                    <form action="{{route('users.delete')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" id="user_id" value="0" name="user_id">
                        <input type="submit" value="Delete" class="btn btn-danger">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- end modal delete -->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            //close alert
            $(".close").click(function () {
                $(".myAlert").alert("close");
            });
            //show modal delete
            $(".delete").click(function(){
                $("#user_id").val($(this).attr('dataId'));
                $("#deleteModal").modal({
                    'show' : true
                });
            });
//            $(".alert").alert();
        });
    </script>
@endsection