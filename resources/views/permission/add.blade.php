@extends('layouts.master')
@section('title', 'Permission')

@section('content')
    <div class="grid_12">
        <div class="widget_wrap">
            <div class="widget_top">
                <span class="h_icon blocks_images"></span>
                <h6>Add Permission</h6>
            </div>
            <div class="widget_content">
                <div class="btn_30_blue">
                    <a href="/console/permission" title="Back"><span class="icon arrow_undo_co"></span><span class="btn_link">Back</span></a>
                </div>
                <form action="/console/permission/add" method="post" class="form_container left_label">
                    @csrf
                    <div>
                        <ul>
                            <li>
                                <fieldset>
                                    <legend>Add Permission</legend>
                                    <ul>
                                        <li>
											<div class="form_grid_12">
												<label class="field_title">Name</label>
												<div class="form_input">
                                                    <input name="name" type="text" required>
                                                    @if($errors->has('name'))
                                                        <span class="input_instruction red">{{$errors->first('name')}}</span>
                                                    @endif
												</div>
											</div>
										</li>
                                        <li>
                                            <div class="form_grid_12">
                                                <label class="field_title">Database</label>
                                                <div class="form_input">
                                                    <select id="database_name" name="database_name" style="width:300px;padding:3px 6px;border:#d8d8d8 1px solid;">
                                                        <option value=""></option>
                                                        @foreach($table as $t)
                                                            <option value="{{$t->TABLE_CATALOG}}">{{$t->TABLE_CATALOG}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('database_name'))
                                                        <span class="input_instruction red">{{$errors->first('database_name')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        <li>
											<div class="form_grid_12">
												<label class="field_title">Stored Procedure</label>
												<div class="form_input">
                                                    <select id="stored_procedure" name="stored_procedure" style="width:300px;padding:3px 6px;border:#d8d8d8 1px solid;">
                                                        <option value=""></option>
                                                    </select>
                                                    @if($errors->has('stored_procedure'))
                                                        <span class="input_instruction red">{{$errors->first('stored_procedure')}}</span>
                                                    @endif
												</div>
											</div>
										</li>
                                    </ul>
                                </fieldset>
                            </li>
                            <ul>
                                <li>
                                    <div class="form_input" style="margin:0px !important;">
                                        <button type="submit" class="btn_small btn_blue"><span>Save</span></button>
                                    </div>
                                </li>
                            </ul>
                        </ul>
                    </div>
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
    <script>
        $('#database_name').on('change', function() {
            var sp = document.getElementById('stored_procedure');
            var db = document.getElementById("database_name");
            var db_selected = db.value;
            sp.innerHTML = "";
            if(this.value != ""){
                $.ajax({
                    url: "/console/permission/db_select",
                    type: 'POST',
                    dataType: "JSON",
                    data: {'database_name':db_selected},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data){
                        console.log(data);
                        var opt = document.createElement('option');
                        opt.appendChild( document.createTextNode("") );
                        opt.value = ""; 
                        sp.appendChild(opt);
                        for(var i=0;i<=data.length-1;i++){
                            var opt = document.createElement('option');
                            opt.appendChild( document.createTextNode(data[i].name) );
                            opt.value = data[i].name; 
                            sp.appendChild(opt);
                        }
                    }
                });
            }
        });
    </script>
@stop