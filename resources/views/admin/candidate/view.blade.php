@extends('admin.layouts.layout')
@section('content')

<div class="container-fluid">

    <h4 class="h3 mb-2 text-gray-800">{{ trans('admin_lang.view') }} Client</h4>
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
                                                <th style="width:30%">{{ __('admin_lang.user_name') }}</th>
                                                @if ($sdata->full_name == null)
                                                    <td style="width:70%">-</td>
                                                @else
                                                    <td style="width:70%">{{ ucfirst($sdata->full_name) }}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th>{{ __('admin_lang.email') }}</th>
                                                <td>{!! !empty($sdata->email) ? $sdata->email : '-' !!}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('admin_lang.gender') }}</th>
                                                @if ($sdata->gender == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{!! $sdata->gender !!} </td>
                                                @endif
                                            </tr>
                                            {{-- <tr>
                                                <th>{{ __('admin_lang.dob') }}</th>
                                                @if ($sdata->dob == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{!! date('d-M-Y', strtotime($sdata->dob)) !!}
                                                @endif
                                                </td>
                                            </tr> --}}
                                            {{-- <tr>
                                                <th>{{ __('admin_lang.category') }}</th>
                                                @if ($sdata->category_id == null)
                                                    <td>-</td>
                                                @else --}}
                                                {{-- @php
                                                    $categoryData = json_decode($sdata->category_id);
                                                @endphp --}}
                                                {{-- @dd(json_decode($sdata->category_id)); --}}
                                                {{-- <td>{{json_decode($sdata->category_id)->category}}</td><br>  --}}
                                                {{-- @dd($categoryData) --}}
                                                {{-- @foreach ($categoryData as $data)
                                                        <td>{!! $data->category->title !!}<br>
                                                    @endforeach --}}
                                                    
                                                {{-- @endif
                                            </tr> --}}
                                            <tr>
                                                <th>{{ __('admin_lang.created') }}</th>
                                                @if ($sdata->created_at == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{!! date('d-M-Y', strtotime($sdata->created_at))  !!}
                                                @endif
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    @if ($sdata->profile_image)
                                    Profile Image <br>
                                        <img src="{{ asset($sdata->profile_image) }}"
                                            style="max-width: 40%; margin-top:20px; height: 185px;"><br>
                                    @else
                                        {{-- <img src="{{ asset('public/img/avataddr.jpg') }}"
                                            style="max-width: 40%; margin-top:20px; height: 185px;"> --}}
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
