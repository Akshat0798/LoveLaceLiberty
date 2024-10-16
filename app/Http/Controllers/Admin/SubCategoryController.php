<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class SubCategoryController extends Controller {

    public $pageUrl = "subCategory";
    public $langPath = "subCategory";
    public $delete = "subCategory.delete";

    public function __construct() {
        $this->Models = new Category();
        $this->sortable_columns = [
            0 => 'id',
            1 => 'parent_id',
            2 => 'title',
        ];
    }

    public function index(Request $request) {
      
        $categorys = Category::get();
        if ($request->ajax()) {
            $category = $request->category;
            // dd($category);
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $totaldata = $this->Models->getModel($limit, $start, $search, $this->sortable_columns[$orderby], $order, $category)->whereNotNull('parent_id')->count();
            $response = $this->Models->getModel($limit, $start, $search, $this->sortable_columns[$orderby], $order, $category)
                    ->whereNotNull('parent_id')
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
                    $u['parent'] = Str::words(ucfirst($value->parent->title ?? ""), 40);
                    $u['title'] = Str::words(ucfirst($value->title), 40);
                    $u['status'] = createStatus($value->status, $value->id, ['1' => 'Active', '0' => 'Inactive'], 'changeStatus', $this->pageUrl . '.status')->toHtml();
                    $u['actions'] = '<div class="btn-group" role="group" aria-label="User Actions">';
                    // $u['actions'] .= '<a href="' . route('admin.' . $this->pageUrl . '.show', [encrypt($value->id)]) . '" class="btn btn-warning btn-sm " data-toggle="tooltip" title="View" style="float:right;"> <i class="fa fa-eye"></i></a>';
                    $u['actions'] .= '<a href="'.route('admin.'.$this->pageUrl.'.edit',[encrypt($value->id)]).'" class="btn btn-info btn-sm " data-toggle="tooltip" title="Edit" style="float:right;"> <i class="fas fa-edit"></i></a>';
                    $u['actions'] .= '<a href="' . route('admin.' . $this->delete, [encrypt($value->id)]) . '" class="btn btn-danger btn-sm " data-toggle="tooltip" title="delete" style="float:right;" onclick="return confirmation()"> <i class="fas fa-trash-alt" ></i></a>';
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
        return view('admin.' . $this->pageUrl . '.index', $data, compact('categorys') );
    }

    public function create(Request $request) {
        $categorys = Category::whereStatus('1')->get();
        $datas = $this->Models::all();
        $data = [
            "page_title" => "Admin | Manage " . ucwords(trans('admin_lang.' . $this->langPath)),
            "langPath" => $this->langPath,
            'pagePath' => $this->pageUrl,
            'pageLang' => $this->pageUrl,
            'pageName' => $this->pageUrl,
        ];
        return view('admin.' . $this->pageUrl . '.create', $data, compact('categorys','datas') );
    }

    public function store(Request $request) {
        $input = $request->all();
        $request->validate([
            'parent_id' => 'required',
            'title' => 'required|max:50|unique:categories,title',
        ],
        [
        'parent_id.required' => 'Please select Sub Category!',
        'title.required' => 'Please fill Keyword!',
        'title.unique' => 'This Sub Category is already associated with a category and can’t be
        added into this',
         ]);
                    $data = new $this->Models;  
                    if($request->parent_id ){
                    $data->parent_id = $request['parent_id'];
                    }
                    $data->title = $request->title;
                    $data->save();
        Session::flash('success', 'Data added successfully');
        return redirectRoute($this->pageUrl . '.index');
    }

    public function edit($id) {
        $categorys = Category::whereStatus('1')->get();
        $id = decrypt($id);
        $datas = $this->Models::where('id', $id)->first();
        $data = [
            'page_title' => 'Admin | Update  ' . ucwords(trans('admin_lang.' . $this->langPath)),
            'sdata' => $datas,
            'pagePath' => $this->pageUrl,
            "langPath" => $this->langPath,
        ];
        return view('admin.' . $this->pageUrl . '.edit', $data ,compact('categorys'));
    }

    public function update(Request $request, $id) {
        $id = decrypt($id);
        $data = $this->Models::where('id', $id)->first();
        $input = $request->all();
        $request->validate([
            'parent_id' => 'required',
            'title' => 'required|max:50',
        ],
        [
        'parent_id' => 'Please select Category!',
        'title.required' => 'Please fill Sub category!',
        ]
    );
        try {
            $data->parent_id = $input['parent_id']?$input['parent_id']:'';
            $data->title = $input['title']?$input['title']:'';
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

}
