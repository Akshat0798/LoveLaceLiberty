@extends('admin.layouts.layout')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">{{ trans("admin_lang.add") }} Content</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
                            <div class="col-md-2 pull-left" style=" float: left;">
                                <a href="{{routeUser($pagePath.'.index')}}">
                                <i style="font-size:24px" class="fa">&#xf060;</i>
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

                                                <div class="form-group @if ($errors->has('file')) has-error @endif">
                                                    <label for="title_in_EN" class="control-label required" >Image</label>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="file" id="formFile" name="file" style="padding:0px; height:32px; border-radius:0px;" accept="image/*">
                                                      </div>
                                                    @if ($errors->has('file'))<span class="error">{{ $errors->first('file') }}</span>@endif
                                                </div>   
                                            
                                            
                                                <div class="form-group @if ($errors->has('title')) has-error @endif">
                                                    <label for="title_in_EN" class="control-label required">{{ trans("admin_lang.title") }}</label>
                                                    {!! Form::text("title",Null,['class'=>'form-control content','placeholder'=>"Enter title", 'maxlength'=>"150"])!!}
                                                    @if ($errors->has("title"))<span class="error">{{ $errors->first("title") }}</span>@endif
                                                </div>
                                               
                                                <div class="form-group @if ($errors->has('description')) has-error @endif">
                                                    <label for="title_in_EN" class="control-label required" >{{ trans("admin_lang.description") }}</label>
                                                    {!! Form::text("description",Null,['class'=>'form-control description content', 'id'=>'description', 'placeholder'=>"Enter description", 'maxlength'=>"150"])!!}
                                                    @if ($errors->has("description"))<span class="error">{{ $errors->first("description") }}</span>@endif
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
@endsection
@section('script')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
{{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>    --}}
<script>

//   $('.content').summernote({
//     // placeholder: 'Enter details',
//     height: 200,
//     toolbar: [
//         [ 'style', [ 'style' ] ],
//         [ 'font', [ 'bold', 'italic', 'underline',  'clear'] ], 
//         [ 'fontsize', [ 'fontsize' ] ],
//         ['codeview', ['codeview']], // Add the custom button for source code
//       ],
//       callbacks: {
//         onInit: function() {
//           $('.note-codeview-btn').click(function() {
//             $(this).toggleClass('active');
//             $('#summernote').summernote('codeview.toggle');
//           });
//         }
//       }
//     });         
</script>
@endsection

