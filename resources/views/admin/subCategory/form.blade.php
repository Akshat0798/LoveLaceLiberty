<link rel="stylesheet" href="{{ asset('public/assets/css/intlTelInput.css') }}">
<style type="text/css">
    .error{font-size: 15px;
    color: red;}
</style>
<style type="text/css">
    .ck{height: 250px;}
    .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #6e707e !important;
    line-height: 36px; 
}
.select2-container--default .select2-selection--single {
    border: 1px solid #a9aab4 !important;
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
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>



<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="form-group @if ($errors->has('parent')) has-error @endif">
                    <label for="title_in_EN" class="control-label required">{{ trans("admin_lang.category") }} {{ trans("admin_lang.name") }}</label>
                    <div class="form-group">
                        <select class="form-control" id="parent" name="parent_id" >
                            @foreach ($categorys as $data) 
                            @if ($data->parent_id == '')
                            <option  value="{{$data->id}}" {{ $sdata->parent_id == $data->id ? 'selected' : '' }}>{{$data->title}}</option>
                        
                        @endif
                            @endforeach
                          </select> 
                          @if ($errors->has('parent_id'))<span class="error">{{ $errors->first('parent_id') }}</span>@endif
                    </div>
                    <label for="title_in_EN" class="control-label required">{{ trans("admin_lang.keyword") }} {{ trans("admin_lang.name") }}</label>
                    {!! Form::text('title',$sdata->title,['class'=>'form-control','placeholder'=>"Enter Keyword",'oninput'=>'validateInput(this)'])!!}
                    @if ($errors->has('title'))<span class="error">{{ $errors->first('title') }}</span>@endif
                    @if (session('ban'))<span class="error">{{ session('ban') }}</span>@endif
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>

        $('#parent').select2({
        //   tags: true,
        // tokenSeparators: [',', ' ']
        });

        function validateInput(inputElement) {
                      const inputValue = inputElement.value;
                      const pattern = /^[a-z]+$/;
                      const isValid = pattern.test(inputValue);

                      if (!isValid) {
                        // If the input is invalid, remove the last character
                        inputElement.value = inputValue.slice(0, -1);
                      }
                    }
        
        </script>

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