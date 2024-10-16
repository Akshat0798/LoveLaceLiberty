@extends('admin.layouts.layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ trans('admin_lang.add') }} {{ trans('admin_lang.sub') }}</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="col-md-2 pull-left" style=" float: left;">
                    <a href="{{ routeUser($pagePath . '.index') }}"><i style="font-size:24px" class="fa">&#xf060;</i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    {{ Form::open(['route' => [routeFormUser($pagePath . '.store')], 'files' => true, 'class' => 'upload_submit']) }}
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group @if ($errors->has('parent')) has-error @endif">
                                        <label for="title_in_EN"
                                            class="control-label required">{{ trans('admin_lang.select') }}
                                            {{ trans('admin_lang.category') }}</label>
                                        <div class="form-group">
                                            <select class="form-control" id="parent" name="parent_id">
                                                <option value="">Select Category</option>
                                                @foreach ($categorys as $data)
                                                    @if ($data->parent_id == '')
                                                        <option value="{{ $data->id }}">{{ $data->title }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('parent_id'))
                                                <span class="error">{{ $errors->first('parent_id') }}</span>
                                            @endif
                                        </div>
                                        <label for="title_in_EN" class="control-label required"
                                            id="keyword">{{ trans('admin_lang.sub') }}
                                            {{ trans('admin_lang.name') }}</label>
                                            <input type="text" name="title" class="form-control" id="selectEvents" placeholder="Enter sub category">
                                        @if ($errors->has('title'))
                                            <span class="error">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit"
                                    class="btn btn-primary btn-sm form_submit">{{ trans('admin_lang.submit') }}</button>
                                <a href="{{ routeUser($pagePath . '.index') }}"><button type="button"
                                        class="btn btn-danger btn-sm">{{ trans('admin_lang.cancel') }}</button><a>
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
        .error {
            font-size: 15px;
            color: red;
        }

        .ck {
            height: 250px;
        }

    </style>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        //$(document).ready(function() {
            var s2 = $("#selectEvents").select2({
                placeholder: " Enter keyword",
                tags: true
            });
            $('#selectEvents').on('select2:open', function() {
                $('.select2-search__field').on('keydown', function(e) {
                    // Get the key code of the pressed key
                    var keyCode = e.which;
                    console.log(keyCode);
                    // Check if the pressed key is a space or a special character
                    if ((keyCode >= 65 && keyCode <= 90) || keyCode == 13 || keyCode == 8 ) {
                        // Prevent the default action (i.e., entering the space or special character)
                        
                    } else {
                        e.preventDefault();
                        return false;
                    }
                });
            });
        //});
    </script> --}}
@endsection
