<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
    {{--<div class="user-panel">--}}
    {{--<div class="pull-left image">--}}
    {{--@if(($img = Auth::user()->img) == null)--}}
    {{--<img src="{{asset('upload/img_profile/meo.jpg')}}" class="img-circle" alt="User Image">--}}
    {{--@else--}}
    {{--<img src="{{asset("upload/img_profile/$img")}}" class="img-circle" alt="User Image">--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--<div class="pull-left info">--}}
    {{--<p>{{Auth::user()->name}}</p>--}}
    {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <!-- Trang chủ admin -->
            <li class="active treeview">

                <a href="{{route('homepage')}}">

                    <i class="fa fa-dashboard"></i> <span>Thống kê</span>
                </a>
            </li>

            <!-- ./ trang chủ admin -->

            <!-- Xem Dữ liệu hiện tại -->
            <li class="treeview">
                <a href="{{route('current')}}">
                    <i class="fa fa-files-o"></i>
                    <span>Xem tình hình hiện tại</span>
                </a>
            </li>
            <!-- ./ Xem Dữ liệu hiện tại -->

            <!-- Xem dữ liệu cũ -->
            <li class="treeview">
                <a href="{{route('history')}}">
                    <i class="fa fa-pie-chart"></i>
                    <span>Xem dữ liệu cũ</span>
                </a>
            </li>
            <!-- ./xem dữ liệu cũ -->

            <!-- Dự đoán -->
            <li class="treeview">
                <a href="{{route('future')}}">
                    <i class="fa fa-paper-plane"></i>
                    <span>Dự đoán</span>
                </a>
            </li>
            <!-- ./dự đoán -->

            <!-- quản lý user -->
            <li class="treeview">
                <a href="{{url('users')}}">
                    <i class="fa fa-users"></i> <span>Quản lý người dùng</span>
                </a>
            </li>
            <!-- ./quản lý user -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>