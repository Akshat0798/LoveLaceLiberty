@extends('admin.layouts.layout')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">{{ trans("admin_lang.add") }} {{ trans("admin_lang.transaction") }}</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
                            <div class="col-md-2 pull-left" style=" float: left;">
                                <a href="{{routeUser($pagePath.'.index')}}"><i style="font-size:24px" class="fa">&#xf060;</i>
                            </a>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                {{Form::open(array('route' => [routeFormUser($pagePath.'.store')],'files'=>true, 'class'=>'upload_submit'))}}
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <select class="form-control" name="id" required  >
                                                        <option value="" >Select user</option>
                                                        @foreach ($business as $data)
                                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                        </select> 
                                                        @if ($errors->has('id'))<span class="error">{{ $errors->first('id') }}</span>@endif
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="plan" required >
                                                        <option value="" >Select Plan</option>
                                                        <option  value="basic">Basic</option>
                                                        <option  value="enhanced">Enhanced</option>
                                                        <option  value="premium">premium</option>

                                                        </select> 
                                                        @if ($errors->has('plan'))<span class="error">{{ $errors->first('plan') }}</span>@endif
                                                </div>
                                                {{-- <div class="form-group">
                                                    <select class="form-control" name="price" required >
                                                        <option value="" >Select Price</option>
                                                        <option  value="100">100</option>
                                                        <option  value="70">70</option>
                                                        <option  value="50">50</option>

                                                        </select> 
                                                        @if ($errors->has('price'))<span class="error">{{ $errors->first('price') }}</span>@endif
                                                </div> --}}
                                                {{-- <div class="form-group @if ($errors->has('description')) has-error @endif">
                                                    <label for="title_in_EN" class="control-label required" id="keyword">{{ trans("admin_lang.description") }}</label>
                                                    {!! Form::textarea('description',Null,['class'=>'form-control','placeholder'=>"Enter description"])!!}
                                                    @if ($errors->has('description'))<span class="error">{{ $errors->first('description') }}</span>@endif
                                                </div> --}}
                                            </div>                                                         
                                        </div>
                                        <div class="card-action">
                                            <button type="submit" class="btn btn-primary btn-sm form_submit">{{ trans('admin_lang.submit') }}</button>
                                            <a href="{{ routeUser($pagePath.'.index') }}"><button type="button" class="btn btn-danger btn-sm">{{ trans('admin_lang.cancel') }}</button><a>
                                        </div>
                                    </div>
                                
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                <!-- ====== -->
                <style type="text/css">
                    .error{font-size: 15px;
                    color: red;}
                </style>
                <style type="text/css">
                    .ck{height: 250px;}
            
                </style>
            
@endsection

