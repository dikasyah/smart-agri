@extends('layouts.master')
@section('title', 'Permission')

@section('content')
    <div class="grid_12">
        <div class="widget_wrap">
            <div class="widget_top">
                <span class="h_icon blocks_images"></span>
                <h6>{{$permission->stored_procedure}}</h6>
            </div>
            <div class="widget_content">
                <div class="btn_30_blue">
                    <a href="/console/permission" title="Back"><span class="icon arrow_undo_co"></span><span class="btn_link">Back</span></a>
                </div>
                <table id="table_sp" class="display data_tbl">
                    <thead>
                        @foreach($header as $h)
                            <td>{{$h->name}}</td>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach($data_sp as $d)
                            <tr>
                                @foreach($d as $a)
                                    <td>{{$a}}</td>
                                @endforeach
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
@stop