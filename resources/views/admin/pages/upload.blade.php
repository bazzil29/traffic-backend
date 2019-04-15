@extends('admin.layout.master')

@section('title')
    Bảng điều khiển
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{--         <h1>
                         Dashboard
                         <small>Version 2.0</small>
                     </h1>--}}
            <div>
                <ol class="breadcrumb">
                    <li><a href="{{route('homepage')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div>

        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <form action="" method="post" enctype="multipart/form-data">
                    Select CSV log file:
                    <input type="file" name="fileCSV[]" multiple id="fileCSV">
                    <input type="submit" value="Upload CSV" name="submit">
                    {{ csrf_field() }}
                </form>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection