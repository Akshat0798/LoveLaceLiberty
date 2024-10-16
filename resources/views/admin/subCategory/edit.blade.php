@extends('admin.layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="page-inner">
        <h4 class="page-title">{{ trans('admin_lang.edit') }} {{ trans("admin_lang.sub") }}</h4>

        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="col-md-2 pull-left" style=" float: left;">
                    <a href="{{ routeUser($pagePath . '.index') }}"><i style="font-size:24px" class="fa">&#xf060;</i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    {!! Form::model($sdata, [
                        'route' => [routeFormUser($pagePath . '.update'), encrypt($sdata->id)],
                        'method' => 'patch',
                        'files' => true,
                        'class' => 'upload_submit',
                    ]) !!}
                    @include('admin.' . $pagePath . '.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
