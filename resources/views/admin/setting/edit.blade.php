@extends('admin.layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="page-inner">
        <h4 class="page-title">{{ Illuminate\Support\Str::plural(trans('admin_lang.'.$pagePath)) }}</h4>
        <div class="page-header">
            @if(Session::has('alert-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success !</strong> {{ Session::get('alert-success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @endif

            @if(Session::has('alert-danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error !</strong> {{ Session::get('alert-danger') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::model($sdata,  ['route'=>[routeFormUser($pagePath.'.update'),encrypt($sdata->id)], 'method'=>'patch','files'=>true,'class'=>'upload_submit']) !!}
                @include('admin.'.$pagePath.'.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection