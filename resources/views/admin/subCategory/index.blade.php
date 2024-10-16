@extends('admin.layouts.layout')
@section('content')
<style>
.changeStatus {
    width: 48% !important;
}
.show{
    width: 100% !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #6e707e !important;
    line-height: 36px; 
}
.select2-container--default .select2-selection--single {
    border: 1px solid #d1d3e2 !important;
    /* border: 1px solid #aaa; */
    border-radius: 4px;
}
.select2-container--default .select2-selection--single{
    height: 100%;
    align-items: center;
    display: flex;
}
.select2-container{
    height: 100%;
}
.select2-container--default .select2-selection--single .select2-selection__arrow{
    top: 6px;
}
</style>
<div class="container-fluid">      
    <div class="page-inner">          
        <h4 class="page-title">{{ trans("admin_lang.sub") }} {{ trans('admin_lang.manage') }}</h4>
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
                            {{-- <div class="col-md-3">
                                <select class="form-control reset select2 category" id="category" name="category"  > 
                                    <option value=" ">Select Category</option>
                                @foreach ($categorys as $data) 
                                    @if ($data->parent_id == '')
                                    <option  value="{{$data->id}}" >{{$data->interest_name}}</option>   
                                    @endif
                                @endforeach
                                </select> 
                            </div>  --}}
                            <a href="{{routeUser($pagePath.'.create')}}">
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                <i class="fas fa-plus"></i> &nbsp; {{  trans('admin_lang.add')}} {{ trans("admin_lang.sub") }} </button>
                            </a>
                        </div>
                    </div>  
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover show">
                                
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans("admin_lang.category") }}</th>                                       
                                        <th>{{ trans("admin_lang.sub") }}</th>
                                        <th class="action">{{ trans("admin_lang.status") }}</th>
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
<script src="{{ asset('public/assets/js/jquery.form.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(".select2").select2({
})
</script>
<script type="text/javascript">
    var tables = $('#basic-datatables').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "pageLength": 10,
        "order": [[0, "desc"]],
        "ajax": {
            url: "{{ routeUser($pagePath.'.index') }}",
            data: function (d) {
                return $.extend({}, d, {
                    "category": $('.category').val(),
                });
            },
            error: function () {
                alert("{{trans('admin_lang.something_went_wrong')}}");
            }
        },
        "aoColumns": [
           
            {mData: 'DT_RowId'},
            {mData: 'parent'},
            {mData: 'title'},
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
    $('#category').change( function(){
        var category =  $('#category').val();
        tables.draw();
    } );
</script>
@endsection