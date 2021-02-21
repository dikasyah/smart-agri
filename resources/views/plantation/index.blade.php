@extends('layouts.master')
@section('title', 'Plantation')

@section('content')
    <div class="grid_12 full_block">
        <div class="widget_wrap">
            <div class="widget_top">
                <span class="h_icon list_image"></span>
                <h6>Plantation</h6>
            </div>
            <div class="widget_content">
                <form action="/console/plantation" method="POST" enctype="multipart/form-data" class="form_container left_label">
                    @csrf
                    <ul>
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title">Location Plantation</label>
                                <div class="form_input">
                                    <input type="file" id="plantation" name="plantation" required>
                                    @if($errors->has('plantation'))
                                        <span class="input_instruction red">{{$errors->first('plantation')}}</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form_grid_12">
                                <div class="form_input">
                                    <button type="submit" class="btn_small btn_blue"><span>Upload</span></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </form>
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