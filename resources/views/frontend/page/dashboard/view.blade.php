@extends('frontend.layouts.layout')

@section('content')

    <main class="bashboard-main">
        <div class="container-fluid">
            <div class="row m-0">
                <div class="d-flex align-items-stretch">
                    @include('frontend.includes.sidebar')
                    <div class="right-side w-100">
                        <div class="dashboard-icon" id="mobile-menu-toggle">
                            <a href="#" class="menu-icon indent">
                                <span class="menu-icon__text">Show Menu</span>
                            </a>
                            <!-- <h6>Menu</h6> -->
                        </div>
                        <div class="right-side-main h-100">
                            <div class="row gy-4 gy-xl-0">
                                <div class="d-md-flex align-items-center justify-content-between mb-md-4">
                                    <h6 class="all-right-head">
                                        <a href="{{ route('business.dashboard.index') }}" class="same-border p-4"><span
                                                class="icon-back"></span></a>
                                        {{ $sdata->name }}
                                        @if ($sdata->is_submitted == null)
                                            @if ($sdata->is_unsubmitted != null)
                                                <span class="yellow-span">Incomplete Listing</span>
                                                <span class="yellow-span">Update</span>
                                    </h6>
                                @elseif ($sdata->status == '0')
                                    <span class="green-span">Ready to Submit</span> </h6>
                                @elseif ($sdata->status == '1')
                                    <span class="yellow-span">Awaiting Approval</span> </h6>
                                @elseif($sdata->status == '2')
                                    <span class="green-span">Profile listed on behere</span> </h6>
                                @elseif ($sdata->status == '3')
                                    <span class="yellow-span">Incomplete Listing</span> </h6>
                                    @endif
                                @else
                                    <span class="yellow-span">Awaiting Approval</span> <span
                                        class="yellow-span">Update</span> </h6>
                                    @endif
                                    <div class="edit-delete d-flex">
                                        @if ($sdata->status != 1 && $sdata->is_submitted == null)
                                            <a href="{{ route('business.dashboard.edit', encrypt($sdata->id)) }}"
                                                class="edit-border same-btn me-2"><span class="icon-edit"></span></a>
                                            <a href="{{ route('business.dashboard.delete', encrypt($sdata->id)) }}"
                                                class="detele-border same-btn" onclick="return confirmation()"><span
                                                    class="icon-delete"></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xxl-6">
                                    <div class="full-profile">
                                        @foreach ($sdata->business_slider as $key => $image)
                                            @if ($image->image != null)
                                                <figure><img src="{{ asset('public/' . $image->image) }}" alt="">
                                                </figure></a>
                                                @php  break; @endphp
                                            @endif
                                        @endforeach
                                        {{-- <figure><img src="{{ asset('public/' . $sdata->cover_img) }}" alt="">
                                        </figure> --}}
                                        <div class="text mb-3">
                                            <p><span class="icon-phone"></span> +{{ $sdata->country_code }}
                                                {{ $sdata->mobile_number }}</p>
                                            <p><span class="icon-massage"></span> {{ $sdata->email }}</p>
                                        </div>
                                        <div class="text mb-3">
                                            <p><span class="icon-globe"></span> {{ $sdata->web_link }}</p>
                                            <p><span class="icon-map"></span> {{ $sdata->address }}</p>
                                        </div>
                                        <p>{{ $sdata->description }}</p>
                                    </div>
                                </div>
                                <div class="col-xxl-6 border-left-side">
                                    @if ($event->day == null)
                                        <h6 class="all-right-head mb-4">Business Event Hour </h6>
                                    @else
                                        <h6 class="all-right-head mb-4">Business Hour </h6>
                                    @endif
                                    <div class="row gy-4 week-list">
                                        @foreach ($times as $data)
                                            @if ($data->day == null)
                                                {{-- <div class="col-3">
                                            <p>{{ $data->day }}</p>
                                        </div> --}}
                                                <div class="col-9">

                                                    <div class="d-flex mb-2">
                                                        <p>Start Date</p>
                                                        @if ($data->start_date == null)
                                                            <p>
                                                                <span class="blanck">-</span>
                                                                <span>-</span>
                                                            </p>
                                                        @else
                                                            <p>{{ $data->start_date }} &nbsp&nbsp {{ $data->open_time }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex mb-2">
                                                        <p>End Date</p>
                                                        @if ($data->end_date == null)
                                                            <p>
                                                                <span class="blanck">-</span>
                                                                <span>-</span>
                                                            </p>
                                                        @else
                                                            <p>{{ $data->end_date }} &nbsp&nbsp {{ $data->close_time }}
                                                            </p>
                                                        @endif
                                                    </div>



                                                </div>
                                            @else
                                                <div class="col-3">
                                                    <p>{{ $data->day }}</p>
                                                </div>
                                                <div class="col-9">
                                                    @if ($data->status == '')
                                                        <p>{{ $data->open_time }}-{{ $data->close_time }} </p>
                                                    @elseif ($data->status != 0)
                                                        <p>Open 24 hours</p>
                                                    @else
                                                        <p>Close</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if ($new_datas)
                                    <h4 style="font-family: 'Graphik';">For Update</h4>
                                    <div class="col-xxl-6">
                                        <div class="full-profile">
                                            <h6 class="all-right-head">{{ $new_datas->name }}</h6>
                                            @if ($new_datas->cover_img != null)
                                                <figure><img src="{{ asset('public/' . $new_datas->cover_img) }}"
                                                        alt="">
                                                </figure>
                                            @else
                                                @foreach ($sdata->business_slider as $key => $image)
                                                    @if ($image->image != null)
                                                        <figure><img src="{{ asset('public/' . $image->image) }}"
                                                                alt=""></figure></a>
                                                        @php  break; @endphp
                                                    @endif
                                                @endforeach
                                                {{-- <figure><img src="{{ asset('public/' . $sdata->cover_img) }}"
                                                        alt="">
                                                </figure> --}}
                                            @endif
                                            <div class="text mb-3">
                                                <p><span class="icon-phone"></span> +{{ $new_datas->country_code }}
                                                    {{ $new_datas->mobile_number }}</p>
                                                <p><span class="icon-massage"></span> {{ $new_datas->email }}</p>
                                            </div>
                                            <div class="text mb-3">
                                                <p><span class="icon-globe"></span> {{ $new_datas->web_link }}</p>
                                                <p><span class="icon-map"></span> {{ $new_datas->address }}</p>
                                            </div>
                                            <p>{{ $new_datas->description }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 border-left-side">
                                        @if ($event->day == null)
                                            <h6 class="all-right-head mb-4">Business Event Hour </h6>
                                        @else
                                            <h6 class="all-right-head mb-4">Business Hour </h6>
                                        @endif
                                        <div class="row gy-4 week-list">
                                            @foreach ($new_times as $data)
                                                @if ($data->day == null)
                                                    {{-- <div class="col-3">    
                                                <p>{{ $data->day }}</p>
                                            </div> --}}
                                                    <div class="col-9">
    
                                                        <div class="d-flex mb-2">
                                                            <p>Start Date</p>
                                                            @if ($data->start_date == null)
                                                                <p>
                                                                    <span class="blanck">-</span>
                                                                    <span>-</span>
                                                                </p>
                                                            @else
                                                                <p>{{ $data->start_date }} &nbsp&nbsp {{ $data->open_time }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                        <div class="d-flex mb-2">
                                                            <p>End Date</p>
                                                            @if ($data->end_date == null)
                                                                <p>
                                                                    <span class="blanck">-</span>
                                                                    <span>-</span>
                                                                </p>
                                                            @else
                                                                <p>{{ $data->end_date }} &nbsp&nbsp {{ $data->close_time }}
                                                                </p>
                                                            @endif
                                                        </div>
    
    
    
                                                    </div>
                                                @else
                                                    <div class="col-3">
                                                        <p>{{ $data->day }}</p>
                                                    </div>
                                                    <div class="col-9">
                                                        @if ($data->status == '')
                                                            <p>{{ $data->open_time }}-{{ $data->close_time }} </p>
                                                        @elseif ($data->status != 0)
                                                            <p>Open 24 hours</p>
                                                        @else
                                                            <p>Close</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- <div class="col-xxl-6">
                                        <h6 class="all-right-head mb-4">Business Hour </h6>
                                        <div class="row gy-4 week-list">
                                            @foreach ($new_times as $data)
                                                <div class="col-3">
                                                    <p>{{ $data->day }}</p>
                                                </div>
                                                <div class="col-9">
                                                    @if ($data->status == '')
                                                        <p>{{ $data->open_time }}-{{ $data->close_time }} </p>
                                                    @elseif ($data->status != 0)
                                                        <p>Open 24 hours</p>
                                                    @else
                                                        <p>Close</p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div> --}}
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
