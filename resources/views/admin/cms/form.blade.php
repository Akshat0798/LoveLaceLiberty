<link rel="stylesheet" href="{{ asset('public/assets/css/intlTelInput.css') }}">
<style type="text/css">
    .error{font-size: 15px;
    color: red;}
</style>
<style type="text/css">
    .ck{height: 250px;}
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="form-group @if ($errors->has('title')) has-error @endif">
                    <label for="title_in_EN" class="control-label required">{!! trans('admin_lang.enter_the_title') !!}</label>
                    {!! Form::text('title',null,['class'=>'form-control','placeholder'=>(trans("admin_lang.enter_the_title"))])!!}
                    @if ($errors->has('title'))<span class="error">{{ $errors->first('title') }}</span>@endif
                </div>

                <div class="form-group loaction_class @if ($errors->has('content')) has-error @endif">
                    <label for="content_inEN" class="control-label required">{{ trans("admin_lang.Enterdescription") }}</label>
                    {{ Form::textarea('content',null,['class'=>'form-control','id'=>'editor','placeholder'=>trans("admin_lang.Enterdescription")])}}
                    @if ($errors->has('content'))<span class="error">{{ $errors->first('content') }}</span>@endif
                </div>

            </div>                                                         
        </div>
        <div class="card-action">
            <button type="submit" class="btn btn-primary btn-sm form_submit">{{ trans('admin_lang.submit') }}</button>
            <a href="{{ routeUser($pagePath.'.index') }}"><button type="button" class="btn btn-danger btn-sm">{{ trans('admin_lang.cancel') }}</button><a>
        </div>
    </div>
</div>

@section('script')

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#editor1' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
<!-- <script type="text/javascript" src="{{ asset('public/assets/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('.form_submit').click(function () {
        validateion({
            title: {
                required: true,
                maxlength: 50,
            },
            content: {
                required: true,
            },
        });
        if ($('.upload_submit').valid()) {
            $(".loding_img").show();
            $('.upload_submit').submit();
        }
    });
    CKEDITOR.replace('content', {
        toolbar: [
            {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']},
            {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
            {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        ]
    });
});
</script> -->
<style>
.upload_submit label.error {
    width: auto;
    display: inline;
    font-weight: 500;
}   
</style>
@endsection