@extends('admin.layouts.layout')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">{{ trans("admin_lang.add") }} Candidate</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
                            <div class="col-md-2 pull-left" style=" float: left;">
                                <a href="{{routeUser($pagePath.'.index')}}">
                                <i style="font-size:24px" class="fa">&#xf060;</i>
                            </a>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                {{Form::open(array('route' => [routeFormUser($pagePath.'.store')],'files'=>true, 'class'=> 'upload_submit'))}}
                    @include('admin.'.$pagePath.'.form')
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection