@extends('frontend.layouts.layout')

@section('content')
    <main class="bashboard-main">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex align-items-stretch">
                    @include('frontend.includes.sidebar')
                    <div class="right-side w-100">
                        @if (session('success'))
                        <div class="alert alert-success"  style=" font-family: 'Graphik';">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('message'))
                        <div class="alert alert-success"  style=" font-family: 'Graphik';">
                            {{ session('message') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger"   style=" font-family: 'Graphik';">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="dashboard-icon" id="mobile-menu-toggle">
                            <a href="#" class="menu-icon indent">
                                <span class="menu-icon__text">Show Menu</span>
                            </a>
                            <!-- <h6>Menu</h6> -->
                        </div>
                        <div class="row h-100">
                            <div class="col-md-12">
                                <form action="{{ route('business.dashboard.update', encrypt($sdata->id)) }}" method="post"
                                    enctype="multipart/form-data" id="myForm">
                                    @csrf
                                    @method('PUT')
                                    @if ($new_datas)

                                    <div class="right-side-main h-100 deatils">
                                        <div class="heading-all mb-3">
                                            {{-- <h2>Edit Details</h4> --}}
                                                <h4>Upload Images</h4>
                                        </div>
                                        <div class="row">
                                            @foreach ($new_slider as $key => $data)
                                                <input type="hidden" name="img_id{{ $key }}"
                                                    value="{{ $data->id }}">
                                                <div class="col-md-4">
                                                    <div class="file-upload-div">
                                                        <input type="file" name="image_{{ $key }}"
                                                            accept="image/png, image/jpeg" id="image_{{ $key }}"
                                                            >
                                                        <div class="inner-upload-icon">
                                                            <div id="label{{ $key }}">
                                                                @if($data->image)
                                                                <img src="{{ asset($data->image) }}" style="width:100px; height:100px; " alt="Upload png and jpg format.">
                                                                @else 
                                                        <span class="icon-upload"></span>
                                                        <p >Upload .png and .jpg format.</p>
                                                        @endif
                                                            </div>
                                                            <div id="output{{$key}}"></div>

                                                        </div>
                                                    </div>
                                                    @if ($errors->has('image_' . $key))
                                                        <span class="error"
                                                            style="color: red; font-family: 'Graphik';">{{ $errors->first('image_' . $key) }}</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="heading-all my-3">
                                            <h4>Business Info</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group mb-3 same-input">
                                                    <span class="input-group-text"><span class="icon-user"></span></span>
                                                    <input type="text" class="form-control" placeholder="Business Name*"
                                                        name="name" value="{{ $new_datas->name }}" required maxlength="50">
                                                </div>
                                                @if ($errors->has('name'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3 same-input">
                                                    <span class="input-group-text"><span class="icon-phone"></span></span>
                                                    <span class="input-group-text p-0 select-code border-start-0">
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="code" id="code" required>
                                                            @foreach ($countryCode as $data)
                                                                <option value="{{ $data->phonecode }}"
                                                                    {{ $data->phonecode == $new_datas->country_code ? 'selected' : '' }}>
                                                                    +{{ $data->phonecode }}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                    <input type="number" class="form-control number"
                                                        placeholder="Contact Number*" name="mobile_number"
                                                        value="{{ $new_datas->mobile_number }}" required
                                                        onKeyPress="if(this.value.length==15) return false;"
                                                        pattern= "[0-9]">
                                                </div>
                                                @if ($errors->has('mobile_number'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('mobile_number') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3 same-input">
                                                    <span class="input-group-text"><span class="icon-massage"></span></span>
                                                    <input type="email" class="form-control"
                                                        placeholder="Business Email Address*" name="email"
                                                        value="{{ $new_datas->email }}" required
                                                        pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" maxlength="100">
                                                </div>
                                                @if ($errors->has('email'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3 same-input">
                                                    <span class="input-group-text"><span class="icon-map"></span></span>
                                                    <input type="text" class="form-control input-right"
                                                        placeholder="Location*" name="address" 
                                                        value="{{ $new_datas->address }}" required maxlength="250"
                                                        id="autocomplete">
                                                    <input type="hidden" name="long" id="longitude" class="form-control"
                                                        value="{{ $new_datas->lng }}">
                                                    <input type="hidden" id="latitude" name="lat" class="form-control"
                                                        value="{{ $new_datas->lat }}">
                                                    <span class="input-group-text input-last-icon"><span
                                                            class="icon-svgrepo"></span></span>
                                                </div>

                                                @if ($errors->has('address'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('address') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3 same-input">
                                                    <span class="input-group-text"><span class="icon-globe"></span></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Website Link*" name="web_link" id="website"
                                                        value="{{ $new_datas->web_link }}" maxlength="150" required
                                                        maxlength="100" >
                                                </div>
                                                <span id="website-error" style="color: red; font-family: 'Graphik';"></span>
                                                @if ($errors->has('web_link'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('web_link') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="same-input">
                                                    {!! Form::textarea('description', $new_datas->description, [
                                                        'class' => 'w-100',
                                                        'id' => 'description',
                                                        'placeholder' => 'Description Bio*',
                                                        'cols' => '30',
                                                        'rows' => '5',
                                                        'maxlength' => '500',
                                                    ]) !!}
                                                </div>
                               <small style=" font-family: 'Graphik';">Max word limit 500</small>

                                                @if ($errors->has('description'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('description') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            
                                            <div class="col-md-8">
                                                <div class="row gy-4 week-list m-0">
                                                    @if ($event->day == null)
                                                    <div class="heading-all my-3">
                                                        <h4>Business Event Hour</h4>
                                                    </div>
                                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                                                        <div class="row m-0 mb-2">
                                                            <div class="col-xl-3 d-flex align-items-center">
                                                                <p>Start date</p> 
                                                            </div>
                                                            <div class="col-xl-9">
                                                                
                                                               <div class="d-md-flex align-items-center">
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input type="hidden" name="event_id" value="{{$new_event->id}}">
                                                                    <input class="open-close-btn" type="date" placeholder="open time" name="start_date" value="{{$event->start_date}}" required>
                                                                </div>
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input class="open-close-btn timePicker" type="text" placeholder="Open time"  name="open_time" value="{{$event->open_time}}" id="openTime{{$key}}" required>
                                                                </div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-0 mb-2">
                                                            <div class="col-xl-3  d-flex align-items-center">
                                                                <p>End date</p> 
                                                            </div>
                                                            <div class="col-xl-9">
                                                               <div class="d-md-flex align-items-center">
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input class="open-close-btn " type="date" placeholder="open time" name="end_date" value="{{$event->end_date}}" required>
                                                                </div>
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input class="open-close-btn timePicker" type="text" placeholder="Close time" name="close_time" value="{{$event->close_time}}" id="closeTime{{$key}}" required>
                                                                </div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                  </div>
                                                    @else
                                                    <div class="heading-all my-3">
                                                        <h4>Business Hour</h4>
                                                    </div>
                                                        
                                                    
                                                    @foreach ($new_tdata as $key => $data)
                                                        <input type="hidden" name="time_id{{ $key }}"
                                                            value="{{ $data->id }}">
                                                        <div class="col-xl-3 mb-3">
                                                            <p>{{ $data->day }}</p>
                                                        </div>
                                                        <div class="col-xl-9 mb-3">
                                                            <div class="d-md-flex align-items-center">
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input class="open-close-btn timePicker open{{ $key }}" id="openTime{{$key}}"
                                                                        type="text" placeholder="Open time"
                                                                        name="open{{ $key }}"
                                                                        value="{{ $data->open_time }}"
                                                                        {{ $data->status == '0' || $data->status == '1' ? 'disabled' : '' }} {{ $data->status != '0' && $data->status != '1' ? 'required' : '' }}>
                                                                </div>
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input class="open-close-btn timePicker open{{ $key }}" id="closeTime{{$key}}"
                                                                        type="text" placeholder="Close time"
                                                                        name="close{{ $key }}"
                                                                        value="{{ $data->close_time }}"
                                                                        {{ $data->status == '0' || $data->status == '1' ? 'disabled' : '' }} {{ $data->status != '0' && $data->status != '1' ? 'required' : '' }}>
                                                                </div>

                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <select class="form-select select-details"
                                                                        name="status{{ $key }}"
                                                                        aria-label="Default select example"
                                                                        onChange="checkOption{{ $key }}(this)">
                                                                        <option selected="" value=" ">Select
                                                                        </option>
                                                                        <option
                                                                            {{ $data->status == '1' ? 'selected' : '' }}
                                                                            value="1">Open 24 hours</option>
                                                                        <option
                                                                            {{ $data->status == '0' ? 'selected' : '' }}
                                                                            value="0">Close</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('close' . $key))
                                                                <span class="error"
                                                                    style="color: red;">{{ $errors->first('close' . $key) }}</span>
                                                            @endif
                                                            @if ($errors->has('open' . $key))
                                                                <span class="error"
                                                                    style="color: red;">{{ $errors->first('open' . $key) }}</span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                            <div class="text-md-end text-center mt-4">
                                                {{-- <button class="btn btn-primary px-5" type="submit" name="action" value="submit_to_admin">Submit to admin</button> --}}
                                                {{-- <a href="{{ route('business.getCategory', [encrypt($sdata->id)]) }}"
                                                    class="btn btn-primary me-sm-2 mb-2 mb-sm-0">Go
                                                    To Category</a> --}}
                                                @if ($sdata->status = 2 && $sdata->is_submitted == null)
                                                    <button class="btn btn-primary px-5" type="submit" name="action"
                                                        value="update" id="submit">Update</button>
                                                @endif
                                               
                                                {{-- <button class="btn btn-primary px-5" type="submit" name="action"
                                                    value="update">Update And Submit To Admin</button> --}}
                                            </div>
                                        </div>
                                    @else
                                    <div class="right-side-main h-100 deatils">
                                        <div class="heading-all mb-3">
                                            {{-- <h2>Edit Details</h4> --}}
                                                <h4>Upload Images</h4> 
                                        </div>
                                        <div class="row">
                                            @foreach ($ddata as $key => $data)
                                                <input type="hidden" name="img_id{{ $key }}"
                                                    value="{{ $data->id }}">
                                                <div class="col-md-4">
                                                    <div class="file-upload-div">
                                                        <input type="file" name="image_{{ $key }}"
                                                            accept="image/png, image/jpeg" id="image_{{ $key }}"
                                                            >
                                                        <div class="inner-upload-icon">
                                                            <div id="label{{ $key }}">
                                                                @if($data->image)
                                                                <img src="{{ asset($data->image) }}" style="width:100px; height:100px; " alt="Upload png and jpg format.">
                                                                @else 
                                                        <span class="icon-upload"></span>
                                                        <p >Upload .png and .jpg format.</p>
                                                        @endif
                                                            </div>
                                                            <div id="output{{$key}}"></div>

                                                        </div>
                                                    </div>
                                                    @if ($errors->has('image_' . $key))
                                                        <span class="error"
                                                            style="color: red; font-family: 'Graphik';">{{ $errors->first('image_' . $key) }}</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="heading-all my-3">
                                            <h4>Business Info</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group mb-3 same-input">
                                                    <span class="input-group-text"><span class="icon-user"></span></span>
                                                    <input type="text" class="form-control" placeholder="Business Name*"
                                                        name="name" value="{{ $sdata->name }}" required maxlength="50">
                                                </div>
                                                @if ($errors->has('name'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3 same-input">
                                                    <span class="input-group-text"><span class="icon-phone"></span></span>
                                                    <span class="input-group-text p-0 select-code border-start-0">
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="code" id="code" required>
                                                            @foreach ($countryCode as $data)
                                                                <option value="{{ $data->phonecode }}"
                                                                    {{ $data->phonecode == $sdata->country_code ? 'selected' : '' }}>
                                                                    +{{ $data->phonecode }}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                    <input type="number" class="form-control number"
                                                        placeholder="Contact Number*" name="mobile_number"
                                                        value="{{ $sdata->mobile_number }}" required
                                                        onKeyPress="if(this.value.length==15) return false;"
                                                        pattern= "[0-9]">
                                                </div>
                                                @if ($errors->has('mobile_number'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('mobile_number') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3 same-input">
                                                    <span class="input-group-text"><span class="icon-massage"></span></span>
                                                    <input type="email" class="form-control"
                                                        placeholder="Business Email Address*" name="email"
                                                        value="{{ $sdata->email }}" required
                                                        pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" maxlength="100">
                                                </div>
                                                @if ($errors->has('email'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3 same-input">
                                                    <span class="input-group-text"><span class="icon-map"></span></span>
                                                    <input type="text" class="form-control input-right"
                                                        placeholder="Location*" name="address"
                                                        value="{{ $sdata->address }}" required maxlength="250"
                                                        id="autocomplete">
                                                    <input type="hidden" name="long" id="longitude" class="form-control"
                                                        value="{{ $sdata->lng }}">
                                                    <input type="hidden" id="latitude" name="lat" class="form-control"
                                                        value="{{ $sdata->lat }}">
                                                    <span class="input-group-text input-last-icon"><span
                                                            class="icon-svgrepo"></span></span>
                                                </div>

                                                @if ($errors->has('address'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('address') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group mb-3 same-input">
                                                    <span class="input-group-text"><span class="icon-globe"></span></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Website Link*" name="web_link" id="website"
                                                        value="{{ $sdata->web_link }}" maxlength="150" required
                                                        maxlength="100" >
                                                </div>
                                                <span id="website-error" style="color: red; font-family: 'Graphik';"></span>
                                                @if ($errors->has('web_link'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('web_link') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="same-input">
                                                    {!! Form::textarea('description', $sdata->description, [
                                                        'class' => 'w-100',
                                                        'id' => 'description',
                                                        'placeholder' => 'Description Bio*',
                                                        'cols' => '30',
                                                        'rows' => '5',
                                                        'maxlength' => '500',
                                                    ]) !!}
                                                </div>
                               <small style=" font-family: 'Graphik';">Max word limit 500</small>

                                                @if ($errors->has('description'))
                                                    <span class="error"
                                                        style="color: red; font-family: 'Graphik';">{{ $errors->first('description') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            
                                            <div class="col-md-8">
                                                <div class="row gy-4 week-list m-0">
                                                    @if ($event->day == null)
                                                    <div class="heading-all my-3">
                                                        <h4>Business Event Hour</h4>
                                                    </div>
                                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                                                        <div class="row m-0 mb-2">
                                                            <div class="col-xl-3 d-flex align-items-center">
                                                                <p>Start date</p> 
                                                            </div>
                                                            <div class="col-xl-9">
                                                                
                                                               <div class="d-md-flex align-items-center">
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input type="hidden" name="event_id" value="{{$event->id}}">
                                                                    <input class="open-close-btn" type="date" placeholder="open time" name="start_date" value="{{$event->start_date}}" required>
                                                                </div>
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input class="open-close-btn timePicker" type="text" placeholder="Open time"  name="open_time" value="{{$event->open_time}}" id="openTime{{$key}}" required>
                                                                </div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-0 mb-2">
                                                            <div class="col-xl-3  d-flex align-items-center">
                                                                <p>End date</p> 
                                                            </div>
                                                            <div class="col-xl-9">
                                                               <div class="d-md-flex align-items-center">
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input class="open-close-btn " type="date" placeholder="open time" name="end_date" value="{{$event->end_date}}" required>
                                                                </div>
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input class="open-close-btn timePicker" type="text" placeholder="Close time" name="close_time" value="{{$event->close_time}}" id="closeTime{{$key}}" required>
                                                                </div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                  </div>
                                                    @else
                                                    <div class="heading-all my-3">
                                                        <h4>Business Hour</h4>
                                                    </div>
                                                        
                                                    
                                                    @foreach ($tdata as $key => $data)
                                                        <input type="hidden" name="time_id{{ $key }}"
                                                            value="{{ $data->id }}">
                                                        <div class="col-xl-3 mb-3">
                                                            <p>{{ $data->day }}</p>
                                                        </div>
                                                        <div class="col-xl-9 mb-3">
                                                            <div class="d-md-flex align-items-center">
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input class="open-close-btn timePicker open{{ $key }}" id="openTime{{$key}}"
                                                                        type="text" placeholder="Open time"
                                                                        name="open{{ $key }}"
                                                                        value="{{ $data->open_time }}"
                                                                        {{ $data->status == '0' || $data->status == '1' ? 'disabled' : '' }} {{ $data->status != '0' && $data->status != '1' ? 'required' : '' }}>
                                                                </div>
                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <input class="open-close-btn timePicker open{{ $key }}" id="closeTime{{$key}}"
                                                                        type="text" placeholder="Close time"
                                                                        name="close{{ $key }}"
                                                                        value="{{ $data->close_time }}"
                                                                        {{ $data->status == '0' || $data->status == '1' ? 'disabled' : '' }} {{ $data->status != '0' && $data->status != '1' ? 'required' : '' }}>
                                                                </div>

                                                                <div class="same-input me-xxl-4 me-1 mb-2 mb-md-0">
                                                                    <select class="form-select select-details"
                                                                        name="status{{ $key }}"
                                                                        aria-label="Default select example"
                                                                        onChange="checkOption{{ $key }}(this)">
                                                                        <option selected="" value=" ">Select
                                                                        </option>
                                                                        <option
                                                                            {{ $data->status == '1' ? 'selected' : '' }}
                                                                            value="1">Open 24 hours</option>
                                                                        <option
                                                                            {{ $data->status == '0' ? 'selected' : '' }}
                                                                            value="0">Close</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('close' . $key))
                                                                <span class="error"
                                                                    style="color: red;">{{ $errors->first('close' . $key) }}</span>
                                                            @endif
                                                            @if ($errors->has('open' . $key))
                                                                <span class="error"
                                                                    style="color: red;">{{ $errors->first('open' . $key) }}</span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-md-end text-center mt-4">
                                            {{-- <button class="btn btn-primary px-sm-5 me-sm-3 mb-2 mb-sm-0 mx-auto d-sm-inline-block d-block" type="submit" name="action" value="submit_to_admin">Submit to admin</button> --}}
                                            @if ($sdata->status == 1 || ($sdata->status == 2 && $sdata->is_submitted == 1))
                                                <button class="btn btn-primary px-5" disabled type="submit"
                                                    name="action" value="update">Update </button>
                                            @else
                                                <button class="btn btn-primary px-5" type="submit" name="action"
                                                    value="update" id="submit">Update </button>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
@section('script')
    <script type="text/javascript">
        function checkOption0(obj) {    
        if (obj.value == "0" || obj.value == "1" ) {
            $('.open0').val('')
            $('.open0').attr('disabled','disabled')    
            $('#openTime0').removeAttr('required')
                $('#closeTime0').removeAttr('required')        
        } else if(obj.value === " "){
            $('#openTime0').attr("required", "true")
                $('#closeTime0').attr("required", "true")
            $('.open0').removeAttr("disabled")
        }
    }
    function checkOption1(obj) {    
        if (obj.value == "0" || obj.value == "1" ) {
            $('.open1').val('')
            $('.open1').attr('disabled','disabled')     
            $('#openTime1').removeAttr('required')
                $('#closeTime1').removeAttr('required')         
        } else if(obj.value === " "){
            $('#openTime1').attr("required", "true")
                $('#closeTime1').attr("required", "true")
            $('.open1').removeAttr("disabled")
        }
    }
    function checkOption2(obj) {    
        if (obj.value == "0" || obj.value == "1" ) {
            $('.open2').val('')
            $('.open2').attr('disabled','disabled')   
            $('#openTime2').removeAttr('required')
                $('#closeTime2').removeAttr('required')           
        } else if(obj.value === " "){
            $('#openTime2').attr("required", "true")
                $('#closeTime2').attr("required", "true")
            $('.open2').removeAttr("disabled")
        }
    }
    function checkOption3(obj) {    
        if (obj.value == "0" || obj.value == "1" ) {
            $('.open3').val('')
            $('.open3').attr('disabled','disabled')  
            $('#openTime3').removeAttr('required')
                $('#closeTime3').removeAttr('required')            
        } else if(obj.value === " "){
            $('#openTime3').attr("required", "true")
                $('#closeTime3').attr("required", "true")
            $('.open3').removeAttr("disabled")
        }
    }
    function checkOption4(obj) {    
        if (obj.value == "0" || obj.value == "1" ) {
            $('.open4').val('')
            $('.open4').attr('disabled','disabled')     
            $('#openTime4').removeAttr('required')
                $('#closeTime4').removeAttr('required')         
        } else if(obj.value === " "){
            $('#openTime4').attr("required", "true")
                $('#closeTime4').attr("required", "true")
            $('.open4').removeAttr("disabled")
        }
    }
    function checkOption5(obj) {    
        if (obj.value == "0" || obj.value == "1" ) {
            $('.open5').val('')
            $('.open5').attr('disabled','disabled')   
            $('#openTime5').removeAttr('required')
                $('#closeTime5').removeAttr('required')           
        } else if(obj.value === " "){
            $('#openTime5').attr("required", "true")
                $('#closeTime5').attr("required", "true")
            $('.open5').removeAttr("disabled")
        }
    }
    function checkOption6(obj) {    
        if (obj.value == "0" || obj.value == "1" ) {
            $('.open6').val('')
            $('.open6').attr('disabled','disabled')  
            $('#openTime6').removeAttr('required')
                $('#closeTime6').removeAttr('required')    
        } else if(obj.value === " "){
            $('#openTime6').attr("required", "true")
                $('#closeTime6').attr("required", "true")
            $('.open6').removeAttr("disabled")
        }
    }

          // same open time close time validation
// event
$(document).ready(function() {
    $('#openTime').on('blur', function() {
        var openValue = $("#openTime").val();
        var closeValue = $("#closeTime").val(); 
    if(openValue == closeValue){
        $('#openTime').val('');
        $("#closeTime").val('');
        alert('open time and close time not be same.');
    }
    if (openValue > closeValue && closeValue != '') {
        $('#openTime').val('');
        alert('Open time must be less than close time');
    }
    })
  });

  $(document).ready(function() {
    $('#closeTime').on('blur', function() {
        var openValue = $("#openTime").val();
        var closeValue = $("#closeTime").val(); 
    if(openValue == closeValue ){
        $('#openTime').val('');
        $("#closeTime").val('');
        alert('open time and close time not be same.');
        }
        if (openValue > closeValue && openValue != '') {
        $('#closeTime').val('');
        alert('Close time must be greater than open time');
    }
    })
  });
// business hours
$(document).ready(function() {
    $('#openTime0').on('blur', function() {
        var openValue = $("#openTime0").val();
        var closeValue = $("#closeTime0").val(); 
    if(openValue == closeValue){
        $('#openTime0').val('');
        $("#closeTime0").val('');
        alert('open time and close time not be same.');
    }
    if (openValue > closeValue && closeValue != '') {
        $('#openTime0').val('');
        alert('Open time must be less than close time');
    }
    })
  });

  $(document).ready(function() {
    $('#closeTime0').on('blur', function() {
        var openValue = $("#openTime0").val();
        var closeValue = $("#closeTime0").val(); 
    if(openValue == closeValue ){
        $('#openTime0').val('');
        $("#closeTime0").val('');
        alert('open time and close time not be same.');
        }
        if (openValue > closeValue && openValue != '') {
        $('#closeTime0').val('');
        alert('Close time must be greater than open time');
    }
    })
  });
  $(document).ready(function() {
    $('#openTime1').on('blur', function() {
        var openValue = $("#openTime1").val();
        var closeValue = $("#closeTime1").val(); 
    if(openValue == closeValue){
        $('#openTime1').val('');
        $("#closeTime1").val('');
        alert('open time and close time not be same.');
    }
    if (openValue > closeValue && closeValue != '') {
        $('#openTime1').val('');
        alert('Open time must be less than close time');
    }
    })
  });

  $(document).ready(function() {
    $('#closeTime1').on('blur', function() {
        var openValue = $("#openTime1").val();
        var closeValue = $("#closeTime1").val(); 
    if(openValue == closeValue ){
        $('#openTime1').val('');
        $("#closeTime1").val('');
        alert('open time and close time not be same.');
        }
        if (openValue > closeValue && openValue != '') {
        $('#closeTime1').val('');
        alert('Close time must be greater than open time');
    }
    })
  });
  $(document).ready(function() {
    $('#openTime2').on('blur', function() {
        var openValue = $("#openTime2").val();
        var closeValue = $("#closeTime2").val(); 
    if(openValue == closeValue){
        $('#openTime2').val('');
        $("#closeTime2").val('');
        alert('open time and close time not be same.');
    }
    if (openValue > closeValue && closeValue != '') {
        $('#openTime2').val('');
        alert('Open time must be less than close time');
    }
    })
  });

  $(document).ready(function() {
    $('#closeTime2').on('blur', function() {
        var openValue = $("#openTime2").val();
        var closeValue = $("#closeTime2").val(); 
    if(openValue == closeValue ){
        $('#openTime2').val('');
        $("#closeTime2").val('');
        alert('open time and close time not be same.');
        }
        if (openValue > closeValue && openValue != '') {
        $('#closeTime2').val('');
        alert('Close time must be greater than open time');
    }
    })
  });
  $(document).ready(function() {
    $('#openTime3').on('blur', function() {
        var openValue = $("#openTime3").val();
        var closeValue = $("#closeTime3").val(); 
    if(openValue == closeValue){
        $('#openTime3').val('');
        $("#closeTime3").val('');
        alert('open time and close time not be same.');
    }
    if (openValue > closeValue && closeValue != '') {
        $('#openTime3').val('');
        alert('Open time must be less than close time');
    }
    })
  });

  $(document).ready(function() {
    $('#closeTime3').on('blur', function() {
        var openValue = $("#openTime3").val();
        var closeValue = $("#closeTime3").val(); 
    if(openValue == closeValue ){
        $('#openTime3').val('');
        $("#closeTime3").val('');
        alert('open time and close time not be same.');
        }
        if (openValue > closeValue && openValue != '') {
        $('#closeTime3').val('');
        alert('Close time must be greater than open time');
    }
    })
  });
  $(document).ready(function() {
    $('#openTime4').on('blur', function() {
        var openValue = $("#openTime4").val();
        var closeValue = $("#closeTime4").val(); 
    if(openValue == closeValue){
        $('#openTime4').val('');
        $("#closeTime4").val('');
        alert('open time and close time not be same.');
    }
    if (openValue > closeValue && closeValue != '') {
        $('#openTime4').val('');
        alert('Open time must be less than close time');
    }
    })
  });

  $(document).ready(function() {
    $('#closeTime4').on('blur', function() {
        var openValue = $("#openTime4").val();
        var closeValue = $("#closeTime4").val(); 
    if(openValue == closeValue ){
        $('#openTime4').val('');
        $("#closeTime4").val('');
        alert('open time and close time not be same.');
        }
        if (openValue > closeValue && openValue != '') {
        $('#closeTime4').val('');
        alert('Close time must be greater than open time');
    }
    })
  });
  $(document).ready(function() {
    $('#openTime5').on('blur', function() {
        var openValue = $("#openTime5").val();
        var closeValue = $("#closeTime5").val(); 
    if(openValue == closeValue){
        $('#openTime5').val('');
        $("#closeTime5").val('');
        alert('open time and close time not be same.');
    }
    if (openValue > closeValue && closeValue != '') {
        $('#openTime5').val('');
        alert('Open time must be less than close time');
    }
    })
  });

  $(document).ready(function() {
    $('#closeTime5').on('blur', function() {
        var openValue = $("#openTime5").val();
        var closeValue = $("#closeTime5").val(); 
    if(openValue == closeValue ){
        $('#openTime5').val('');
        $("#closeTime5").val('');
        alert('open time and close time not be same.');
        }
        if (openValue > closeValue && openValue != '') {
        $('#closeTime5').val('');
        alert('Close time must be greater than open time');
    }
    })
  });
  $(document).ready(function() {
    $('#openTime6').on('blur', function() {
        var openValue = $("#openTime6").val();
        var closeValue = $("#closeTime6").val(); 
    if(openValue == closeValue){
        $('#openTime6').val('');
        $("#closeTime6").val('');
        alert('open time and close time not be same.');
    }
    if (openValue > closeValue && closeValue != '') {
        $('#openTime6').val('');
        alert('Open time must be less than close time');
    }
    })
  });

  $(document).ready(function() {
    $('#closeTime6').on('blur', function() {
        var openValue = $("#openTime6").val();
        var closeValue = $("#closeTime6").val(); 
    if(openValue == closeValue ){
        $('#openTime6').val('');
        $("#closeTime6").val('');
        alert('open time and close time not be same.');
        }
        if (openValue > closeValue && openValue != '') {
        $('#closeTime6').val('');
        alert('Close time must be greater than open time');
    }
    })
  });
    </script>

    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
            });
        }

        $('#autocomplete').change(function(){
            document.getElementById("latitude").value = '';
            document.getElementById("longitude").value = '';
        });

        $("form").submit(function(event){
            var value = $("#latitude").val();
        if(value === ''){
        event.preventDefault();
        alert('Please select location from dropdown list.');
        document.getElementById("autocomplete").value = '';
        } else {
            event.currentTarget.submit();
        }
        });

        $('#code').select2({
            placeholder: 'Select Country Code',
            width:'100px',
        });

        $(document).ready(function(){
        $('#image_0').change(function(){
        $("#output0").html('');
        var selectedValue = $("#image_0").val();
        regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");
        if (!(regex.test(selectedValue))) {
            if (selectedValue) {
                alert('Please select correct file format');
            }
            $("#label0").removeClass("d-none");
        } else {
        for (var i = 0; i < $(this)[0].files.length; i++) {
            $("#output0").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" width="100px" height="100px"/>');
        }
        if (selectedValue){
            $("#label0").addClass("d-none");
        } else { 
            
            $("#label0").removeClass("d-none");
        }
    }
        });

        $('#image_1').change(function(){
        $("#output1").html('');
        var selectedValue = $("#image_1").val();
        regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");
        if (!(regex.test(selectedValue))) {
            if (selectedValue) {
                alert('Please select correct file format');
            }
            $("#label1").removeClass("d-none");
        } else {
        for (var i = 0; i < $(this)[0].files.length; i++) {
            $("#output1").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" width="100px" height="100px"/>');
        }
        if (selectedValue){
            $("#label1").addClass("d-none");
        } else { 
            
            $("#label1").removeClass("d-none");
        }
    }
        });

        $('#image_2').change(function(){
        $("#output2").html('');
        var selectedValue = $("#image_2").val();
        regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");
        if (!(regex.test(selectedValue))) {
            if (selectedValue) {
                alert('Please select correct file format');
            }
            $("#label2").removeClass("d-none");
        } else {
        for (var i = 0; i < $(this)[0].files.length; i++) {
            $("#output2").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" width="100px" height="100px"/>');
        }
        if (selectedValue){
            $("#label2").addClass("d-none");
        } else { 
            
            $("#label2").removeClass("d-none");
        }
    }
        });

        $('#cover_img').change(function(){
        $("#output").html('');
        var selectedValue = $("#cover_img").val();
        regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");
        if (!(regex.test(selectedValue))) {
            if (selectedValue) {
                alert('Please select correct file format');
            }
            $("#label3").removeClass("d-none");
        } else {
        for (var i = 0; i < $(this)[0].files.length; i++) {
            $("#output").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" width="100px" height="100px"/>');
        }
         if (selectedValue){
            $("#label3").addClass("d-none");
        } else { 
            
            $("#label3").removeClass("d-none");
        }
    }
        });
});
    </script>
@endsection
