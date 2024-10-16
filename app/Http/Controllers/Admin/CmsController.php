<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cms;
use Auth;
use Valid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Storage;
use Illuminate\Support\Str;
use DB;
use Rap2hpoutre\FastExcel\FastExcel;

class CmsController extends Controller {

    public $pageUrl = "cms";
    public $langPath = "cms";

    public function __construct() {
        $this->Models = new Cms();
        $this->sortable_columns = [
            0 => 'id',
            1 => 'title',
            2 => 'description',
        ];
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $totaldata = $this->Models->getModel($limit, $start, $search, $this->sortable_columns[$orderby], $order)->count();
            $response = $this->Models->getModel($limit, $start, $search, $this->sortable_columns[$orderby], $order)
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

            $datas = array();
            $i = 1;
            foreach ($data as $value) {
                $u['DT_RowId'] = $start + $i;
                $u['title'] = Str::words(ucfirst($value->title));
                $u['description'] = Str::words($value->content, 40);
                //$u['status'] = createStatus($value->status, $value->id, ['1' => 'Active', '0' => 'Inactive'], 'changeStatus', $this->pageUrl . '.status')->toHtml();
                $u['actions'] = '<div class="btn-group" role="group" aria-label="User Actions">';
                $u['actions'] .= '<a href="'.route('admin.'.$this->pageUrl.'.edit',[encrypt($value->id)]).'" class="btn btn-info btn-sm " data-toggle="tooltip" title="Edit" style="float:right;"> <i class="fas fa-edit"></i></a>';
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
        return view('admin.' . $this->pageUrl . '.index', $data);
    }

    public function create(Request $request) {
        $data = [
            "page_title" => "Admin | Manage " . ucwords(trans('admin_lang.' . $this->langPath)),
            "langPath" => $this->langPath,
            'pagePath' => $this->pageUrl,
            'pageLang' => $this->pageUrl,
            'pageName' => $this->pageUrl,
        ];
        return view('admin.' . $this->pageUrl . '.create', $data);
    }

    public function store(Request $request) {
        $input = $request->all();
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ],
        [
            'title.required' => 'Please fill title!',
            'content.required' => 'Please fill content!',
        ]
    );
        $data = new $this->Models;
        $data->title = $input['title'];
        $data->content = !empty($input['content']) ? $input['content'] : '';
        $data->slug =  !empty($input['title']) ? $input['title'] : '';
        $data->save();
        $request->session()->flash('alert-success', trans("admin_lang.record_add_success"));
        return redirectRoute($this->pageUrl . '.index');
    }

    public function edit($id) {
        $id = decrypt($id);
        $datas = Cms::where('id', $id)->first();
        $data = [
            'page_title' => 'Admin | Update  ' . ucwords(trans('admin_lang.' . $this->langPath)),
            'sdata' => $datas,
            'pagePath' => $this->pageUrl,
            "langPath" => $this->langPath,
        ];
        return view('admin.' . $this->pageUrl . '.edit', $data);
    }

    public function update(Request $request, $id) {
        $id = decrypt($id);
        $data = Cms::where('id', $id)->first();
        $input = $request->all();
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ],
        [
            'title.required' => 'Please fill title!',
            'content.required' => 'Please fill content!',
        ]
    );
        try {
            $data->title = $input['title'];
            $data->content = !empty($input['content']) ? $input['content'] : '';
            $data->save();
            $request->session()->flash('alert-success', trans("admin_lang.record_update_success"));
            return redirectRoute($this->pageUrl . '.index');
        } catch (ModelNotFoundException $e) {
            $message = trans("admin_lang.record_update_failed");
            $request->session()->flash('alert-danger', $message);
            return redirect()->back();
        }
    }
    public function show(Request $request) {
        $id = decrypt($request->id);
        $datas = Cms::where('id', $id)->first();
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
            $data = Cms::findOrFail($id);
            $data->status = $request->status;
            $data->save();
            return response(['label' => 'Record Update', 'msg' => trans("admin_lang.status_update_success"), 'status' => 'success']);
        } catch (ModelNotFoundException $e) {
            $request->session()->flash('alert-danger', trans("admin_lang.status_update_failed"));
            return redirect()->back();
        }
    }

    public function destroy($id) {
        $id = decrypt($id);
        try {
            $data = Cms::findOrFail($id);
            $data->delete();
            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            return redirect()->back();
        }
    }

}
