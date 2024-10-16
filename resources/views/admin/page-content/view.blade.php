@extends('admin.layouts.layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <h4 class="h3 mb-2 text-gray-800">{{ trans('admin_lang.view') }} Page Content</h4>
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="col-md-2 pull-left" style=" float: left;">
                    <a href="{{ routeUser($pagePath . '.index') }}">
                        <i style="font-size:24px" class="fa">&#xf060;</i>
                    </a>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3 mb-4">
                                    Image <br>
                                    @if ($sdata->image)
                                        {{-- @if (strstr(mime_content_type('public/' . $sdata->file), 'video/'))
                                            <video width="50%" height="auto" controls autoplay>
                                                <source src="{{ url($sdata->file) }}" type="video/ogg">.
                                            </video>
                                        @else --}}
                                        <img src="{{ asset($sdata->image) }}"
                                            style="    max-width: 230px;
                                                        height: 222px;
                                                        border-radius: 100%;">
                                        {{-- @endif --}}
                                    @else
                                        <img src="{{ asset('public/img/avatar.jpg') }}"
                                            style="    max-width: 230px;
                                                        height: 222px;
                                                        border-radius: 100%;">
                                    @endif


                                </div>
                                <div class="col-md-9">

                                    @if ($sdata->title > null)
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width:30%">{{ __('admin_lang.title') }}</th>
                                                    @if ($sdata->title == null)
                                                        <td style="width:70%">-</td>
                                                    @else
                                                        <td style="width:70%">{{ ucfirst($sdata->title) }}</td>
                                                    @endif
                                                </tr>

                                                <tr>
                                                    <th>{{ __('admin_lang.description') }}</th>
                                                    @if ($sdata->description == null)
                                                        <td>-</td>
                                                    @else
                                                        <td>{!! $sdata->description !!} </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
