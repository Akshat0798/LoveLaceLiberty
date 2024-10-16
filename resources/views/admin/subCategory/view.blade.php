@extends('admin.layouts.layout')
@section('content')
<link rel="stylesheet" href="{{ asset('public/admintheme/dist/css/form_custom.css')}}">
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         <small> &nbsp; {{ trans('admin_lang.view').' '.trans('admin_lang.keyword') }}</small>
      </h1>
   </section>
   <section class="content">
      
         <div class="col-xs-12">
            <div class="box">
               
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="row" style="padding: 25px;">
                    <div class="col-sm-12">
                        <div class="box-header">
                           <a class="btn btn-social btn-primary" href="{{routeUser($pagePath.'.index')}}">
                                <i class="fa fa-arrow-circle-o-left"></i> {{ trans('admin_lang.go_back') }}
                                </a>
                       </div>
                       <br>
                    <div class="bg box box-default">
                    <table class="table table-striped table-bordered" >
                       <tbody>
                        <tr>
                            <td>{{ trans("admin_lang.category") }} {{ trans("admin_lang.name") }}</td>
                            <td>{{ucfirst($sdata->parent->interest_name)}}</td>
                        </tr> 
                            <tr>
                                <td>{{ trans("admin_lang.keyword") }} {{ trans("admin_lang.name") }}</td>
                                <td>{{ucfirst($sdata->interest_name)}}</td>
                            </tr>                          
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($sdata->status=='1')
                                    <span class="label label-success">Active</span>
                                    @else
                                    <span class="label label-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>                           
                            <tr>
                                <th>Created on</th>
                                <td>
                                    {{date('M-d-Y', strtotime($sdata->created_at))}}
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
     
       </section>
   <!-- /.content -->
</div>
      <!-- /.row -->
  
<!-- /.content-wrapper -->
@endsection

