@extends('admin.layouts.layout')
@section('content')

    <div class="container-fluid">

        <h4 class="h3 mb-2 text-gray-800">{{ trans('admin_lang.view') }} {{ trans('admin_lang.relevant') }}</h4>
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
                                <div class="col-md-6">
                                    <table class="table table-striped table-bordered" style="table-layout:fixed;">
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
                                                    <td>{!! $sdata->description !!}
                                                @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('admin_lang.created') }}</th>
                                                @if ($sdata->created_at == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{!! date('d-M-Y', strtotime($sdata->created_at)) !!}
                                                @endif
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                    
                                </div>
                                <div class="col-md-6">
                                    Image <br>
                                    @if ($sdata->cover_img)
                                        <img src="{{ asset($sdata->cover_img) }}"
                                            style="max-width: 32%; margin-top:20px; height: 185px;"><br><br>
                                    @else
                                        <img src="{{ asset('public/img/avatar.jpg') }}"
                                            style="max-width: 32%; margin-top:20px; height: 185px;"><br><br>
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
