@extends('admin.layout.master')
@section('title')
    Customer
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Customer
                <small>List of customer</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{url()->current()}}</li>
            </ol>

        </section>

        <!-- Main content -->
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
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            @if(!isset($query))
                                <h3 class="box-title">List of Customer</h3>
                            @else
                                <h3 class="box-title">show result of {{$query}}</h3>
                            @endif
                            <div class="box-tools">
                                <div class="input-group">
                                    <form action="{{route('admin.users.customer')}}" method="get" id="cate_search">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control pull-right"
                                                   placeholder="Enter name of category">
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
                                    <th>Date</th>
                                    <th style="width: 7%;">Detail</th>
                                </tr>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$customer->username}}</td>
                                        <td style="width: 15%;">{{$customer->email}}</td>
                                        <td style="width: 15%;">{{$customer->phone }}</td>
                                        <td>{{$customer->address}}</td>
                                        <td>{{date_format($customer->updated_at,'Y-m-d')}}</td>
                                        <td>
                                            <a href="javascript:;"
                                               class="btn btn-xs btn-danger delete"
                                               dataId="{{$customer->id}}">Chi Tiết</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="box-tools">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        @if(!isset($query))
                                            {{$customers->links()}}
                                        @else
                                            {{$customers->appends(['search'=>$query])->links()}}
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
                    <h4 class="modal-title" id="myModalLabel">Customer Detail</h4>
                </div>

                <div class="modal-body" id="Customer_Detail">

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
            $(".delete").click(function () {
                var customer_id = ($(this).attr('dataId'));
                $.ajax({
                    url:"customer/"+customer_id,
                    success : function (data) {
                    $("#Customer_Detail").html(data);
                }});
              /*  $.get("users/"+customer_id, function (data) {
                    $("#Customer_Detail").html(data);
                });*/
//                alert(customer_id);
//                $("#user_id").val($(this).attr('dataId'));
                $("#deleteModal").modal({
                    'show': true
                });
            });
//            $(".alert").alert();
        });
    </script>
@endsection