@extends('layouts.master')
@section('title', 'Add Role')

@section('content')
    <div class="grid_12 full_block">
        <div class="widget_wrap">
            <div class="widget_top">
                <span class="h_icon list_image"></span>
                <h6>Add Role</h6>
            </div>
            <div class="widget_content">
                <form action="/console/role/add" method="POST" class="form_container left_label">
                    @csrf
                    <ul>
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title">Name</label>
                                <div class="form_input">
                                    <input name="name" type="text" tabindex="1" class="limiter" required/>
                                    @if($errors->has('name'))
                                        <span class="input_instruction red">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form_grid_12">
                                <div class="form_input">
                                    <button type="submit" class="btn_small btn_blue"><span>Save</span></button>
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