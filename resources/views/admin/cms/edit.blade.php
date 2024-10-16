@extends('admin.layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">{{ trans('admin_lang.edit') }} CMS</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">


                <div class="pull-right" style=" float: left;">
                    <a href="{{ routeUser($langPath . '.index') }}"> <i style="font-size:24px" class="fa">&#xf060;</i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                {!! Form::model($sdata,  ['route'=>[routeFormUser($pagePath.'.update'),encrypt($sdata->id) ], 'method'=>'patch','files'=>true, 'class'=>'upload_submit']) !!}
                    @include('admin.'.$pagePath.'.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection