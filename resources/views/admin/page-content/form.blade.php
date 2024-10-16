<link rel="stylesheet" href="{{ asset('public/assets/css/intlTelInput.css') }}">
<style type="text/css">
    .error{font-size: 15px;
    color: red;}
</style>
<style type="text/css">
    .ck{height: 250px;}
</style>




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
                    <label for="title_in_EN" class="control-label">{{ trans("admin_lang.title") }}</label>
                    {!! Form::textarea("title",$sdata->title,['class'=>'form-control content','placeholder'=>"Enter title"])!!}
                    @if ($errors->has("title"))<span class="error">{{ $errors->first("title") }}</span>@endif
                </div>
 
                <div class="form-group @if ($errors->has('description')) has-error @endif">
                    <label for="title_in_EN" class="control-label" >{{ trans("admin_lang.description") }}</label>
                    {!! Form::textarea("description",$sdata->description,['class'=>'form-control description content', 'id'=>'description', 'placeholder'=>"Enter description"])!!}
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

