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
                <div class="form-group @if ($errors->has('sortname')) has-error @endif">
                    <label for="title_in_EN" class="control-label required">{!! trans('Short Name') !!}</label>
                    {!! Form::text('sortname',$sdata->sortname,['class'=>'form-control','placeholder'=>"Enter Short Name", 'maxlength'=>"3", 'minlength'=>"2"])!!}
                    @if ($errors->has('sortname'))<span class="error">{{ $errors->first('sortname') }}</span>@endif
                </div>
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    <label for="title_in_EN" class="control-label required">{!! trans('admin_lang.name') !!}</label>
                    {!! Form::text('name',$sdata->name,['class'=>'form-control','placeholder'=>"Enter Country Name"])!!}
                    @if ($errors->has('name'))<span class="error">{{ $errors->first('name') }}</span>@endif
                </div>
                <div class="form-group @if ($errors->has('phonecode')) has-error @endif">
                    <label for="title_in_EN" class="control-label required">{!! trans('admin_lang.phonecode') !!}</label>
                    {!! Form::number('phonecode',$sdata->phonecode,['class'=>'form-control','placeholder'=>"Enter Phonecode", 'onKeyPress'=>"if(this.value.length==10) return false;"])!!}
                    @if ($errors->has('phonecode'))<span class="error">{{ $errors->first('phonecode') }}</span>@endif
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
<style>
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
    </style>
@endsection