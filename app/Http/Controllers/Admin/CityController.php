<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms;
use Auth;
use Valid;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Storage;
use Illuminate\Support\Str;
use DB;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Session;
use App\Models\State;
use App\Models\City;
use App\Models\Country;

class CityController extends Controller
{
    public $pageUrl = "city";
    public $langPath = "city";
    public $delete = "city.delete";

    public function __construct() {
        $this->Models = new City();
        $this->sortable_columns = [
            0 => 'id',
            1 => 'name',
            2 => 'name',
            3 => 'name',
        ];
    }

    public function index(Request $request) {
        $country = Country::get();
        if ($request->ajax()) {
            $country =$request->country;
            $state =$request->state;
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $totaldata = $this->Models->getModel($limit, $start, $search, $this->sortable_columns[$orderby], $order,  $state,  $country)->count();
            $response = $this->Models->getModel($limit, $start, $search, $this->sortable_columns[$orderby], $order,  $state,  $country)
                    ->offset($start)
                    ->limit($limit)
                    ->get();

            if (!$response) {
                $data = [];
                $paging = [];
            } else {
                $data = $response;
                $paging = $response;
            }
            //dd($response->toArray());
            $datas = array();
            $i = 1;
            foreach ($data as $value) {

                    $u['DT_RowId'] = $start + $i;
                    $u['country'] = @$value['state']['country']['name'];
                    $u['state'] = isset($value->state->name) ? ucfirst($value->state->name) : '-';
                    $u['city'] = isset($value->name) ? ucfirst($value->name) : '-';
                    $u['status'] = createStatus($value->status, $value->id, ['1' => 'Active', '0' => 'Inactive'], 'changeStatus', $this->pageUrl . '.status')->toHtml();
                    $u['actions'] = '<div class="btn-group" role="group" aria-label="User Actions">';
                    // $u['actions'] .= '<a href="' . route('admin.' . $this->pageUrl . '.show', [encrypt($value->id)]) . '" class="btn btn-warning btn-sm " data-toggle="tooltip" title="View" style="float:right;"> <i class="fa fa-eye"></i></a>';
                    $u['actions'] .= '<a href="'.route('admin.'.$this->pageUrl.'.edit',[encrypt($value->id)]).'" class="btn btn-info btn-sm " data-toggle="tooltip" title="Edit" style="float:right;"> <i class="fas fa-edit"></i></a>';
                    $u['actions'] .= '<a href="' . route('admin.' . $this->delete, [encrypt($value->id)]) . '" class="btn btn-danger btn-sm " data-toggle="tooltip" title="delete" style="float:right;"> <i class="fas fa-trash-alt" ></i></a>';
                    $u['actions'] .= '</div>';
                    $datas[] = $u;
                    $i++;
                    unset($u);
            }
            $return = [
                "draw" => intval($draw),
                "recordsFiltered" => intval($totaldata),
                "recordsTotal" => intval($totaldata),
                "data" => $datas
            ];
            return $return;
        }
        $data = [
            'pagePath' => $this->pageUrl,
            'langPath' => $this->langPath,
            'page_title' => 'Admin | Manage ' . ucwords(trans('admin_lang.' . $this->langPath)),
        ];
        return view('admin.' . $this->pageUrl . '.index', $data, compact('country') );
    }

    public function create(Request $request) {
        $country = Country::get();
        $state = State::get();
        $datas = $this->Models::all();
        $data = [
            "page_title" => "Admin | Manage " . ucwords(trans('admin_lang.' . $this->langPath)),
            "langPath" => $this->langPath,
            'pagePath' => $this->pageUrl,
            'pageLang' => $this->pageUrl,
            'pageName' => $this->pageUrl,
        ];
        return view('admin.' . $this->pageUrl . '.create', $data, compact('state','country') );
    }

    public function store(Request $request) {
        $input = $request->all();
        // dd($input);
        $request->validate([
            'name' => 'required|unique:cities',
            'state' => 'required',
            'country' => 'required',
        ],[
            'state.required' => 'Please select state!',
            'country.required' => 'Please select country!',
            'name.required' => 'Please enter city name!',
            'name.unique' => 'This city is already taken!',
        ]
    );
                    $data = new $this->Models;  
                    $data->state_id = $request->input('state');
                    $data->name = $request->input('name');
                    $data->save();
        Session::flash('success', 'Data added successfully');
        return redirectRoute($this->pageUrl . '.index');
    }

    public function edit($id) {
        $country = Country::get();
        $state = State::get();
        $id = decrypt($id);
        $datas = $this->Models::where('id', $id)->first();
        $data = [
            'page_title' => 'Admin | Update  ' . ucwords(trans('admin_lang.' . $this->langPath)),
            'sdata' => $datas,
            'pagePath' => $this->pageUrl,
            "langPath" => $this->langPath,
        ];
        return view('admin.' . $this->pageUrl . '.edit', $data , compact('state','country'));
    }

    public function update(Request $request, $id) {
        $id = decrypt($id);
        $data = $this->Models::where('id', $id)->first();
        $input = $request->all();
        $request->validate([
            'name' => 'required|unique:cities',
            'state' => 'required',
            'country' => 'required',
        ],
        [
            'state.required' => 'Please select state!',
            'country.required' => 'Please select country!',
            'name.required' => 'Please enter city name!',
        ]
    );
        try {
            $data->state_id  = $input['state']?$input['state']:'';
            $data->name  = $input['name']?$input['name']:'';
            // $data->phonecode  = $input['phonecode']?$input['phonecode']:'';
            $data->save();
            Session::flash('success', 'Data updated successfully');
            return redirectRoute($this->pageUrl . '.index');
        } catch (ModelNotFoundException $e) {
            $message = trans("admin_lang.record_update_failed");
            Session::flash('error', 'Something is wrong. Please try again');
            return redirect()->back();
        }
    }
    public function show(Request $request,$id) {
        $id = decrypt($id);
        $datas = $this->Models::where('id', $id)->first();
        $data = [
            'page_title' => 'Admin | View  ' . ucwords(trans('admin_lang.' . $this->langPath)),
            'sdata' => $datas,
            'pagePath' => $this->pageUrl,
            "langPath" => $this->langPath,
        ];
        return view('admin.' . $this->pageUrl . '.view', $data);
    }
    public function updateStatus(Request $request) {
        $id = $request->id;
        try {
            $data = $this->Models::findOrFail($id);
            $data->status = $request->status;
            $data->save();
            Session::flash('success', 'Status updated successfully');
            return response(['label' => 'Record Update', 'msg' => trans("admin_lang.status_update_success"), 'status' => 'success']);
        } catch (ModelNotFoundException $e) {
            Session::flash('error', 'Something is wrong. Please try again');
            return redirect()->back();
        }
    }

    public function destroy(Request $request,$id) {
        $id = decrypt($id);
        try {
            $data = $this->Models::findOrFail($id);
            $data->delete();
            Session::flash('success', 'Data deleted successfully');
            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            Session::flash('error', 'Something is wrong. Please try again');
            return redirect()->back();
        }
    }

    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

}
