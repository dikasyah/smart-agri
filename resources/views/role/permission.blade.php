@extends('layouts.master')
@section('title', 'Permission')

@section('content')
    <div class="grid_12">
        <div class="widget_wrap">
            <div class="widget_top">
                <span class="h_icon blocks_images"></span>
                <h6>Role : <i>{{$role->name}}</i></h6>
            </div>
            <div class="widget_content">
                <div class="form_input" style="margin: 10px">
                    <select data-placeholder="Pilih permission ..." class="chzn-select full" name="database_selected" style="width:300px;" tabindex="20">
                        <option value=""></option>
                        @foreach($permission as $p)
                            <option value="{{$p->name}}">{{$p->name}}</option>
                        @endforeach
                    </select>
                    <div class="btn_30_blue">
                        <a href="#" title="Grant Permission" onclick="GrantPermission()"><span class="icon add_co"></span><span class="btn_link">Tambahkan</span></a>
                    </div>
                    <div class="btn_30_blue">
                        <a href="/console/role" title="Back"><span class="icon arrow_undo_co"></span><span class="btn_link">Back</span></a>
                    </div>
                </div>
                <table id="table_permission" class="display data_tbl">
                    <thead>
                        <tr>
                            <th>
                                Permission Name
                            </th>
                            <th>
                                Created At
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permission as $p)
                            <tr>
                                <td>{{$p->name}}</td>
                                <td>{{$p->created_at}}</td>
                                <td class="center">
                                    <div class="btn_30_dark">
                                        <a href="#" title="Delete Permission" onclick="Delete({{$p->id}})"><span class="icon delete_co"></span></a>
                                    </div>
                                </td>
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

        function Delete(id){
            $.confirm({
                'title'		: 'Hapus Permission',
                'message'	: 'Apakah anda yakin ingin menghapus data permission ini ?',
                'buttons'	: {
                    'Ya'	: {
                        'class'	: 'yes',
                        'action': 
                        function(){
                            $.ajax
                            ({
                                type: 'GET',
                                url: "/console/role/"+id+"/permission",
                                dataType: 'json',
                                success: function(response)
                                {
                                    if(response == "berhasil"){
                                        location.reload(true);
                                    }
                                }
                            });
                        }
                    },
                    'Tidak'	: {
                        'class'	: 'no',
                    }
                }
            });
        }
    </script>
@stop