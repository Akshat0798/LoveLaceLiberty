<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Candidate;
use App\Models\State;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CandidateController extends Controller
{
    // protected $redirectTo = '/';
    public $pageUrl = "candidate";
    public $delete = "candidate.delete";
    public $Models, $sortable_columns;
    public $pageTitle = 'Admin | Manage';

    public function __construct()
    {
        $this->Models = new Candidate();

        $this->sortable_columns = [
            0 => 'id',
            1 => 'name',
            2 => 'title',
            3 => 'description',
            4 => 'status',
        ];
    }

    public function index(Request $request)
    {
        $type = $request->type;
        if ($request->ajax()) {
            $status = $request->status;
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $input = $request->all();
            $sortable_columns = $this->sortable_columns;

            $totaldata = $this->Models->getModel($limit, $start, $search, $sortable_columns[$orderby], $order, $type, $input)->count();
            $response = $this->Models->getModel($limit, $start, $search, $sortable_columns[$orderby], $order, $type, $input)  
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
            $allstatus = ['1' => 'Active', '0' => 'Inactive'];
            foreach ($data as $value) {
                $u['DT_RowId'] = $start + $i;
                $u['name'] = ucfirst($value->name) ?? '-' ;
                $u['title'] = $value->title;
                $u['description'] = $value->description;
                $u['status'] = createStatus($value->status, $value->id, ['1' => 'Active', '0' => 'Inactive'], 'changeStatus', $this->pageUrl . '.status')->toHtml();
                $u['actions'] = '<div class="btn-group" role="group" aria-label="Candidate Actions">';
                // $u['actions'] .= '<a href="' . route('admin.' . $this->pageUrl . '.show', [encrypt($value->id)]) . '" class="btn btn-warning btn-sm " data-toggle="tooltip" title="View" style="float:right;"> <i class="fa fa-eye"></i></a>';
                $u['actions'] .= '<a href="' . route('admin.' . $this->pageUrl . '.edit', [encrypt($value->id)]) . '" class="btn btn-info btn-sm " data-toggle="tooltip" title="Edit" style="float:right;"> <i class="fas fa-edit"></i></a>';
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
                "data" => $datas,
            ];
            return $return;
        }
        $data = [
            'pagePath' => $this->pageUrl,
            'typePath' => $this->pageUrl,
            'page_title' => 'Admin | Manage ' . ucwords($this->pageUrl),
        ];
        return view('admin.' . $this->pageUrl . '.index', $data);
    }

    public function create(Request $request)
    {
        $states = State::get();
        $data = [
            "page_title" => "Admin | Manage " . ucwords($this->pageUrl),
            'pagePath' => $this->pageUrl,
            'roles' => 'userType',
            'branch' => '',
            'typePath' => '',
            'states' => $states,
        ];
        return view('admin.' . $this->pageUrl . '.create', $data);
    }

    public function store(Request $request)
    {

        $input = $request->all();
        // dd($input);
        $request->validate(
            [
                'name' => 'required',
                'title' => 'required',
                'description' => 'required',
                'election_type' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'state' => 'required',
                'party' => 'required',
                'pro_Tem' => 'required',
            ]
        );
        try {

            $user = new $this->Models;
            $user->name = $input['name'];
            $user->title = $input['title'];
            $user->description = $input['description'];
            $user->election_type = $input['election_type'];
            $user->state = $input['state'];
            $user->party = $input['party'];
            $user->pro_Tem = $input['pro_Tem'];

            $image = $request->image;

            if ($image != '') {
                $fileName = uniqid() . '.' . $image;
                $filePath = 'candidate_images/' . $fileName;
                $image->move(public_path('candidate_images/'), $filePath);
                $mediaName = 'candidate_images/' . $filePath;
                $user->image = $mediaName;

            }
            $user->save();


            $request->session()->flash('success', trans("Record added successfully"));
            return redirectRoute($this->pageUrl . '.index', ['type' => $request->type]);
        } catch (ModelNotFoundException $e) {
            $message = trans("Record upload failed");
            $request->session()->flash('error', $message);
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $id = decrypt($id);
        $datas = Candidate::where('id', $id)->first();
        $states = State::get();
        $data = [
            'page_title' => 'Admin | Update  ' . ucwords($this->pageUrl),
            'sdata' => $datas,
            'states' => $states,
            'pagePath' => $this->pageUrl,
            'typePath' => $request->type,
        ];
        return view('admin.' . $this->pageUrl . '.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $id = decrypt($id);
        $user = Candidate::where('id', $id)->first();
        $input = $request->all();
        $request->validate([
            'name' => 'required',
                'title' => 'required',
                'description' => 'required',
                'election_type' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'state' => 'required',
                'party' => 'required',
                'pro_Tem' => 'required',
        ]);
        try {
            $user->name = $input['name'];
            $user->title = $input['title'];
            $user->description = $input['description'];
            $user->election_type = $input['election_type'];
            $user->state = $input['state'];
            $user->party = $input['party'];
            $user->pro_Tem = $input['pro_Tem'];

            $image = $request->image;

            if ($image != '') {
                $fileName = uniqid() . '.' . $image;
                $filePath = 'candidate_images/' . $fileName;
                $image->move(public_path('candidate_images/'), $filePath);
                $mediaName = 'candidate_images/' . $filePath;
                $user->image = $mediaName;

            }
            $user->save();
            $request->session()->flash('success', trans("Record update success"));
            return redirectRoute($this->pageUrl . '.index', ['type' => $request->type]);
        } catch (ModelNotFoundException $e) {
            $message = trans("ecord update failed");
            $request->session()->flash('error', $message);
            return redirect()->back();
        }
    }

    public function show(Request $request, $id)
    {
        $id = decrypt($id);
        $datas = Candidate::where('id', $id)->first();
        $idString = json_decode($datas->category_id);
        $idArray = explode(',', $idString);
        $idArray = array_map('intval', $idArray);
        foreach ($idArray as $key => $value) {
            $categoryData = Category::find($value);
        }
        $data = [
            'page_title' => 'Admin | View  ' . ucwords($this->pageUrl),
            'sdata' => $datas,
            'categoryData' => $categoryData,
            'pagePath' => $this->pageUrl,
            'langPath' => $request->type,
        ];
        return view('admin.' . $this->pageUrl . '.view', $data);
    }

    public function destroy(Request $request, $id)
    {
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

    public function updateStatus(Request $request)
    {
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

    
}
