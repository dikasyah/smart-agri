@extends('layouts.master')
@section('title', 'Report')

@section('content')
<div class="grid_12">
    <div class="widget_wrap">
        <div class="widget_top">
            <span class="h_icon list"></span>
            <h6>Data</h6>
        </div>
        <div class="widget_content">
            <div style="margin:20px;">
                <div class="form_input">
                    <div class="btn_30_dark">
                        <a href="#"><span class="icon doc_excel_table_co"></span><span class="btn_link">Export to Excel</span></a>
                    </div>
                </div>
            </div>
            <div style="margin:20px;">
                <div class="form_input">
                    <select id="selectdb" data-placeholder="Select Database" style="width:200px;">
                        <option value=""></option>
                        @foreach($database as $db)
                            <option value="{{$db->name}}">{{$db->name}}</option>
                        @endforeach
                    </select>
                    <select id="selecttable" data-placeholder="Select Table" style="width:250px">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <table id="table_data" class="display data_tbl">
                <thead>
                    <tr>
                        <th>
                            none
                        </th>
                        <th>
                            none
                        </th>
                        <th>
                            none
                        </th>
                    </tr>
                </thead>
                <tbody id="td_data">
                    
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
        $('#selectdb').on('change', function() {
            var parrent = document.getElementById('selecttable');
            parrent.innerHTML = "";
            if(this.value != ""){
                $.ajax({
                    url: "/console/report/db/"+this.value,
                    type: 'GET',
                    success: function(data){
                        var opt = document.createElement('option');
                        opt.appendChild( document.createTextNode("") );
                        opt.value = ""; 
                        parrent.appendChild(opt);
                        for(var i=0;i<=data.length-1;i++){
                            var opt = document.createElement('option');
                            opt.appendChild( document.createTextNode(data[i].TABLE_NAME) );
                            opt.value = data[i].TABLE_NAME; 
                            parrent.appendChild(opt);
                        }
                    }
                });
            }
        });
    </script>
    <script>
        $('#selecttable').on('change', function() {
            var td_data = document.getElementById('td_data');
            td_data.innerHTML = "";
            var db = document.getElementById("selectdb").value;
            if(this.value != ""){
                $.ajax({
                    url: "/console/report/table",
                    type: 'POST',
                    dataType: "JSON",
                    data: {'data':datajson},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data){
                        var html = "";
                        for(var i=0;i<=data.length-1;i++){
                            
                        }
                    }
                });
            }
        });
    </script>
@stop