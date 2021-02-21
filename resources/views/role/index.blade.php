@extends('layouts.master')
@section('title', 'Role')

@section('content')
    <div class="grid_12">
        <div class="widget_wrap">
            <div class="widget_top">
                <span class="h_icon blocks_images"></span>
                <h6>Table Role</h6>
            </div>
            <div class="widget_content">
                <div class="btn_30_blue">
                    <a href="/console/role/add" title="Add Role"><span class="icon add_co"></span><span class="btn_link">Add Role</span></a>
                </div>
                <table id="table_role" class="display data_tbl">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Guard Name
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
                        @foreach($role as $r)
                            <tr>
                                <td>{{$r->id}}</td>
                                <td>{{$r->name}}</td>
                                <td>{{$r->guard_name}}</td>
                                <td>{{$r->updated_at}}</td>
                                <td class="center">
                                    <div class="btn_30_light">
                                        <a href="#" title="Delete Role" onclick="Delete({{$r->id}})"><span class="icon delete_co"></span></a>
                                        <a href="/console/role/{{$r->id}}/permission" title="Role Permission"><span class="icon lock_co"></span></a>
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
                'title'		: 'Hapus Role',
                'message'	: 'Apakah anda yakin ingin menghapus data role ini ?',
                'buttons'	: {
                    'Ya'	: {
                        'class'	: 'yes',
                        'action': 
                        function(){
                            $.ajax
                            ({
                                type: 'GET',
                                url: "/console/role/delete/"+id,
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