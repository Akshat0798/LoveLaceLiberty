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
                <div class="form-group">
                    <label for="title_in_EN" class="control-label required">{!! trans('admin_lang.country') !!} {!! trans('admin_lang.name') !!} </label>
                       <select class="form-control" id="country" name="country" >
                           <option value="{{$sdata->state->country->id}}" >{{$sdata->state->country->name}}</option>
                           @foreach ($country as $data)                                              
                           <option  value="{{$data->id}}">{{$data->name}}</option>
                           @endforeach
                         </select> 
                         @if ($errors->has('country'))<span class="error">{{ $errors->first('country') }}</span>@endif
                   </div>
                <div class="form-group">
                 <label for="title_in_EN" class="control-label required">{!! trans('admin_lang.state') !!} {!! trans('admin_lang.name') !!} </label>
                    <select class="form-control" id="state" name="state" >
                        <option value="{{$sdata->state->id}}" >{{$sdata->state->name}}</option>
                        {{-- @foreach ($state as $data)                                              
                        <option  value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach --}}
                      </select> 
                      @if ($errors->has('state'))<span class="error">{{ $errors->first('state') }}</span>@endif
                </div>
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    <label for="title_in_EN" class="control-label required">{!! trans('admin_lang.name') !!}</label>
                    {!! Form::text('name',$sdata->name,['class'=>'form-control','placeholder'=>"Enter City "])!!}
                    @if ($errors->has('name'))<span class="error">{{ $errors->first('name') }}</span>@endif
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js">
</script>

    <script>
        $('#state').select2({
        //   tags: true,
        // tokenSeparators: [',', ' ']
        });
    
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
       
@endsection