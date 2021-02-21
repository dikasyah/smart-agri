@extends('layouts.master')
@section('title', 'Tanaman')

@section('content')
    <div class="grid_12">
        <div class="widget_wrap">
            <div class="widget_top">
                <span class="h_icon blocks_images"></span>
                <h6>Table Tanaman</h6>
            </div>
            <div class="widget_content">
                <div class="btn_30_blue">
                    <a href="/console/tanaman/add" title="Add Tanaman"><span class="icon add_co"></span><span class="btn_link">Add Tanaman</span></a>
                </div>
                <table id="table_tanaman" class="display data_tbl">
                    <thead>
                        <tr>
                            <th>
                                Nama
                            </th>
                            <th>
                                Updated At
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tanaman as $t)
                            <tr>
                                <td class="center">
                                    {{$t->nama}}
                                </td>
                                <td class="center">
                                    {{$t->updated_at}}
                                </td>
                                <td class="center">
                                    <div class="btn_30_light">
                                        <a href="#" title="Delete Tanaman" onclick="Delete({{$t->id}})"><span class="icon delete_co"></span></a>
                                    </div>
                                    <div class="btn_30_light">
                                        <a href="/console/tanaman/detail/{{$t->id}}" title="Edit Tanaman"><span class="icon application_edit_co"></span></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>
                                Nama
                            </th>
                            <th>
                                Updated At
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </tfoot>
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
                'title'		: 'Hapus Tanaman',
                'message'	: 'Apakah anda yakin ingin menghapus data tanaman ini ?',
                'buttons'	: {
                    'Ya'	: {
                        'class'	: 'yes',
                        'action': 
                        function(){
                            $.ajax
                            ({
                                type: 'GET',
                                url: "/console/tanaman/delete/"+id,
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