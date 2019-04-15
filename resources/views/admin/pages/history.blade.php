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
                <div class="container">
                    <div class="form-group col-md-3">
                        <label for="time"><span class="glyphicon glyphicon-edit"></span> Chọn thời điểm :</label>
                        <select class="form-control" id="time_option" onchange="showSelectedInput()">
                            <option value="now">Hiện tại</option>
                            <option value="minute">Nửa giờ trước</option>
                            <option value="day">Hôm qua</option>
                            <option value="week">Tuần trước</option>
                            <option value="manual">Thời điểm khác</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date_input"><span class="glyphicon glyphicon-lock"></span> Ngày :
                        </label>
                        <input class="form-control" id="date_input" type="date">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="start_input"><span class="glyphicon glyphicon-lock"></span> Giờ :
                        </label>
                        <input class="form-control" id="start_input" type="time">
                    </div>
                    <a class="btn btn-info" id="button_submit" style="margin-top: 25px"><span
                                class="glyphicon glyphicon-search"></span> Xem lịch sử</a>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row" style="">
                        <div class="col-md-1">
                            Chú giải
                        </div>
                        <div class="btn btn-default">
                            Chưa có dữ liệu
                        </div>
                        <div class="btn btn-danger">
                            0-10 km/h
                        </div>
                        <div class="btn btn-warning">
                            10-20 km/h
                        </div>
                        <div class="btn btn-success">
                            20-30 km/h
                        </div>
                        <div class="btn btn-primary">
                            >30 km/h
                        </div>
                    </div>
                    <div class="row" id="map" style="min-height: 500px;">

                    </div>
                </div>
                <!-- /.col -->
                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('script')
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNuybXPIprwq2n4NeImTuDwq07farwEaw&callback=initMap">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script>
        function initMap()
        {
//            define  variables
            // Make by Toan
            var width = {{$grid->width}};
            var height = {{$grid->height}};
            var north = {{$grid->north}};
            var east = {{$grid->east}};
            var south = {{$grid->south}};
            var west = {{$grid->west}};
            var la = (north + south) / 2;
            var lo = (west + east) / 2;
            // Make by Toan

            // var width = 56;
            // var height = 23;
            // var north = 21.157200;
            // var east = 105.919876;
            // var south = 20.951180;
            // var west = 105.456390;
//            define map
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat: la, lng: lo}
            });
            //define rectangles
            var rectangle = new Array(height);
            for (var i = 0; i < height; i++) {
                rectangle[ i ] = new Array(width);
                for (var j = 0; j < width; j++) {
                    rectangle[ i ][ j ] = new google.maps.Rectangle({
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillOpacity: 0.35,
                        // Make by Toan
                        fillColor: '#808080',
                        // Make by Toan
                        map: map,
                        bounds: {
                            north: (south + (i + 1) * (north - south) / height),
                            south: (south + i * (north - south) / height),
                            west: (west + j * (east - west) / width),
                            east: (west + (j + 1) * (east - west) / width),
                        }
                    });
                }
            }
            $(document).ready(function ()
            {
                $('#button_submit').click(function ()
                {
                    // Make by Toan
                    for(var i = 0; i < height; i++){
                        for(var j = 0; j < width; j++){
                            rectangle[i][j].setOptions({
                                fillColor : '#808080'
                            });
                        }
                    }
                    // Make by Toan
                    resetAllColor(rectangle);
                });
            });
//            get color from server
            updateRectangle(rectangle);
        }
        function updateRectangle(rectangle)
        {
            downloadUrl("{{route('color',$start_time)}}", function (data)
            {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                //Loop for each rows in table
                Array.prototype.forEach.call(markers, function (markerElem)
                {
                    var whereX = markerElem.getAttribute('whereX');
                    var whereY = markerElem.getAttribute('whereY');
                    var color = markerElem.getAttribute('color');
                    var avg_speed = markerElem.getAttribute('avg_speed');
                    var marker_count = markerElem.getAttribute('marker_count');
                    rectangle[ whereX ][ whereY ].setOptions({
                        fillColor: color
                    });
                    rectangle[ whereX ][ whereY ][ 'avg_speed' ] = avg_speed;
                    rectangle[ whereX ][ whereY ][ 'marker_count' ] = marker_count;
                    rectangle[ whereX ][ whereY ][ 'inputX' ] = whereX;
                    rectangle[ whereX ][ whereY ][ 'inputY' ] = whereY;
                    rectangle[ whereX ][ whereY ][ 'color' ] = color;
                });
            });
        }
        function resetAllColor(rectangle)
        {
            var now = moment();
            var url;
            if ($('#time_option').val() == "now") {
                url = '';
            } else {
                url = "/" + $('#date_input').val() + " " + $('#start_input').val();
            }
            downloadUrl("{{route('color')}}" + url, function (data)
            {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                //Loop for each rows in table
                Array.prototype.forEach.call(markers, function (markerElem)
                {
                    var whereX = markerElem.getAttribute('whereX');
                    var whereY = markerElem.getAttribute('whereY');
                    var color = markerElem.getAttribute('color');
                    var avg_speed = markerElem.getAttribute('avg_speed');
                    var marker_count = markerElem.getAttribute('marker_count');
                    rectangle[ whereX ][ whereY ].setOptions({
                        fillColor: color
                    });
                    rectangle[ whereX ][ whereY ][ 'avg_speed' ] = avg_speed;
                    rectangle[ whereX ][ whereY ][ 'marker_count' ] = marker_count;
                    rectangle[ whereX ][ whereY ][ 'inputX' ] = whereX;
                    rectangle[ whereX ][ whereY ][ 'inputY' ] = whereY;
                    rectangle[ whereX ][ whereY ][ 'color' ] = color;
                });
            });
        }
        //        get data from XML page
        function downloadUrl(url, callback)
        {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function ()
            {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }
        //        Callback function
        function doNothing()
        {
        }
        function showSelectedInput()
        {
            var now = moment();
            if (document.getElementById('time_option').value == "minute") {
                now.subtract(30, 'minutes');
            }
            if (document.getElementById('time_option').value == "day") {
                now.subtract(1, 'days');
            }
            if (document.getElementById('time_option').value == "week") {
                now.subtract(7, 'days');
            }
            $('#date_input').val(now.format('YYYY-MM-DD'));
            $('#start_input').val(now.format('HH:mm'));
            return now.format('YYYY-MM-DD HH:mm:00')
        }
    </script>
@endsection