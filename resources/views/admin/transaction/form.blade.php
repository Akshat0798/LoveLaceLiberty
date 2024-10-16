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
                <div class="form-group @if ($errors->has('id')) has-error @endif">
                    <label for="title_in_EN" class="control-label required">{{ trans("admin_lang.name") }}</label>
                    <div class="form-group">
                        <select class="form-control" name="id" disabled  >
                            <option value="" >Select user</option>
                            @foreach ($business as $data)
                            <option {{ $sdata->user_id == $data->id ? 'selected' : '' }} value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                            </select> 
                            @if ($errors->has('id'))<span class="error">{{ $errors->first('id') }}</span>@endif
                    </div>
                    @if ($errors->has('id'))<span class="error">{{ $errors->first('id') }}</span>@endif
                </div>
                <div class="form-group @if ($errors->has('plan')) has-error @endif">
                    <label for="title_in_EN" class="control-label required">{{ trans("admin_lang.plan") }}</label>
                    <select class="form-control" name="plan" required >
                        <option  value="basic" {{$sdata->getPlan->title == 'basic'  ? 'selected' : '' }}>Basic</option>
                        <option  value="enhanced" {{$sdata->getPlan->title == 'enhanced'  ? 'selected' : '' }}>Enhanced</option>
                        <option  value="premium" {{$sdata->getPlan->title == 'premium'  ? 'selected' : '' }}>premium</option>

                        </select> 
                        @if ($errors->has('plan'))<span class="error">{{ $errors->first('plan') }}</span>@endif
                </div>
            </div>                                                         
        </div>
        <div class="card-action">
            <button type="submit" class="btn btn-primary btn-sm form_submit">{{ trans('admin_lang.submit') }}</button>
            <a href="{{ routeUser($pagePath.'.index') }}"><button type="button" class="btn btn-danger btn-sm">{{ trans('admin_lang.cancel') }}</button><a>
        </div>
    </div>

</div>
