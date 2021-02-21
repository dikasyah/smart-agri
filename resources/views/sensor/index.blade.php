@extends('layouts.master')
@section('title', 'Sensor')

@section('content')
    <div class="grid_12 full_block">
        <div class="widget_wrap">
            <div class="widget_top">
                <span class="h_icon list_image"></span>
                <h6>Sensor Lebung</h6>
            </div>
            <div class="widget_content">
                <form class="form_container left_label">
                    <ul>
                        <li>
                            <div class="form_grid_12">
                                <button type="button" class="btn_small btn_blue" onClick="GetDataLebung()"><span>Generate Data</span></button>
                            </div>
                        </li>
                    </ul>
                </form>
                <table id="table_sensor_lebung" class="display data_tbl">
                    <thead>
                        <tr>
                            <th>
                                entry_id
                            </th>
                            <th>
                                object_id
                            </th>
                            <th>
                                sensor_id
                            </th>
                            <th>
                                value
                            </th>
                            <th>
                                date
                            </th>
                            <th>
                                time
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lebung as $l)
                            <tr>
                                <td>{{$l->entry_id}}</td>
                                <td>{{$l->object_id}}</td>
                                <td>{{$l->sensor_id}}</td>
                                <td>{{$l->value}}</td>
                                <td>{{$l->date}}</td>
                                <td>{{$l->time}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="grid_12 full_block">
        <div class="widget_wrap">
            <div class="widget_top">
                <span class="h_icon list_image"></span>
                <h6>Sensor Plantation</h6>
            </div>
            <div class="widget_content">
                <form class="form_container left_label">
                    <ul>
                        <li>
                            <div class="form_grid_12">
                                <button type="button" class="btn_small btn_blue" onClick="GetSensor()"><span>Generate Sensor</span></button>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="widget_content">
                <h4 style="text-align: center;margin-bottom:10px;">TABLE DEVICE</h4>
                <table id="table_device" class="display data_tbl">
                    <thead>
                        <tr>
                            <th>
                                area_id
                            </th>
                            <th>
                                block_area_name
                            </th>
                            <th>
                                device_id
                            </th>
                            <th>
                                gps_location_lat
                            </th>
                            <th>
                                gps_location_lng
                            </th>
                            <th>
                                createdAt
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($device as $d)
                            <tr>
                                <td>{{$d->area_id}}</td>
                                <td>{{$d->block_area_name}}</td>
                                <td>{{$d->device_id}}</td>
                                <td>{{$d->gps_location_lat}}</td>
                                <td>{{$d->gps_location_lng}}</td>
                                <td>{{$d->createdAt}}</td>
                            </tr>
                        @endforeach
                    </tbody>    
                </table>
                <h4 style="text-align: center;margin-bottom:10px;">TABLE SENSOR</h4>
                <table id="table_sensor" class="display data_tbl">
                    <thead>
                        <tr>
                            <th>
                                sensor_company_id
                            </th>
                            <th>
                                device_id
                            </th>
                            <th>
                                sensor_master_id
                            </th>
                            <th>
                                company_id
                            </th>
                            <th>
                                createdAt
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sensor as $s)
                            <tr>
                                <td>{{$s->sensor_company_id}}</td>
                                <td>{{$s->device_id}}</td>
                                <td>{{$s->sensor_master_id}}</td>
                                <td>{{$s->company_id}}</td>
                                <td>{{$s->createdAt}}</td>
                            </tr>
                        @endforeach
                    </tbody>    
                </table>
                <h4 style="text-align: center;margin-bottom:10px;">TABLE PENGAMATAN SENSOR</h4>
                <table id="table_pengamatan_sensor" class="display data_tbl">
                    <thead>
                        <tr>
                            <th>
                                sensor_id
                            </th>
                            <th>
                                sensor_name
                            </th>
                            <th>
                                sensor_unit
                            </th>
                            <th>
                                is_water_level
                            </th>
                            <th>
                                is_rainfall
                            </th>
                            <th>
                                id
                            </th>
                            <th>
                                sensor_company_id
                            </th>
                            <th>
                                device_id
                            </th>
                            <th>
                                value_raw
                            </th>
                            <th>
                                value_calibration
                            </th>
                            <th>
                                created_at
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengamatan as $p)
                            <tr>
                                <td>{{$p->sensor_id}}</td>
                                <td>{{$p->sensor_name}}</td>
                                <td>{{$p->sensor_unit}}</td>
                                <td>{{$p->is_water_level}}</td>
                                <td>{{$p->is_rainfall}}</td>
                                <td>{{$p->id}}</td>
                                <td>{{$p->sensor_company_id}}</td>
                                <td>{{$p->device_id}}</td>
                                <td>{{$p->value_raw}}</td>
                                <td>{{$p->value_calibration}}</td>
                                <td>{{$p->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>    
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function() {
            var success = '@if (Session::has("success")){{ Session::get("success") }}@endif';
            var error = '@if (Session::has("error")){{ Session::get("error") }}@endif';

            if(success){
                var noty_id = noty({
                    layout : 'top',
                    text: success,
                    modal : true,
                    type : 'success', 
                });
            }
            if(error){
                var noty_id = noty({
                    layout : 'top',
                    text: error,
                    modal : true,
                    type : 'error', 
                });
            }
        });
    </script>
    <script>
        function GetSensor(){
            var token = '';
            var obj = JSON.parse('{ "strategy":"web", "email":"developer.mertani+ggpAdm@gmail.com", "password":"satuU15@"}');
            $.ajax('https://api.mertani.co.id/users/login',{
                'data': JSON.stringify(obj), //{action:'x',params:['a','b','c']}
                'type': 'POST',
                'processData': false,
                'contentType': 'application/json',
                'success' : function(data){
                    token = data.data.accessToken;
                    $.ajax({
                        url: "https://api.mertani.co.id/devices",
                        type: 'GET',
                        // Fetch the stored token from localStorage and set in the header
                        headers: {"Authorization": token},
                        success: function(data){
                            var datajson = JSON.stringify(data.data.data);
                            $.ajax({
                                url: "/console/sensor/plantation",
                                type: 'POST',
                                dataType: "json",
                                data: {'data':datajson},
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                success: function(data){
                                    var dnow = new Date();
                                    var today = formatDate(dnow);
                                    var dmin = dnow.setDate(dnow.getDate() - 1);
                                    var yesterday = formatDate(dmin);
                                    for(var i=0;i<=data.length-1;i++){
                                        $.ajax({
                                            url: "https://api.mertani.co.id/sensors/records?sensor_company_id="+data[i].sensor_company_id+"&start="+today+"T00:00:00.980Z&end="+today+"T23:59:59.980Z&timezone=7",
                                            type: 'GET',
                                            // Fetch the stored token from localStorage and set in the header
                                            headers: {"Authorization": token},
                                            success: function(data){
                                                if(data.data.data.length != 0){
                                                    var datarecords = JSON.stringify(data.data.data[0].sensor_records);
                                                    var datamaster = JSON.stringify(data.data.data[0].sensor_master);
                                                    $.ajax({
                                                        url: "/console/sensor/pengamatan",
                                                        type: 'POST',
                                                        dataType: "json",
                                                        data: {'records':datarecords,'master':datamaster},
                                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                        success: function(data){
                                                            console.log(data);
                                                        }
                                                    });
                                                }else{
                                                    console.log(data);
                                                }
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    });
                }
            });
        }
    </script>
    <script>
        function GetDataLebung(){
            var dnow = new Date();
            var today = formatDate(dnow);
            var dmin = dnow.setDate(dnow.getDate() - 1);
            var yesterday = formatDate(dmin);
            $.ajax({
                url: 'http://lebungapi.gg-foods.com/api?startDate='+yesterday+'&endDate='+today+'&source=OP1',
                success: function(data){
                    var json = JSON.stringify(data.data);
                    $.ajax({
                        type: "POST",
                        url: '/console/sensor/lebung',
                        data: {'data':json},
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        success: function(data){
                            location.reload();
                        }
                    });
                }
            });
        }

        function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            }
    </script>
@stop