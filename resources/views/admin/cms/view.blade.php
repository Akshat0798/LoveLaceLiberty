@extends('admin.layouts.layout')
@section('content')
<link rel="stylesheet" href="{{ asset('public/admintheme/dist/css/form_custom.css')}}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         {{ trans('admin_lang.'.$langPath) }}
         <small>{{ trans('admin_lang.view').' '.trans('admin_lang.'.$langPath) }}</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="{!! url('admin/dashboard') !!}"><i class="fa fa-dashboard"></i> {{ trans('admin_lang.home') }}</a></li>
         <li class="active"><a href="{!! routeUser($pagePath.'.index') !!}">{{ trans('admin_lang.'.$langPath) }}</a></li>
         <li class="active"> {{ trans('admin_lang.view').' '.trans('admin_lang.'.$langPath) }}</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- Info boxes -->
      <div class="row">
         <div class="col-xs-12">
            <div class="box">
               <div class="box-header">
                   <a class="btn btn-social btn-primary" href="{{routeUser($pagePath.'.index')}}">
                        <i class="fa fa-arrow-circle-o-left"></i> {{ trans('admin_lang.back') }}
                        </a>
                  <!-- <h3 class="box-title">Hover Data Table</h3> -->
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="row">
   <div class="col-sm-12">
      <div class="bg box box-default">
                   <table class="table table-striped table-bordered" >
                       <tbody>
                            <tr>
                                <th style="width:30%">{{__('admin_lang.title')}}</th>
                                <td style="width:70%">{{ucfirst($sdata->title)}}</td>
                            </tr>
                            <tr>
                                <th>{{__('admin_lang.description')}}</th>
                                <td>{!!$sdata->content !!}</td>
                            </tr>                            
                            <tr>
                                <th>{{__('admin_lang.status')}}</th>
                                <td>
                                    @if($sdata->status=='1')
                                    <span class="label label-success">Active</span>
                                    @else
                                    <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>                           
                            <tr>
                                <th>{!!__('admin_lang.created_at')!!}</th>
                                <td>
                                    {{$sdata->created_at->format('M d, Y')}}
                                </td>
                            </tr> 
                            <tr>
                                <th>{!!__('admin_lang.updated_at')!!}</th>
                                <td>
                                    {{$sdata->updated_at->format('M d, Y')}}
                                </td>
                            </tr>
                       </tbody>
                   </table>
                    </div>
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </div>
      </div>
      </div>
      </div>
       </section>
   <!-- /.content -->
</div>
      <!-- /.row -->
  
<!-- /.content-wrapper -->
@endsection

