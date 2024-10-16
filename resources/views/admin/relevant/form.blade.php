<link rel="stylesheet" href="{{ asset('public/assets/css/intlTelInput.css') }}">
<style type="text/css">
    .error {
        font-size: 15px;
        color: red;
    }
</style>
<style type="text/css">
    .ck {
        height: 250px;
    }
    input::file-selector-button {
  /* font-weight: bold; */
  color: #858796;
  padding: 0.3em;
  border: thin solid grey;
  /* border-radius: 3px; */
}
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>



<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12">
{{--                
                <div class="form-group @if ($errors->has('title')) has-error @endif">
                    <label for="" class="control-label required"
                        >{{ trans('admin_lang.name') }}</label>
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Relevant', 'required']) !!}
                    @if ($errors->has('title'))
                        <span class="error">{{ $errors->first('title') }}</span>
                    @endif
                </div> --}}

                <div class="form-group @if ($errors->has('cover_img')) has-error @endif">
                    <label for="" class="control-label required"
                        >{{ trans('admin_lang.image') }}</label>
                    {{-- {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Relevant Category', 'required']) !!} --}}
                    <input type="file" name="cover_img" class="file"
                    data-overwrite-initial="true" style="border: 1px solid #d1d3e2; width:100%" accept="image/png, image/gif, image/jpeg" >
                    @if ($errors->has('cover_img'))
                        <span class="error">{{ $errors->first('cover_img') }}</span>
                    @endif
                </div>
                <div class="form-group @if ($errors->has('title')) has-error @endif">
                    <label for="" class="control-label required"
                        >{{ trans('admin_lang.title') }}</label>
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title', 'required']) !!}
                    @if ($errors->has('title'))
                        <span class="error">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group @if ($errors->has('description')) has-error @endif">
                    <label for="" class="control-label required"
                        >{{ trans('admin_lang.description') }}</label>
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description', 'required']) !!}
                    @if ($errors->has('description'))
                        <span class="error">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                
            </div>
        </div>
        <div class="card-action">
            <button type="submit" class="btn btn-primary btn-sm form_submit">{{ trans('admin_lang.submit') }}</button>
            <a href="{{ routeUser($pagePath . '.index') }}"><button type="button"
                    class="btn btn-danger btn-sm">{{ trans('admin_lang.cancel') }}</button><a>
        </div>
    </div>

</div>

@section('script')
    <style>
        .upload_submit label.error {
            width: auto;
            display: inline;
            font-weight: 500;
        }
    </style>
@endsection
