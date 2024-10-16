@extends('admin.layouts.layout')
@section('content')
<div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">{{ trans("admin_lang.edit") }} Page Content</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                            
                            <div class="col-md-2 pull-left" style=" float: left;">
                                <a href="{{routeUser($langPath.'.index')}}"> 
                                <i style="font-size:24px" class="fa">&#xf060;</i>
                            </a>
                            </div>
                        </div>
            <div class="card-body">
                <div class="table-responsive">
                {!! Form::model($sdata,  ['route'=>[routeFormUser($pagePath.'.update'),encrypt($sdata->id) ], 'method'=>'patch','files'=>true, 'class'=>'upload_submit']) !!}
                    @include('admin.'.$pagePath.'.form')
                {!! Form::close() !!}
                </div>
            </div>
        </div>
</div>
@endsection
@section('script')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
{{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>    --}}
<script>

  $('.content').summernote({
    // placeholder: 'Enter details',
    height: 200,
    toolbar: [
        // [ 'style', [ 'style' ] ],
        [ 'font', [ 'bold', 'italic', 'underline',  'clear'] ], 
        [ 'fontsize', [ 'fontsize' ] ],
        ['codeview', ['codeview']], // Add the custom button for source code
      ],
      callbacks: {
        onInit: function() {
          $('.note-codeview-btn').click(function() {
            $(this).toggleClass('active');
            $('#summernote').summernote('codeview.toggle');
          });
        }
      }
    });         
</script>
@endsection