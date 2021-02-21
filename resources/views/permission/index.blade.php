@extends('layouts.master')
@section('title', 'Permission')

@section('content')
    <div class="grid_12">
        <div class="widget_wrap">
            <div class="widget_top">
                <span class="h_icon blocks_images"></span>
                <h6>Permission</h6>
            </div>
            <div class="widget_content">
                <div class="btn_30_blue">
                    <a href="/console/permission/add" title="Add Permission"><span class="icon add_co"></span><span class="btn_link">Add Permission</span></a>
                </div>
                <table id="table_user" class="display data_tbl">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Guard Name
                            </th>
                            <th>
                                Database Name
                            </th>
                            <th>
                                Stored Procedure
                            </th>
                            <th>
                                Last Updated
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permission as $p)
                            <tr>
                                <td class="center">
                                    {{$p->name}}
                                </td>
                                <td class="center">
                                    {{$p->guard_name}}
                                </td>
                                <td class="center">
                                    {{$p->database_name}}
                                </td>
                                <td class="center">
                                    {{$p->stored_procedure}}
                                </td>
                                <td class="center">
                                    {{$p->updated_at}}
                                </td>
                                <td class="center">
                                    <div class="btn_30_light">
                                        <a href="#" title="Delete Permission" onclick="Delete({{$p->id}})"><span class="icon delete_co"></span></a>
                                    </div>
                                    <div class="btn_30_light">
                                        <a href="/console/permission/view/{{$p->id}}" title="View Permission"><span class="icon eye_co"></span></a>
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
                                url: "/console/permission/delete/"+id,
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