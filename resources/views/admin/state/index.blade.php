@extends('admin.layouts.layout')
@section('content')
<style>
.changeStatus {
    width: 48% !important;
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
.show{
    width: 100% !important;
}
</style>
<div class="container-fluid">      
    <div class="page-inner">          
        <h4 class="page-title">{{ trans('admin_lang.state') }} {{ trans('admin_lang.manage') }}</h4>
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
                                <i class="fas fa-plus"></i> &nbsp; {{  trans('admin_lang.add').' '.Illuminate\Support\Str::singular(trans('admin_lang.state')) }}</button>
                            </a>
                        </div>
                    </div>  
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-3">
                                        <select class="form-control" id="country" name="country"  >
                                            <option value="">Select Country</option>
                                            @foreach ($country as $data)                                              
                                            <option  value="{{$data->id}}">{{$data->name}}</option>
                                            @endforeach
                                        </select> 
                                </div>
                            </div>
                            
                        </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover show">
                                
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans("admin_lang.country") }} {{ trans("admin_lang.name") }}</th>
                                        <th>{{ trans("admin_lang.state") }} {{ trans("admin_lang.name") }}</th>                                       
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

$("#country").select2({
    // tags: true,
    // tokenSeparators: [',', ' ']
})
    </script>
     <script>
         $(document).ready(function () {
             $('#country').on('change', function () {
                 var idCountry = this.value;
                 $("#state").html('');
                 $.ajax({
                     url: "{{url('state/fetch-states')}}",
                     type: "POST",
                     data: {
                         country_id: idCountry,
                         _token: '{{csrf_token()}}'
                     },
                     dataType: 'json',
                     success: function (result) {
                         $('#state').html('<option value="">Select State</option>');
                         $.each(result.states, function (key, value) {
                             $("#state").append('<option value="' + value
                                 .id + '">' + value.name + '</option>');
                         });
                     }
                 });
             });
         });
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
                    "state": $('#state').val(),
                    "country": $('#country').val(),

                });
            },
            error: function () {
                alert("{{trans('admin_lang.something_went_wrong')}}");
            }
        },
        "aoColumns": [
           
            {mData: 'DT_RowId'},
            {mData: 'country'},
            {mData: 'state'},
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

    $('#country').change( function(){
        var country =  $('#country').val();
        tables.draw();
    } );

    $('#state').change( function(){
        var state =  $('#state').val();
        tables.draw();
    } );
</script>
@endsection