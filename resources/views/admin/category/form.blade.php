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
               
                <div class="form-group @if ($errors->has('title')) has-error @endif">
                    <label for="" class="control-label required"
                        >{{ trans('admin_lang.name') }}</label>
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Category', 'required']) !!}
                    @if ($errors->has('title'))
                        <span class="error">{{ $errors->first('title') }}</span>
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
