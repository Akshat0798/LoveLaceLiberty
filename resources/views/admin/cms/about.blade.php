@extends('admin.layouts.layout')
@section('content')
<div class="content">
    <div class="page-inner">
        <h4 class="page-title">{{ trans('admin_lang.'.$langPath) }}</h4>
        <div class="page-header">

            <ul class="breadcrumbs">


                <li class="nav-home">
                    <a href="{!! url('admin/dashboard') !!}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{!! routeUser($pagePath.'.index',['type'=>$langPath]) !!}">{{ trans('admin_lang.'.$langPath) }}</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">{{ trans('admin_lang.add').' '.trans('admin_lang.new').' '.trans('admin_lang.'.$langPath) }}</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{Form::open(array('route' => [routeFormUser($pagePath.'.aboutstore'),$langPath],'files'=>true, 'class'=>'upload_submit'))}}
                <link rel="stylesheet" href="{{ asset('public/assets/css/intlTelInput.css') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12 col-lg-12">
                                <div class="form-group @if ($errors->has('title')) has-error @endif">
                                    <label for="title" class="control-label required">{!! trans('admin_lang.title') !!}</label>
                                    {!! Form::text('title',null,['class'=>'form-control','placeholder'=>(trans("admin_lang.enter_the_title"))])!!}
                                    @if ($errors->has('title'))<span class="error">{{ $errors->first('title') }}</span>@endif
                                </div>
                                <div class="form-group loaction_class @if ($errors->has('content')) has-error @endif">
                                    <label for="description" class="control-label required">{{ trans("admin_lang.description") }}</label>
                                    {{ Form::textarea('description',null,['class'=>'form-control','id'=>'description','placeholder'=>trans("admin_lang.description")])}}
                                    @if ($errors->has('description'))<span class="error">{{ $errors->first('description') }}</span>@endif
                                </div> 
                            </div>                                                         
                        </div>

                    </div>
                    <div class="card-action">

                        <button type="submit" class="btn btn-primary btn-sm form_submit">{{ trans('admin_lang.submit') }}</button>
                        <a href="{{ routeUser($pagePath.'.index',['type'=>$langPath]) }}"><button type="button" class="btn btn-danger btn-sm">{{ trans('admin_lang.cancel') }}</button><a>
                                </div>
                                </div>
                                {{ Form::close() }}
                                </div>
                                </div>
                                </div>
                                </div>

                                @endsection
                                @section('script')
                                <script type="text/javascript" src="{{ asset('public/assets/ckeditor/ckeditor.js') }}"></script>
                                <script type="text/javascript">
$(document).ready(function () {
    CKEDITOR.replace('description', {
        toolbar: [

            {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']},
            {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
            {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        ]
    });
    $('.form_submit').click(function () {
        $(".upload_submit").validate({
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {

                $(element).closest('.form-group').removeClass('has-error');

            },

            rules: {
                title: {
                    required: true,
                    maxlength: 50,
                },
                 description: {
                    required: true,
                },
            },
            messages: {
                title: {
                    required: "Please enter title",
                    maxlength: "You can not enter more than 50 characters.",
                },
                description: {
                    required: "please enter description",
                },
            }
        });
        if ($('.upload_submit').valid()) {
            $('.upload_submit').submit();
        }
    });
});
                                </script>

                                <style>
                                    .upload_submit label.error {
                                        width: auto;
                                        display: inline;
                                        font-weight: 500;
                                    }   
                                </style>

                                @endsection 
