<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use File;


class CategoryController extends Controller {

    public $pageUrl = "category";
    public $langPath = "category";
    public $delete = "category.delete";

    public function __construct() {
        $this->Models = new Category();
        $this->sortable_columns = [
            0 => 'id',
            1 => 'title',
            2 => 'status',
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
            $totaldata = $this->Models->getModel($limit, $start, $search, $this->sortable_columns[$orderby], $order)->whereNull('parent_id')->count();
            $response = $this->Models->getModel($limit, $start, $search, $this->sortable_columns[$orderby], $order)       
            ->whereNull('parent_id')        
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
                   
                    $u['title'] = Str::words(ucfirst($value->title ?? ""), 40);
                    $u['status'] = createStatus($value->status, $value->id, ['1' => 'Active', '0' => 'Inactive'], 'changeStatus', $this->pageUrl . '.status')->toHtml();
                    $u['actions'] = '<div class="btn-group" role="group" aria-label="User Actions">';
                    $u['actions'] .= '<a href="'.route('admin.'.$this->pageUrl.'.edit',[encrypt($value->id)]).'" class="btn btn-info btn-sm " data-toggle="tooltip" title="Edit" style="float:right;"> <i class="fas fa-edit"></i></a>';
                    // $u['actions'] .= '<a href="' . route('admin.' . $this->delete, [encrypt($value->id)]) . '" class="btn btn-danger btn-sm " data-toggle="tooltip" title="delete" style="float:right;"> <i class="fas fa-trash-alt" ></i></a>';
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
        return view('admin.' . $this->pageUrl . '.index', $data );
    }

    public function create(Request $request) {
        $datas = $this->Models::all();
        $data = [
            "page_title" => "Admin | Manage " . ucwords(trans('admin_lang.' . $this->langPath)),
            "langPath" => $this->langPath,
            'pagePath' => $this->pageUrl,
            'pageLang' => $this->pageUrl,
            'pageName' => $this->pageUrl,
            'sdata'    => $datas 
        ];
        return view('admin.' . $this->pageUrl . '.create', $data);
    }

    public function store(Request $request) {
        $input = $request->all();
        $request->validate([
            'title' => 'required|unique:categories,title',
        ],
        [
        'title.required' => 'Please fill Category name!',
        'title.unique' => 'this category is already taken!',
         ]);
                    $data = new $this->Models;
                    $data->title = $request['title'];
                    $data->save();
        Session::flash('success', 'Data added successfully');
        return redirectRoute($this->pageUrl . '.index');
    }

    public function edit($id) {
        $id = decrypt($id);
        $datas = $this->Models::where('id', $id)->first();
        $data = [
            'page_title' => 'Admin | Update  ' . ucwords(trans('admin_lang.' . $this->langPath)),
            'sdata' => $datas,
            'pagePath' => $this->pageUrl,
            "langPath" => $this->langPath,
        ];
        return view('admin.' . $this->pageUrl . '.edit', $data );
    }

    public function update(Request $request, $id) {
        $id = decrypt($id);
        $data = $this->Models::where('id', $id)->first();
        $input = $request->all();
        $request->validate([
            'title' => 'required|unique:categories,title,'. $data->id,
        ],
        [
            'title.required' => 'Please fill Category name!',
            'title.unique' => 'this category is already taken!',
        ]);
        try {
            $data->title = $request['title'];
            $data->save();
            Session::flash('success', 'Data updated successfully');
            return redirectRoute($this->pageUrl . '.index');
        } catch (ModelNotFoundException $e) {
            $message = trans("admin_lang.record_update_failed");
            Session::flash('error', 'Something is wrong. Please try again');
            return redirect()->back();
        }
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

}
