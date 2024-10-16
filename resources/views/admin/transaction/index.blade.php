@extends('admin.layouts.layout')
@section('content')
<style>
.changeStatus {
    width: 48% !important;
}
.show{
    width: 100% !important;
}
</style>
<div class="container-fluid">      
    <div class="page-inner">          
        <h4 class="page-title">{{ trans('admin_lang.transaction') }} {{ trans('admin_lang.manage') }}</h4>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">

                        <div class="d-flex align-items-center float-right">
                            <a href="{{routeUser($pagePath.'.create')}}">
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                <i class="fas fa-plus"></i> &nbsp; {{  trans('admin_lang.add')}} {{  trans('admin_lang.transaction')}} </button>
                            </a>
                        </div>
                    </div>  
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover show">
                                
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans("admin_lang.name") }}</th>  
                                        <th>{{ trans("admin_lang.email") }}</th>  
                                        <th>{{ trans("admin_lang.title") }}</th>  
                                        <th>{{ trans("admin_lang.price") }}</th>                                       
                                        <th>{{ trans("admin_lang.status") }}</th>                                       
                                        <th class="action">{{ trans("admin_lang.action") }}</th>
                                    </tr>
                                </thead>  
                        
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
@endsection
@section('script')
<script type="text/javascript">
    var tables = $('#basic-datatables').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "pageLength": 10,
        "order": [[0, "desc"]],
        "ajax": {
            url: "{{ routeUser($pagePath.'.index') }}",
            error: function () {
                alert("{{trans('admin_lang.something_went_wrong')}}");
            }
        },
        "aoColumns": [
           
            {mData: 'DT_RowId'},
            {mData: 'name'},
            {mData: 'email'},
            {mData: 'title'},
            {mData: 'price'},
            {mData: 'status'},
            {mData: 'actions'}
        ],
        language: {
            searchPlaceholder: "Search"
        },
        "aoColumnDefs": [
            {"bSortable": false, "aTargets": ['action']}
        ],
    });
</script>
@endsection