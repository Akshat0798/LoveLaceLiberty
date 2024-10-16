<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BusinedssSlider;
use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\BusinessHour;
use App\Models\Country;
use App\Models\Event;
use App\Models\OfferDeal;
use App\Models\State;
use App\Models\TestBusiness;
use App\Models\TestBusinessHour;
use App\Models\TestBusinessSlider;
use App\Models\User;
use App\Models\VerificationDocument;
use Auth;
use File;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Session;
use Validator;

class DashboarddController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $states = State::get();
        return view('frontend.page.dashboard',compact('states'));
    }

    public function show(Request $request, $id)
    {
        $id = decrypt($id);
        // dd($id);
        Session::put('user_id', $id);
        $datas = Business::where('id', $id)->first();
        $event = BusinessHour::where('user_id', $id)->first();
        $times = BusinessHour::where('user_id', $id)->get();
        if($datas == null){
            $id = Auth::id();
        $datas = Business::where('business_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.page.dashboard', compact('datas'));
        }
        $new_datas = TestBusiness::where('business_user_id', $datas->id)->first();
        if ($new_datas) {
            $new_times = TestBusinessHour::where('user_id', $new_datas->id)->get();
            $data = [
                'new_datas' => $new_datas,
                'new_times' => $new_times,
                'sdata' => $datas,
                'event' => $event,
                'times' => $times,
            ];
        } else {
            $data = [
                'new_datas' => $new_datas,
                'event' => $event,
                'sdata' => $datas,
                'times' => $times,
            ];
        }
        return view('frontend.page.dashboard.view', $data);
    }

    public function IdentityVerificationView()
    {
        $country = Country::get();
        $check = VerificationDocument::where('user_id',auth()->id())->first();
        if(!empty($check)){
            session()->flash('success', "Your document are under processing.");
            return redirect()->back();
        } 
        return view('frontend.page.profile.identityVerification', compact('country'));
    }

    public function IdentityVerification(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                "country_id" => 'required',
                // 'file0' => 'required_without_all:file1,|mimes:png,jpeg,bmp,png|max:2000',
            ], [
                // 'file0.required_without_all' => 'You have to fill at least one image',
                // 'file0.mimes' => 'Image is only take png, jpg',
                // 'file1.mimes' => 'Image is only take png, jpg',
                // 'file0.max' => 'The image must not be greater then 2 mb',
                // 'file1.max' => 'The image must not be greater then 2 mb',
            ]
        );
        try {
            $datas = ['file0', 'file1'];
            foreach ($datas as $key => $value) {
                if ($request['file' . $key] != '') {
            $user = new VerificationDocument();
            $user->user_id = auth()->id();
            $user->country_id = $input['country_id'];
            $image = $request['file' . $key];
            $png_url = "client-" . rand() . '.' . $image->extension();
            $image->move(public_path('client_assets/'), $png_url);
            $mediaName3 = 'client_assets/' . $png_url;
            $user->file = $mediaName3;
            $user->type = $input['documentType'];
            $user->save();
                }
            }

            $request->session()->flash('success', "Your document are send to admin for Identity Verification");
            return redirect()->route('client.dashboard.index', [encrypt($user->id)]);
        } catch (ModelNotFoundException $e) {
            $message = trans("registration unsuccessful");
            $request->session()->flash('error', $message);
            return redirect()->back();
        }
    }


    public function electionView()
    {
        return view('frontend.page.election');
    }

    public function election(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                "country_id" => 'required',
                // 'file0' => 'required_without_all:file1,|mimes:png,jpeg,bmp,png|max:2000',
            ], [
                // 'file0.required_without_all' => 'You have to fill at least one image',
                // 'file0.mimes' => 'Image is only take png, jpg',
                // 'file1.mimes' => 'Image is only take png, jpg',
                // 'file0.max' => 'The image must not be greater then 2 mb',
                // 'file1.max' => 'The image must not be greater then 2 mb',
            ]
        );
        try {
            $datas = ['file0', 'file1'];
            foreach ($datas as $key => $value) {
                if ($request['file' . $key] != '') {
            $user = new VerificationDocument();
            $user->user_id = auth()->id();
            $user->country_id = $input['country_id'];
            $image = $request['file' . $key];
            $png_url = "client-" . rand() . '.' . $image->extension();
            $image->move(public_path('client_assets/'), $png_url);
            $mediaName3 = 'client_assets/' . $png_url;
            $user->file = $mediaName3;
            $user->type = $input['documentType'];
            $user->save();
                }
            }

            $request->session()->flash('success', "Your document are send to admin for Identity Verification");
            return redirect()->route('client.dashboard.index', [encrypt($user->id)]);
        } catch (ModelNotFoundException $e) {
            $message = trans("registration unsuccessful");
            $request->session()->flash('error', $message);
            return redirect()->back();
        }
    }

    public function electionAuditingView()
    {
        return view('frontend.page.election');
    }

    public function electionAuditing(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                "country_id" => 'required',
                // 'file0' => 'required_without_all:file1,|mimes:png,jpeg,bmp,png|max:2000',
            ], [
                // 'file0.required_without_all' => 'You have to fill at least one image',
                // 'file0.mimes' => 'Image is only take png, jpg',
                // 'file1.mimes' => 'Image is only take png, jpg',
                // 'file0.max' => 'The image must not be greater then 2 mb',
                // 'file1.max' => 'The image must not be greater then 2 mb',
            ]
        );
        try {
            $datas = ['file0', 'file1'];
            foreach ($datas as $key => $value) {
                if ($request['file' . $key] != '') {
            $user = new VerificationDocument();
            $user->user_id = auth()->id();
            $user->country_id = $input['country_id'];
            $image = $request['file' . $key];
            $png_url = "client-" . rand() . '.' . $image->extension();
            $image->move(public_path('client_assets/'), $png_url);
            $mediaName3 = 'client_assets/' . $png_url;
            $user->file = $mediaName3;
            $user->type = $input['documentType'];
            $user->save();
                }
            }

            $request->session()->flash('success', "Your document are send to admin for Identity Verification");
            return redirect()->route('client.dashboard.index', [encrypt($user->id)]);
        } catch (ModelNotFoundException $e) {
            $message = trans("registration unsuccessful");
            $request->session()->flash('error', $message);
            return redirect()->back();
        }
    }

  public function projectionView()
    {
        return view('frontend.page.projection');
    }

    public function projection(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                "country_id" => 'required',
                // 'file0' => 'required_without_all:file1,|mimes:png,jpeg,bmp,png|max:2000',
            ], [
                // 'file0.required_without_all' => 'You have to fill at least one image',
                // 'file0.mimes' => 'Image is only take png, jpg',
                // 'file1.mimes' => 'Image is only take png, jpg',
                // 'file0.max' => 'The image must not be greater then 2 mb',
                // 'file1.max' => 'The image must not be greater then 2 mb',
            ]
        );
        try {
            $datas = ['file0', 'file1'];
            foreach ($datas as $key => $value) {
                if ($request['file' . $key] != '') {
            $user = new VerificationDocument();
            $user->user_id = auth()->id();
            $user->country_id = $input['country_id'];
            $image = $request['file' . $key];
            $png_url = "client-" . rand() . '.' . $image->extension();
            $image->move(public_path('client_assets/'), $png_url);
            $mediaName3 = 'client_assets/' . $png_url;
            $user->file = $mediaName3;
            $user->type = $input['documentType'];
            $user->save();
                }
            }

            $request->session()->flash('success', "Your document are send to admin for Identity Verification");
            return redirect()->route('client.dashboard.index', [encrypt($user->id)]);
        } catch (ModelNotFoundException $e) {
            $message = trans("registration unsuccessful");
            $request->session()->flash('error', $message);
            return redirect()->back();
        }
    }

    public function localView($value)
    {
        if($value == "USA"){
            $value = $value;
        } else {
        $value = decrypt($value);
    }
        return view('frontend.page.local',compact('value'));
    }

    public function local(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                "country_id" => 'required',
                // 'file0' => 'required_without_all:file1,|mimes:png,jpeg,bmp,png|max:2000',
            ], [
                // 'file0.required_without_all' => 'You have to fill at least one image',
                // 'file0.mimes' => 'Image is only take png, jpg',
                // 'file1.mimes' => 'Image is only take png, jpg',
                // 'file0.max' => 'The image must not be greater then 2 mb',
                // 'file1.max' => 'The image must not be greater then 2 mb',
            ]
        );
        try {
            $datas = ['file0', 'file1'];
            foreach ($datas as $key => $value) {
                if ($request['file' . $key] != '') {
            $user = new VerificationDocument();
            $user->user_id = auth()->id();
            $user->country_id = $input['country_id'];
            $image = $request['file' . $key];
            $png_url = "client-" . rand() . '.' . $image->extension();
            $image->move(public_path('client_assets/'), $png_url);
            $mediaName3 = 'client_assets/' . $png_url;
            $user->file = $mediaName3;
            $user->type = $input['documentType'];
            $user->save();
                }
            }

            $request->session()->flash('success', "Your document are send to admin for Identity Verification");
            return redirect()->route('client.dashboard.index', [encrypt($user->id)]);
        } catch (ModelNotFoundException $e) {
            $message = trans("registration unsuccessful");
            $request->session()->flash('error', $message);
            return redirect()->back();
        }
    }

    public function federalView()
    {
        return view('frontend.page.federal');
    }

    public function federal(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                "country_id" => 'required',
                // 'file0' => 'required_without_all:file1,|mimes:png,jpeg,bmp,png|max:2000',
            ], [
                // 'file0.required_without_all' => 'You have to fill at least one image',
                // 'file0.mimes' => 'Image is only take png, jpg',
                // 'file1.mimes' => 'Image is only take png, jpg',
                // 'file0.max' => 'The image must not be greater then 2 mb',
                // 'file1.max' => 'The image must not be greater then 2 mb',
            ]
        );
        try {
            $datas = ['file0', 'file1'];
            foreach ($datas as $key => $value) {
                if ($request['file' . $key] != '') {
            $user = new VerificationDocument();
            $user->user_id = auth()->id();
            $user->country_id = $input['country_id'];
            $image = $request['file' . $key];
            $png_url = "client-" . rand() . '.' . $image->extension();
            $image->move(public_path('client_assets/'), $png_url);
            $mediaName3 = 'client_assets/' . $png_url;
            $user->file = $mediaName3;
            $user->type = $input['documentType'];
            $user->save();
                }
            }

            $request->session()->flash('success', "Your document are send to admin for Identity Verification");
            return redirect()->route('client.dashboard.index', [encrypt($user->id)]);
        } catch (ModelNotFoundException $e) {
            $message = trans("registration unsuccessful");
            $request->session()->flash('error', $message);
            return redirect()->back();
        }
    }

    public function stateView($value)
    {
        if($value == "USA"){
            $value = $value;
        } else {
        $value = decrypt($value);
        }
        return view('frontend.page.state',compact('value'));
    }

    public function state(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                "country_id" => 'required',
                // 'file0' => 'required_without_all:file1,|mimes:png,jpeg,bmp,png|max:2000',
            ], [
                // 'file0.required_without_all' => 'You have to fill at least one image',
                // 'file0.mimes' => 'Image is only take png, jpg',
                // 'file1.mimes' => 'Image is only take png, jpg',
                // 'file0.max' => 'The image must not be greater then 2 mb',
                // 'file1.max' => 'The image must not be greater then 2 mb',
            ]
        );
        try {
            $datas = ['file0', 'file1'];
            foreach ($datas as $key => $value) {
                if ($request['file' . $key] != '') {
            $user = new VerificationDocument();
            $user->user_id = auth()->id();
            $user->country_id = $input['country_id'];
            $image = $request['file' . $key];
            $png_url = "client-" . rand() . '.' . $image->extension();
            $image->move(public_path('client_assets/'), $png_url);
            $mediaName3 = 'client_assets/' . $png_url;
            $user->file = $mediaName3;
            $user->type = $input['documentType'];
            $user->save();
                }
            }

            $request->session()->flash('success', "Your document are send to admin for Identity Verification");
            return redirect()->route('client.dashboard.index', [encrypt($user->id)]);
        } catch (ModelNotFoundException $e) {
            $message = trans("registration unsuccessful");
            $request->session()->flash('error', $message);
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        $id = decrypt($id);
        $countryCode = Country::get();
        $datas = Business::where('id', $id)->first();
        $documents = BusinedssSlider::where('user_id', $id)->get();
        $times = BusinessHour::where('user_id', $id)->get();
        $event = BusinessHour::where('user_id', $id)->first();

        $new_datas = TestBusiness::where('business_user_id', $datas->id)->first();
        if ($new_datas) {
            $new_times = TestBusinessHour::where('user_id', $new_datas->id)->get();
            $new_event = TestBusinessHour::where('user_id', $new_datas->id)->first();
            $new_slider = TestBusinessSlider::where('user_id', $new_datas->id)->get();
            $data = [
                'new_slider' => $new_slider,
                'new_datas' => $new_datas,
                'new_tdata' => $new_times,
                'new_event' => $new_event,
                'sdata' => $datas,
                'tdata' => $times,
                'ddata' => $documents,
                'event' => $event,
                'countryCode' => $countryCode,
            ];
        } else {
            $data = [
                'new_datas' => $new_datas,
                'event' => $event,
                'sdata' => $datas,
                'tdata' => $times,
                'ddata' => $documents,
                'countryCode' => $countryCode,
            ];
        }
        return view('frontend.page.dashboard.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $data = Business::where('id', $id)->first();
        $documents = BusinedssSlider::where('user_id', $id)->get();
        $times = BusinessHour::where('user_id', $id)->get();
        $new_data = TestBusiness::where('business_user_id', $id)->first();
        $input = $request->all();
        $request->validate(
            [
                "name" => 'required',
                "mobile_number" => 'required',
                "address" => 'required',
                "web_link" => 'required',
                "description" => 'required',
                'email' => 'required|regex:/^[A-Za-z0-9._]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/',
                // 'cover_img' => 'mimes:jpeg,jpg,png|max:2000',
                'image_0' => 'mimes:jpeg,jpg,png|max:2000',
                'image_1' => 'mimes:jpeg,jpg,png|max:2000',
                'image_2' => 'mimes:jpeg,jpg,png|max:2000',
            ], [
                'image_0.mimes' => 'Image is only take png, jpg',
                'image_1.mimes' => 'Image is only take png, jpg',
                'image_2.mimes' => 'Image is only take png, jpg',
                'image_0.max' => 'The image must not be greater then 2 mb',
                'image_1.max' => 'The image must not be greater then 2 mb',
                'image_2.max' => 'The image must not be greater then 2 mb',
                // 'cover_img.max' => 'The logo must not be greater then 2 mb',
            ]
        );
        try {

            if ($data->status != 2) {
                // update main business
                // $cover_img = $request['cover_img'];
                // if ($cover_img != '') {
                //     $destination = 'public/' . $data->cover_img;
                //     if (File::Exists($destination)) {
                //         File::delete($destination);
                //     }
                //     $png_url = "business-" . rand() . '.' . $cover_img->extension();
                //     $cover_img->move(public_path('business_assets/uploads/logo/'), $png_url);
                //     $mediaName = 'business_assets/uploads/logo/' . $png_url;
                //     $data->cover_img = $mediaName;
                // }
                $data->name = $input['name'];
                $data->country_code = $input['code'];
                $data->mobile_number = $input['mobile_number'];
                $data->email = $input['email'];
                $data->address = $input['address'];
                $data->description = $input['description'];
                $data->web_link = $input['web_link'];
                $data->lat = $input['lat'];
                $data->lng = $input['long'];
                $category = BusinessCategory::where('user_id', $id)->first();
                if ($category == null) {
                    $request->session()->flash('error', trans("You need to first create category"));
                    return redirect()->route('business.dashboard.edit', encrypt($id));
                }
                if ($data->is_submitted == null) {
                    // $data->status = 1;
                    $data->is_submitted = null;
                }
                $data->save();

                $documentation0 = $request['image_0'];
                $documentation1 = $request['image_1'];
                $documentation2 = $request['image_2'];

                if (($documentation0 || $documentation1 || $documentation2) != '') {
                    foreach ($documents as $key => $value) {

                        if ($request['image_' . $key] != '') {
                            $destination = 'public/' . $value;
                            if (File::Exists($destination)) {
                                File::delete($destination);
                            }
                            $image = $input['image_' . $key];
                            $png_url = "business-" . rand() . '.' . $image->extension();
                            $image->move(public_path('business_assets/uploads/image/'), $png_url);
                            $mediaName = 'business_assets/uploads/image/' . $png_url;
                            BusinedssSlider::where('id', $input['img_id' . $key])->update([
                                'image' => $mediaName,
                            ]);

                        }
                    }
                }

                foreach ($times as $key => $data) {

                    if ($request->start_date) {
                        BusinessHour::where('id', $request->event_id)->update([
                            'start_date' => $request->start_date,
                            'end_date' => $request->end_date,
                            'open_time' => $request->open_time,
                            'close_time' => $request->close_time,
                        ]);
                    } else {
                        if ($input['status' . $key] != '') {
                            BusinessHour::where('id', $input['time_id' . $key])->update([
                                'status' => $input['status' . $key],
                                'open_time' => null,
                                'close_time' => null,
                            ]);
                        } else {
                            BusinessHour::where('id', $input['time_id' . $key])->update([
                                'status' => null,
                                'open_time' => $input['open' . $key],
                                'close_time' => $input['close' . $key],
                            ]);
                        }
                    }

                }

            } elseif ($data->is_unsubmitted == 1) {
                // change after profile list and reject
                // dd($input);
                Business::where('id', $id)->update([
                    'is_submitted' => 1,
                    'is_unsubmitted' => null,
                ]);
                $new_data->name = $input['name'];
                $new_data->country_code = $input['code'];
                $new_data->mobile_number = $input['mobile_number'];
                $new_data->email = $input['email'];
                $new_data->address = $input['address'];
                $new_data->description = $input['description'];
                $new_data->web_link = $input['web_link'];
                $new_data->lat = $input['lat'];
                $new_data->lng = $input['long'];
                $new_data->save();
                // dd($request->all());

                $documentation0 = $request['image_0'];
                $documentation1 = $request['image_1'];
                $documentation2 = $request['image_2'];

                if (($documentation0 || $documentation1 || $documentation2) != '') {
                    foreach ($documents as $key => $value) {

                        if ($input['image_' . $key] != '') {
                            $destination = 'public/' . $value;
                            if (File::Exists($destination)) {
                                File::delete($destination);
                            }
                            $image = $input['image_' . $key];
                            $png_url = "business-" . rand() . '.' . $image->extension();
                            $image->move(public_path('business_assets/uploads/image/'), $png_url);
                            $mediaName = 'business_assets/uploads/image/' . $png_url;
                            TestBusinessSlider::where('id', $input['img_id' . $key])->update([
                                'image' => $mediaName,
                            ]);

                        }
                    }
                }

                foreach ($times as $key => $data) {
                    if ($request->start_date) {
                        TestBusinessHour::where('id', $request->event_id)->update([
                            'start_date' => $request->start_date,
                            'end_date' => $request->end_date,
                            'open_time' => $request->open_time,
                            'close_time' => $request->close_time,
                        ]);
                    } else {
                        if ($input['status' . $key] != '') {
                            TestBusinessHour::where('id', $input['time_id' . $key])->update([
                                'status' => $input['status' . $key],
                                'open_time' => null,
                                'close_time' => null,
                            ]);
                        } else {
                            TestBusinessHour::where('id', $input['time_id' . $key])->update([
                                'status' => null,
                                'open_time' => $input['open' . $key],
                                'close_time' => $input['close' . $key],
                            ]);
                        }
                    }

                }

                Session::flash('success', 'Data updated successfully');
                return redirect()->route('business.dashboard.index');

            } else {
                // after profile is listed then user update it
                Business::where('id', $id)->update([
                    'is_submitted' => 1,
                ]);

                $testData = new TestBusiness;

                // $cover_img = $request['cover_img'];
                // if ($cover_img != '') {
                //     $png_url = "business-" . rand() . '.' . $cover_img->extension();
                //     $cover_img->move(public_path('business_assets/uploads/logo/'), $png_url);
                //     $mediaName = 'business_assets/uploads/logo/' . $png_url;
                //     $testData->cover_img = $mediaName;
                // }
                $testData->name = $input['name'];
                $testData->country_code = $input['code'];
                $testData->mobile_number = $input['mobile_number'];
                $testData->email = $input['email'];
                $testData->address = $input['address'];
                $testData->description = $input['description'];
                $testData->web_link = $input['web_link'];
                $testData->business_user_id = $data->id;
                $testData->lat = $input['lat'];
                $testData->lng = $input['long'];
                $testData->save();

                $datas = [$request->image_0, $request->image_1, $request->image_2];
                foreach ($datas as $key => $value) {

                    $data = new TestBusinessSlider;
                    $data->user_id = $testData->id;
                    if ($value != '') {
                        $image = $value;
                        $png_url = "business-" . rand() . '.' . $image->extension();
                        $image->move(public_path('business_assets/uploads/image/'), $png_url);
                        $mediaName3 = 'business_assets/uploads/image/' . $png_url;
                        $data->image = $mediaName3;
                    } else {
                        $data->image = null;
                    }
                    $data->business_slider_id = $input['img_id' . $key];
                    $data->save();
                }
                if ($request->start_date) {
                    $event = new TestBusinessHour;
                    $event->user_id = $testData->id;
                    $event->business_hours_id = $request->event_id;
                    $event->start_date = $request->start_date;
                    $event->end_date = $request->end_date;
                    $event->open_time = $request->open_time;
                    $event->close_time = $request->close_time;
                    $event->save();
                } else {

                    $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    foreach ($days as $key => $value) {
                        $time = new TestBusinessHour;
                        $time->user_id = $testData->id;
                        $time->business_hours_id = $input['time_id' . $key];
                        $time->day = $value;
                        if ($input['status' . $key] != '') {
                            $time->status = $input['status' . $key];
                        } else {
                            $time->open_time = $input['open' . $key];
                            $time->close_time = $input['close' . $key];
                        }
                        $time->save();
                    }
                    Session::flash('success', 'Data updated successfully');
                    return redirect()->route('business.dashboard.index');
                }
            }

            Session::flash('success', 'Data updated successfully');
            return redirect()->route('business.dashboard.index', [encrypt($id)]);
        } catch (ModelNotFoundException $e) {
            $message = trans("admin_lang.record_update_failed");
            Session::flash('error', 'Something is wrong. Please try again');
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $id = decrypt($id);
            $datas = Business::find($id);
            $newDate = TestBusiness::where('business_user_id', $datas->id)->first();
            if ($newDate) {
                $data = Business::findOrFail($id)->delete();
                $timeData = BusinessHour::where('user_id', $id)->delete();
                $Doc = BusinedssSlider::where('user_id', $id)->delete();
                $cat = BusinessCategory::where('user_id', $id)->delete();
                $newDatee = TestBusiness::where('business_user_id', $datas->id)->delete();
                $newTimeData = TestBusinessHour::where('user_id', $newDate->id)->delete();
                $newDoc = TestBusinessSlider::where('user_id', $newDate->id)->delete();
            } else {
                $data = Business::findOrFail($id)->delete();
                $timeData = BusinessHour::where('user_id', $id)->delete();
                $Doc = BusinedssSlider::where('user_id', $id)->delete();
                $cat = BusinessCategory::where('user_id', $id)->delete();
                $offer = OfferDeal::where('user_id', $id)->delete();

            }
            Session::flash('success', 'Data deleted successfully');
            return redirect('/business/dashboard');
        } catch (ModelNotFoundException $e) {
            Session::flash('error', 'Something is wrong. Please try again');
            return redirect()->back();
        }
    }

    public function editProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $events = Event::orderBy('id', 'DESC')->paginate(4);

        return view('frontend.page.profile.edit', compact('user','events'));
    }
    public function editProfilePost(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required',
            'password' => 'required|min:8|max:25|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'confirmation_password' => 'required|min:8|required_with:password|same:password',
            'email' => 'required|regex:/^[A-Za-z0-9._]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/',
        ], [
            'new_password.regex' => 'Password field will allow >=8 characters with standard password policy (one Capital letter, one Number, one special character',
            'password.required' => 'Please fill password!',
            'email.required' => 'Please fill email!',
            'mobile_number.required' => 'Please fill mobile number!',
        ]);

        if ($validator->fails()) {
            return redirect("/client/edit-profile")
                ->withErrors($validator)
                ->withInput();
        } else {

            try {
                $user->mobile_number = $input['mobile_number'];
                $user->password =Hash::make($request->password);
                $user->email = $input['email'];
                $user->save();
                return redirect()->back()->with('success', 'Profile updated successfully!');
            } catch (ModelNotFoundException $e) {
                $message = trans("registration unsuccessful");
                $request->session()->flash('error', $message);
                return redirect()->back();
            }
        }
    }

    public function updateProfileImage(Request $request)
    {
        $user = auth()->user();
    // dd($request->all());
        // Handle Profile Image
        if ($request->profile_image != null) {
            $imageData = $request->input('profile_image');
            $image_parts = explode(";base64,", $imageData);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
    
            $fileName = uniqid() . '.' . $image_type;
            $filePath = 'profile_images/' . $fileName;
    
            // Save the profile image to public/profile_images/
            file_put_contents(public_path($filePath), $image_base64);
    
            // Update the user's profile image in the database
            $user->profile_image = $filePath;
        }
    
        // Handle Background Image
        if ($request->background_image != null) {
            $imageData = $request->input('background_image');
            $image_parts = explode(";base64,", $imageData);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
    
            $fileName = uniqid() . '.' . $image_type;
            $filePath = 'background_images/' . $fileName;
    
            // Save the background image to public/background_images/
            file_put_contents(public_path($filePath), $image_base64);
    
            // Update the user's background image in the database
            $user->background_image = $filePath;
        }
    
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend/page/profile/changePassword', compact('user'));
    }
    public function changePasswordPost(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $request->validate([
            'current_password' => 'required',

            'new_password' => 'required|min:8|max:25|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',

            'confirmation_password' => 'required|min:8|required_with:new_password|same:new_password',

        ],
            [
                'new_password.regex' => 'Password field will allow >=8 characters with standard password policy (one Capital letter, one Number, one special character',
            ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error_message', 'Current password does not match.');
        } else {
            if (!Hash::check($request->new_password, $user->password) != $user->password) {
                return back()->with('error_messages', 'New password is already taken.');
            } else {

                User::find($user->id)->update(['password' => Hash::make($request->new_password)]);
                // Auth::logoutOtherDevices();
                return redirect()->route('business.dashboard.index')->with('message', 'Password updated successfully');}
        }
    }

    public function submitAdmin($id)
    {
        $id = decrypt($id);
        // dd($id);

        Business::where('id', $id)->update([
            'status' => 1,
        ]);

        return redirect()->route('business.dashboard.index')->with('message', 'Submit for Approval successfully');
    }

    public function submitState(Request $request)
    {
        // Get the state ID from the request
        $stateId = encrypt($request->input('state_id'));
        // You can process the state ID here (e.g., save it or perform an action)
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'State ID received!',
        //     'state_id' => $stateId
        // ]);

        if($stateId != null){
            return response()->json([
                'status' => 'success',
                'redirect_url' => route('client.stateView', ['value' => $stateId])
            ]);
        } else {
            // response()->json([
            //     'redirect_url' => route('client.stateView', ['stateId' => $stateId])
            // ]);
        }
    }

    public function submitLocal(Request $request)
    {
        // Get the state ID from the request
        $localId = encrypt($request->input('local_id'));
        if($localId != null){
            return response()->json([
                'status' => 'success',
                'redirect_url' => route('client.localView', ['value' => $localId])
            ]);
            // return redirect()->route('client.localView');
        } else {
            // return redirect()->back();
        }
        // You can process the state ID here (e.g., save it or perform an action)
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'State ID received!',
        //     'state_id' => $stateId
        // ]);
    }

    public function documentVerfy(Request $request)
    {
        dd($request);
    }
}
