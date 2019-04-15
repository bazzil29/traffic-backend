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
        <!-- Modal -->
        <div class="modal fade" id="inputModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Edit Rectangle</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div class="form-group">
                                <label for="inputX"><span class="glyphicon glyphicon-user"></span> Input X</label>
                                <input type="text" class="form-control" id="inputX" placeholder="Input X">
                            </div>
                            <div class="form-group">
                                <label for="inputY"><span class="glyphicon glyphicon-eye-open"></span> Input Y</label>
                                <input type="text" class="form-control" id="inputY" placeholder="Input Y">
                            </div>
                            <div class="form-group">
                                <label for="color"><span class="glyphicon glyphicon-eye-open"></span> Color </label>
                                <input type="text" class="form-control" id="color" placeholder="Color">
                            </div>
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-default btn-success"><span
                                        class="glyphicon glyphicon-off"></span> Set to normal values
                            </button>
                            <button type="submit" class="btn btn-default btn-success"><span
                                        class="glyphicon glyphicon-off"></span> Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form role="form">
                        <div class="form-group col-md-5">
                            <label for="select_time"><span class="glyphicon glyphicon-edit"></span>Chọn thời
                                điểm</label>
                            <select class="form-control" id="select_time">
                                <option value="#FF0000">Nửa giờ trước</option>
                                <option value="#FFFF00">Giờ này hôm qua</option>
                                <option value="#00FF00">Giờ này tuần trước</option>
                                <option value="#0000FF">Tự chọn</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="input_date"><span class="glyphicon glyphicon-calendar"></span>Ngày: </label>
                            <input type="date" class="form-control" id="input_date">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="input_time1"><span class="glyphicon glyphicon-time"></span> Từ: </label>
                            <input type="time" class="form-control" id="input_time1">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="input_time2"><span class="glyphicon glyphicon-time"></span> Đến: </label>
                            <div class="form-control" id="input_time2"></div>
                        </div>

                        {{csrf_field()}}
                        <button type="submit" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-off"></span> Xem lịch sử
                        </button>
                        <button type="submit" class="btn btn-success"><span
                                    class="glyphicon glyphicon-off"></span> Xem lịch sử
                        </button>
                    </form>
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
    <script>
        function initMap()
        {
//            define  variables
            var width = 56;
            var height = 23;
            var north = 21.157200;
            var east = 105.919876;
            var south = 20.951180;
            var west = 105.456390;
//            define map
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat: 21.054711, lng: 105.688133}
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
                        map: map,
                        bounds: {
                            north: (south + (i + 1) * (north - south) / height),
                            south: (south + i * (north - south) / height),
                            west: (west + j * (east - west) / width),
                            east: (west + (j + 1) * (east - west) / width),
                        }
                    });
                    rectangle[ i ][ j ].addListener("mouseover", function (event)
                    {
                        document.getElementById('details').innerHTML = this.avg_speed;
                        document.getElementById('inputX').value = this.inputX;
                        document.getElementById('inputY').value = this.inputY;
                        document.getElementById('color').value = this.color;
                    });
                    rectangle[ i ][ j ].addListener("click", function (event)
                    {
                        $("#inputModal").modal();
                    });
                }
            }
//            get color from server
            downloadUrl("{{route('color')}}", function (data)
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
    </script>
@endsection