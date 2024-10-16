@extends('admin.layouts.layout')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">{{ __('admin_lang.add').' '.__('admin_lang.country')}}</h1>
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
                                                <div class="form-group @if ($errors->has('sortname')) has-error @endif">
                                                    <label for="title_in_EN" class="control-label required">{!! trans('Short Name') !!}</label>
                                                    <input type="text"  name="sortname" class="form-control" placeholder="Enter Short Name"  maxlength="3" minlength="2">
                                                    @if ($errors->has('sortname'))<span class="error">{{ $errors->first('sortname') }}</span>@endif
                                                </div>
                                                <div class="form-group @if ($errors->has('name')) has-error @endif">
                                                    <label for="title_in_EN" class="control-label required">{!! trans('admin_lang.name') !!}</label>
                                                    <input type="text"  name="name" class="form-control" placeholder="Enter Country Name">
                                                    @if ($errors->has('name'))<span class="error">{{ $errors->first('name') }}</span>@endif
                                                </div>
                                                <div class="form-group @if ($errors->has('phonecode')) has-error @endif">
                                                    <label for="title_in_EN" class="control-label required">{!! trans('admin_lang.phonecode') !!}</label>
                                                    <input type="number"  name="phonecode" class="form-control" placeholder="Enter Phonecode" onKeyPress="if(this.value.length==10) return false;">
                                                    @if ($errors->has('phonecode'))<span class="error">{{ $errors->first('phonecode') }}</span>@endif
                                                </div>
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
                <style>
                    /* Chrome, Safari, Edge, Opera */
                    input::-webkit-outer-spin-button,
                    input::-webkit-inner-spin-button {
                      -webkit-appearance: none;
                      margin: 0;
                    }
                    
                    /* Firefox */
                    input[type=number] {
                      -moz-appearance: textfield;
                    }
                    </style>
@endsection

