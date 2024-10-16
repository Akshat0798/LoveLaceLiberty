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
                            {!! trans('admin_lang.name') !!}*</label>
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            {!! Form::text('name', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('Enter the name'),
                            ]) !!}
                            @if ($errors->has('name'))
                                <span class="error" style="">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="name" class="control-label label-custom required">
                            Title*</label>
                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                            {!! Form::text('title', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('Enter the title'),
                            ]) !!}
                            @if ($errors->has('title'))
                                <span class="error" style="">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="name" class="control-label label-custom required">
                            Description*</label>
                        <div class="form-group @if ($errors->has('description')) has-error @endif">
                            {!! Form::text('description', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('Enter the description'),
                            ]) !!}
                            @if ($errors->has('description'))
                                <span class="error" style="">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="name" class="control-label label-custom required">
                            Election Type*</label>
                        <div class="form-group @if ($errors->has('election_type')) has-error @endif">
                            <select name="election_type" id="" class="form-control">
                                <option value=" ">Select Election Type</option>
                                <option value="1">federal</option>
                                <option value="2">Legislative</option>
                                <option value="3">Judicial</option>
                            </select>
                            @if ($errors->has('election_type'))
                                <span class="error" style="">{{ $errors->first('election_type') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="name" class="control-label label-custom required">
                            State*</label>
                        <div class="form-group @if ($errors->has('state')) has-error @endif">
                            <select name="state" id=""  class="form-control">
                                <option value=" ">Select State</option>
                                @foreach ($states as $value)
                                <option value="{{$value->state_abbreviation}}">{{$value->state_name}}</option>
                                @endforeach
                                
                            </select>
                            @if ($errors->has('state'))
                                <span class="error" style="">{{ $errors->first('state') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="name" class="control-label label-custom required">
                            Party*</label>
                        <div class="form-group @if ($errors->has('party')) has-error @endif">
                            {!! Form::text('party', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('Enter the party'),
                            ]) !!}
                            @if ($errors->has('party'))
                                <span class="error" style="">{{ $errors->first('party') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="name" class="control-label label-custom required">
                            Pro Tem*</label>
                        <div class="form-group @if ($errors->has('pro_Tem')) has-error @endif">
                            {!! Form::text('pro_Tem', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('Enter the Pro Tem'),
                            ]) !!}
                            @if ($errors->has('pro_Tem'))
                                <span class="error" style="">{{ $errors->first('pro_Tem') }}</span>
                            @endif
                        </div>
                    </div>


                   
                    <div class="col-md-12">
                        <div class="">
                            <label for="cuisines"
                                class="control-label label-custom required">{{ trans('admin_lang.upload_profile') }}</label>
                            <div id="releaseCover" class="">
                                <div class="file-loading">
                                    <input id="file-1" type="file" name="image" class="file"
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

