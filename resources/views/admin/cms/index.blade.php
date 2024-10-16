@extends('admin.layouts.layout')
@section('content')
<style>
.show{
    width: 100% !important;
}
</style>
<div class="container-fluid">      
    <div class="page-inner">          
        <h4 class="page-title"><!-- {{ trans('admin_lang.'.$langPath) }} -->CMS {{ trans('admin_lang.manage') }}</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card">   
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover show">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('admin_lang.title')}}</th>
                                        <th class="action" style="width: 475px;">{{ trans('admin_lang.description')}}</th>
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
            {mData: 'title'},
            {mData: 'description'},
            //{mData: 'status'},
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