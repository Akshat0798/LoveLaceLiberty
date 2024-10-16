@extends('admin.layouts.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">App Setting</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">App Setting
                                <li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
                                <form class="form-horizontal" method="POST"
                                    action="{{ route('admin.app-version-update') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <div class="form-group m-t-20">
                                        <label class="">Android Version</label>
                                        <input type="text" name="android_version" id="name" class="form-control"
                                            placeholder="Android App Version" value="{{ $data->android_version }}">
                                        @error('android_version')
                                            <div class="form-valid-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group m-t-20">
                                        <label class="">Ios Version</label>
                                        <input type="text" name="ios_version" id="name" class="form-control"
                                            placeholder="Ios App Version" value="{{ $data->ios_version }}">
                                        @error('ios_version')
                                            <div class="form-valid-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Android Force Update</label>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="radio" name="android_force_update"
                                                {{ $data->android_force_update == 1 ? 'checked' : '' }}
                                                class="custom-control-input" id="android_force_update" value="1">
                                            <label class="custom-control-label" for="android_force_update">Yes</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="radio" name="android_force_update" class="custom-control-input"
                                                id="android_force_update1" value="0"
                                                {{ $data->android_force_update == 0 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="android_force_update1">No</label>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Ios Force Update</label>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="radio" name="ios_force_update"
                                                {{ $data->ios_force_update == 1 ? 'checked' : '' }}
                                                class="custom-control-input" id="ios_force_update" value="1">
                                            <label class="custom-control-label" for="ios_force_update">Yes</label>

                                        </div>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="radio" name="ios_force_update" class="custom-control-input"
                                                id="ios_force_update1" value="0"
                                                {{ $data->ios_force_update == 0 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="ios_force_update1">No</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Android Maintenance</label>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="radio" name="android_maintenance" class="custom-control-input"
                                                {{ $data->android_maintenance == 1 ? 'checked' : '' }}
                                                id="android_maintenance1" value="1">
                                            <label class="custom-control-label" for="android_maintenance1">Yes</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="radio" name="android_maintenance" class="custom-control-input"
                                                id="android_maintenance" value="0"
                                                {{ $data->android_maintenance == 0 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="android_maintenance">No</label>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ios Maintenance</label>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="radio" name="ios_maintenance" class="custom-control-input"
                                                {{ $data->ios_maintenance == 1 ? 'checked' : '' }} id="ios_maintenance1"
                                                value="1">
                                            <label class="custom-control-label" for="ios_maintenance1">Yes</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="radio" name="ios_maintenance" class="custom-control-input"
                                                id="ios_maintenance" value="0"
                                                {{ $data->ios_maintenance == 0 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="ios_maintenance">No</label>

                                        </div>
                                    </div>

                                    <div class="form-group m-t-20">
                                        <label class="">Android Message</label>
                                        <input type="text" name="android_message" id="name" class="form-control"
                                            placeholder="Android App Message" value="{{ $data->android_message }}">
                                        @error('android_message')
                                            <div class="form-valid-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group m-t-20">
                                        <label class="">Ios Version</label>
                                        <input type="text" name="ios_message" id="name" class="form-control"
                                            placeholder="Ios App Message" value="{{ $data->ios_message }}">
                                        @error('ios_message')
                                            <div class="form-valid-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group m-t-20">
                                        <label class="">App Share URL</label>
                                        <input type="url" name="app_url" id="app_url" class="form-control"
                                            placeholder="App Share URL" value="{{ $data->app_url }}">
                                        @error('app_url')
                                            <div class="form-valid-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group m-t-20">
                                        <label class="">App Share Message</label>
                                        <input type="text" name="app_message" id="app_message" class="form-control"
                                            placeholder="App Share Message" value="{{ $data->app_message }}">
                                        @error('app_message')
                                            <div class="form-valid-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group m-t-20">
                                        <label class="">Ios App URL</label>
                                        <input type="url" name="ios_app_link" id="ios_app_link" class="form-control"
                                            placeholder="Ios App URL" value="{{ $data->ios_app_link }}">
                                        @error('ios_app_link')
                                            <div class="form-valid-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group m-t-20">
                                        <label class="">Android App URL</label>
                                        <input type="url" name="android_app_link" id="android_app_link" class="form-control"
                                            placeholder="Android App URL" value="{{ $data->android_app_link }}">
                                        @error('android_app_link')
                                            <div class="form-valid-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button class="btn btn-primary" id="submit-btn" type="submit"><span
                                            id="licon"></span>Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
