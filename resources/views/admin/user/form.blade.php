<link rel="stylesheet" href="{{ asset('public/assets/css/intlTelInput.css') }}">
<style type="text/css">
    .error {
        font-size: 16px;
        color: red;
    }

    .file-caption {
        display: none !important;
    }

    .close {
        display: none !important;
    }

    .hidden-xs {
        display: none !important;
    }

    .file-preview-status {
        display: none !important;
    }

    .btn-outline-secondary {
        display: none !important;
    }

    .kv-preview-data {
        max-width: 20% !important;
    }

    .file-drop-zone-title,
    .file-thumbnail-footer {
        display: none !important;
    }

    .file-preview-image {
        margin-bottom: 10px;
    }

    /*.btn-file{background-color: #df2d64;}*/
    /*.btn-file:hover {
        background-color: #df2d64;
    }*/
</style>
<div class="card">
    <div class="card-body">
        <div class="tab-content mt-2 mb-3" id="pills-tabContent">
            <div class="first-panel">

                <div class="row">

                    <input type="hidden" name="type" value="{{ $typePath }}">
                    <div class="col-md-12">
                        <label for="name" class="control-label label-custom required">
                            {!! trans('admin_lang.user_name') !!}*</label>
                        <div class="form-group @if ($errors->has('user_name')) has-error @endif">
                            {!! Form::text('user_name', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('Enter the name'),
                            ]) !!}
                            @if ($errors->has('user_name'))
                                <span class="error" style="">{{ $errors->first('user_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="name" class="control-label label-custom required">
                            First Name*</label>
                        <div class="form-group @if ($errors->has('first_name')) has-error @endif">
                            {!! Form::text('first_name', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('Enter the name'),
                            ]) !!}
                            @if ($errors->has('first_name'))
                                <span class="error" style="">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="name" class="control-label label-custom required">
                            Last Name*</label>
                        <div class="form-group @if ($errors->has('last_name')) has-error @endif">
                            {!! Form::text('last_name', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('Enter the name'),
                            ]) !!}
                            @if ($errors->has('last_name'))
                                <span class="error" style="">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="email"
                            class="control-label label-custom required">{{ trans('admin_lang.email') }}*</label>
                        <div class="form-group  @if ($errors->has('email')) has-error @endif">
                            {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => trans('admin_lang.enter_the_email')]) }}
                            @if ($errors->has('email'))
                                <span class="error">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="mobile_number"
                            class="control-label label-custom required">{{ trans('admin_lang.mobile_number') }}</label><br>
                        <div class="form-group @if ($errors->has('mobile_number')) has-error @endif">
                            {{ Form::tel('mobile_number', null, ['class' => 'form-control', 'id' => 'mobile_number', 'placeholder' => trans('Enter the number')]) }}
                            @if ($errors->has('mobile_number'))
                                <span class="error">{{ $errors->first('mobile_number') }}</span>
                            @endif
                        </div>
                    </div>

                    @if (empty($sdata))
                        <div class="col-md-12">
                            <label for="password"
                                class="control-label label-custom required">{{ trans('admin_lang.password') }}*</label><br>
                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                {{ Form::tel('password', null, ['class' => 'form-control', 'id' => 'password', 'placeholder' => trans('Enter the password')]) }}

                                @if ($errors->has('password'))
                                    <span class="error">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                    @endif

                   
                    <div class="col-md-12">
                        <div class="">
                            <label for="cuisines"
                                class="control-label label-custom required">{{ trans('admin_lang.upload_profile') }}</label>
                            <div id="releaseCover" class="">
                                <div class="file-loading">
                                    <input id="file-1" type="file" name="album_profile" class="file"
                                        data-overwrite-initial="true" style="border: 1px solid #d1d3e2; width:100%" accept="image/png, image/gif, image/jpeg">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card-action">
                <button type="submit"
                    class="btn btn-primary btn-sm form_submit">{{ trans('admin_lang.submit') }}</button>
                <a href="{{ routeUser($pagePath . '.index') }}"><button type="button"
                        class="btn btn-danger btn-sm">{{ trans('admin_lang.cancel') }}</button><a>
            </div>
        </div>
    </div>
</div>
<?php
$title = isset($sdata->title) ? $sdata->title : '';

$oldrol = old('role');
if (!empty($oldrol)) {
    $roleOldVal = $oldrol;
} else {
    $roleOldVal = '0';
}
?>

<script>
    var url1 = '{{ asset(@$sdata->profile_image) }}';
   

</script>

@section('styles')
    <style>
        .file-actions .file-footer-buttons,
        .file-thumbnail-footer .file-upload-indicator {
            display: none
        }

        .btn.btn-file {
            padding: .65rem 1.4rem;
            background: #31ce36 !important;
            border-color: #31ce36 !important;
            font-size: 14px;
            color: #fff !important;
        }

        .close.fileinput-remove,
        .file-thumbnail-footer {
            display: none
        }

        
    </style>

    <link href="{{ asset('public/assets/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

