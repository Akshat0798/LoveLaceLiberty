@extends('admin.layouts.layout')
@section('content')
<style type="text/css">
    .changeStatus{
        min-width: 100px !important;
    }
    .widthInc{
        min-width: 150px !important;
        padding-left: 2px;
    }
    .dataTables_length label{
        text-transform: capitalize;
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
::placeholder {
  color: #6e707e !important; 
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
 color: #6e707e !important; 
}

::-ms-input-placeholder { /* Microsoft Edge */
 color: #6e707e !important; 
}
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
.show{
    width:100%;
}
</style>
<!-- Begin Page Content -->
<div class="container-fluid">      
    <div class="page-inner">          
        <h4 class="page-title">Client {{ trans('admin_lang.manage') }}</h4>
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
                            <a href="{{ route('admin.user.export') }}" style="margin-right:10px" >
                                <button class="btn btn-primary btn-round ml-auto">
                                <i class="fas fa-plus"></i> &nbsp; {{  trans('admin_lang.export')}}</button>
                            </a>
                            <a href="{{routeUser($pagePath.'.create')}}" >
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal" id="addbanner">
                                <i class="fas fa-plus"></i> &nbsp; {{  trans('admin_lang.add')}} Client </button>
                            </a>
                        </div>
                    </div>  
                    <div class="card-body">
                        <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered show" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="action">Username</th>
                            <th class="action">{{ trans("admin_lang.email") }}</th>
                            <th class="action">{{ trans("admin_lang.phone_number") }}</th>
                            <th class="action" >{{ trans("admin_lang.status") }}</th>
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
<!-- /.container-fluid -->
<!-- ====== -->
@endsection
@section('script')
<script src="{{ asset('public/assets/js/jquery.form.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(".select2").select2({
})
</script>
<script type="text/javascript">
$(document).ready(function () {
    //alert('sdf');
    var tables = $('#basic-datatables').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "pageLength": 10,
        "order": [[0, "desc"]],
        "ajax": {
            url: "{{ routeUser('user.index',['type'=>$typePath]) }}",
            error: function () {
                alert("{{trans('admin_lang.something_went_wrong')}}");
            },
            complete:function(){
                $(".loding_img").hide();
            }
        },
        "aoColumns": [
            {mData: 'DT_RowId'},
            {mData: 'name'},
            {mData: 'email'},
            {mData: 'mobile'},
            {mData: 'status'},
            {mData: 'actions'},
        ],
        language: {
            searchPlaceholder: "Search"
        },
        "aoColumnDefs": [
            {"bSortable": false, "aTargets": ['action']}
        ],
    });

    $(document).on("click",".status-change",function(e){
        e.preventDefault();
        var status = $(this).attr('status');
        var id = $(this).attr('id');
        var path = $(this).attr('data-path');
        $("#denie_message").val('');        
        var url = path;
        var self = this;
        
        $(".id").val(id);
        $(".status").val(status);
        if(status != 1) {
            if (confirm("Are you sure you want to active this user?")) {
                status_change(url,id,status,self,"",tables);
            } else {
                return false;
            }
        }
        else {
            $("#openModal").modal('show');
            $("#formId").attr('action',url);
        }
    });
    $(".formSubmit").click(function(e){
        e.preventDefault();
        if($("#denie_message").val()) {
            status_change($("#formId").attr('action'),$(".id").val(),$(".status").val(),self,$("#denie_message").val(),tables);
        }
    });
    

    function status_change(url,id,status,self,denie_reason,tables) {
        if(status == 1){
            var status_val = 0;
        }else {
            var status_val = 1;
        }
        $(".loding_img").show();
        var postData = {id:id,status:status_val,denie_reason:denie_reason};
        $.get(url,postData,function(data){
            if(data) {
                $(".loding_img").hide();
                $("#openModal").modal('hide');
                $(".flash-message").show();

                $(".flash-message").html('<p class="alert alert-success" >Record updated successfully <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a></p>');
                setTimeout(() => {
                $(".flash-message").hide();
                }, 2000);
                tables.draw();
            }
        })
    }
});

   
   
function confirmation() {
            return confirm('Are you sure that you want to delete?');
        }

</script>
@endsection
