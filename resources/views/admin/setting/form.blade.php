<link rel="stylesheet" href="{{ asset('public/assets/css/intlTelInput.css') }}">
<style type="text/css">
    .error{font-size: 16px;
    color: red;}
    .file-caption{display: none !important;}
    .close{display: none !important;}
    .hidden-xs{display: none !important;}
    .file-preview-status{display: none !important;}
    .btn-outline-secondary{display: none !important;}
    .kv-preview-data{max-width: 20% !important;}
    .file-drop-zone-title,.file-thumbnail-footer{display: none !important;}
    .file-preview-image {margin-bottom: 10px;}
    /*.btn-file{background-color: #df2d64;}*/
    /*.btn-file:hover {
        background-color: #df2d64;
    }*/
</style>
<div class="card">
    <div class="card-body">
        <div class="tab-content mt-2 mb-3" id="pills-tabContent">
            <div class="first-panel">
                <div class="row1">
                    <input type="hidden" name="type" value="{{$typePath}}">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="android_version" class="control-label label-custom required"> Android Version</label>                                          
                                <div class="form-group @if ($errors->has('android_version')) has-error @endif">
                                    {!! Form::text('android_version',null,['class'=>'form-control','placeholder'=>'Android Version'])!!}
                                    @if ($errors->has('android_version'))<span class="error" style="">{{ $errors->first('android_version') }}</span>@endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="ios_version" class="control-label label-custom required"> IOS Version</label>                                          
                                <div class="form-group @if ($errors->has('ios_version')) has-error @endif">
                                    {!! Form::text('ios_version',null,['class'=>'form-control','placeholder'=>'IOS Version'])!!}
                                    @if ($errors->has('ios_version'))<span class="error" style="">{{ $errors->first('ios_version') }}</span>@endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="android_force_update" class="control-label label-custom required"> Android Force Update</label>
                                <div class="form-group @if ($errors->has('android_force_update')) has-error @endif">
                                    <select class="form-control" name="android_force_update">
                                        <option {{ (isset($sdata) && $sdata->android_force_update=="TRUE")?'selected':'' }} value="TRUE">TRUE</option>
                                        <option {{ (isset($sdata) && $sdata->android_force_update=="FALSE")?'selected':'' }} value="FALSE">FALSE</option>
                                    </select>
                                    @if ($errors->has('android_force_update'))<span class="error" style="">{{ $errors->first('android_force_update') }}</span>@endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="ios_force_update" class="control-label label-custom required"> IOS Force Update</label>
                                <div class="form-group @if ($errors->has('ios_force_update')) has-error @endif">
                                    <select class="form-control" name="ios_force_update">
                                        <option {{ (isset($sdata) && $sdata->ios_force_update=="TRUE")?'selected':'' }} value="TRUE">TRUE</option>
                                        <option {{ (isset($sdata) && $sdata->ios_force_update=="FALSE")?'selected':'' }}  value="FALSE">FALSE</option>
                                    </select>
                                    @if ($errors->has('ios_force_update'))<span class="error" style="">{{ $errors->first('ios_force_update') }}</span>@endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="android_maintenance" class="control-label label-custom required"> Android Maintenance</label>
                                <div class="form-group @if ($errors->has('android_maintenance')) has-error @endif">
                                    <select class="form-control" name="android_maintenance">
                                        <option  {{ (isset($sdata) && $sdata->android_maintenance=="TRUE")?'selected':'' }}   value="TRUE">TRUE</option>
                                        <option {{ (isset($sdata) && $sdata->android_maintenance=="FALSE")?'selected':'' }} value="FALSE">FALSE</option>
                                    </select>
                                    @if ($errors->has('android_maintenance'))<span class="error" style="">{{ $errors->first('android_maintenance') }}</span>@endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="ios_maintenance" class="control-label label-custom required"> IOS Maintenance</label>
                                <div class="form-group @if ($errors->has('ios_maintenance')) has-error @endif">
                                    <select class="form-control" name="ios_maintenance">
                                        <option {{ (isset($sdata) && $sdata->ios_maintenance=="TRUE")?'selected':'' }}  value="TRUE">TRUE</option>
                                        <option {{ (isset($sdata) && $sdata->ios_maintenance=="FALSE")?'selected':'' }} value="FALSE">FALSE</option>
                                    </select>
                                    @if ($errors->has('ios_maintenance'))<span class="error" style="">{{ $errors->first('ios_maintenance') }}</span>@endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="android_app_link" class="control-label label-custom required"> Android App Link</label>                                          
                                <div class="form-group @if ($errors->has('android_app_link')) has-error @endif">
                                    {!! Form::text('android_app_link',null,['class'=>'form-control','placeholder'=>'IOS Version'])!!}
                                    @if ($errors->has('android_app_link'))<span class="error" style="">{{ $errors->first('android_app_link') }}</span>@endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="ios_app_link" class="control-label label-custom required"> IOS App Link</label>                                          
                                <div class="form-group @if ($errors->has('ios_app_link')) has-error @endif">
                                    {!! Form::text('ios_app_link',null,['class'=>'form-control','placeholder'=>'IOS Version'])!!}
                                    @if ($errors->has('ios_app_link'))<span class="error" style="">{{ $errors->first('ios_app_link') }}</span>@endif
                                </div>
                            </div>
                        </div> 


                        <div class="row">
                            <div class="col-md-6">
                                <label for="update_message" class="control-label label-custom required">Update Message</label>                                          
                                <div class="form-group @if ($errors->has('update_message')) has-error @endif">
                                    <textarea class="form-control" name="update_message" rows="5">{{ (isset($sdata) && $sdata->update_message!="")?$sdata->update_message:'' }}</textarea>

                                    @if ($errors->has('update_message'))<span class="error" style="">{{ $errors->first('update_message') }}</span>@endif
                                </div>
                            </div>
                        </div>   
					
                       
                   
                </div>
            </div>
            <br>
            <div class="card-action">
                <button type="submit" class="btn btn-primary btn-sm form_submit">{{ trans('admin_lang.submit') }}</button>
            </div>
		</div>
	</div>
</div>

                        
@section('styles')
<style>
    .file-actions .file-footer-buttons, .file-thumbnail-footer .file-upload-indicator { display: none}
    .btn.btn-file { padding: .65rem 1.4rem;background: #31ce36 !important; border-color: #31ce36 !important;font-size: 14px;color: #fff !important; }
    .close.fileinput-remove, .file-thumbnail-footer{ display: none}
</style>
<link href="{{ asset('public/assets/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
@endsection
@section('script')
<script src="{{ asset('public/assets/js/intlTelInput.js') }}"></script>
<script src="{{ asset('public/assets/js/fileinput.js') }}" type="text/javascript"></script>
<script>
    $("#file-1").fileinput({
    initialPreview: [url1],
            initialPreviewAsData: true,
            initialPreviewConfig: [
            {caption: "<?php echo $page_title ?>", downloadUrl: url1, size: 930321, width: "120px", key: 1},
            ],
            //allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg', 'svg'],
            allowedFileExtensions: ['jpeg', 'jpg', 'JPG', 'JPEG', 'png', 'PNG', 'gif', 'GIF'],
            overwriteInitial: true,
            maxFileSize: 2000,
            maxFilesNum: 1,
            showRemove: false,
            showUpload: false,
            browseClass: "btn btn-secondary",
            browseLabel: "Browse",
            slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
            }
    });

    // $(document).ready(function(){

    //     $('.form_submit').click(function(){
    //         validateion({
    //             name: "required",
    //             email: {
    //                 email: true,
    //                 required: true
    //             },
    //             mobile_number: "required",
    //             street_address: "required",
    //             city: "required",
    //             state: "required",
    //             role_id: "required",
    //             branch_id: "required",
    //             zip_code: {
    //         		required: true,
    //                 number: true,
    //                 digits: true,
    //                 maxlength: 8,
    //                 min: 1
    //             }
    //         });
    //         if ($('.upload_submit').valid()) {
    //             $(".loding_img").show();
    //             $('.upload_submit').submit();
    //         }
    //     });
    // });

</script>

@endsection