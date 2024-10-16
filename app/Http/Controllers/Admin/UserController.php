<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ClientExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Str;

class UserController extends Controller
{
    // protected $redirectTo = '/';
    public $pageUrl = "user";
    public $delete = "user.delete";
    public $Models, $sortable_columns;
    public $pageTitle = 'Admin | Manage';

    public function __construct()
    {
        $this->Models = new User();

        $this->sortable_columns = [
            0 => 'id',
            1 => 'full_name',
            2 => 'email',
            3 => 'created_at',
            4 => 'status',
        ];
    }

    public function index(Request $request)
    {
        //checkRolePermission($this->pageUrl . '-list');
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

            $totaldata = $this->Models->getModel($limit, $start, $search, $sortable_columns[$orderby], $order, $type, $input)->where('role_id',2)->count();
            $response = $this->Models->getModel($limit, $start, $search, $sortable_columns[$orderby], $order, $type, $input)
            ->where('role_id',2)    
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
                $u['name'] = ucfirst($value->user_name) ?? '-' ;
                $u['email'] = $value->email;
                if ($value->mobile_number) {
                    $u['mobile'] =  $value->mobile_number;
                } else {
                    $u['mobile'] = '';
                }
                $u['status'] = createStatus($value->status, $value->id, ['1' => 'Active', '0' => 'Inactive'], 'changeStatus', $this->pageUrl . '.status')->toHtml();
                $u['actions'] = '<div class="btn-group" role="group" aria-label="User Actions">';
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
        $data = [
            "page_title" => "Admin | Manage " . ucwords($this->pageUrl),
            'pagePath' => $this->pageUrl,
            'roles' => 'userType',
            'branch' => '',
            'typePath' => '',
        ];
        return view('admin.' . $this->pageUrl . '.create', $data);
    }

    public function store(Request $request)
    {

        $input = $request->all();
        // dd($input);
        $request->validate(
            [
                'user_name' => 'requiredunique:users|user_name',
                'first_name' => 'required',
                'last_name' => 'required',
                'mobile_number' => 'required',
                'album_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:8|max:25|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                
            ],
            [
                'password' => 'Please fill password!',
                'email' => 'Please fill email!',
                'email.unique' => 'This email is already been taken!',
            ]
        );
        try {

            $user = new $this->Models;
            $user->user_name = $input['user_name'];
            $user->first_name = $input['first_name'];
            $user->last_name = $input['last_name'];
            $user->email = $input['email'];
            $user->role_id = 2;
            $user->password = Hash::make($input['password']);
            $user->mobile_number = $input['mobile_number'];
            $user->email_verification_code = "123456";

            $image = $request->album_profile;

            if ($image != '') {
                $fileName = uniqid() . '.' . $image;
                $filePath = 'profile_images/' . $fileName;
                $image->move(public_path('profile_images/'), $filePath);
                $mediaName = 'profile_images/' . $filePath;
                $user->profile_image = $mediaName;

            }

            $user->save();

            // Mail::send('admin.emails.verifyUser', array(
            //     'full_name' => $input['full_name'],
            //     'email' => $input['email'],
            //     'email_verified_at' => $user->email_verified_at,

            // ), function ($message) use ($request) {
            //     $message->from('luvsh6669@gmail.com', 'beHere Admin');
            //     $message->to($request->email)->subject('Welcome to the Behere');
            // });

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
        $datas = User::where('id', $id)->first();
        //$countries = Country::get();
        $data = [
            'page_title' => 'Admin | Update  ' . ucwords($this->pageUrl),
            'sdata' => $datas,
            'pagePath' => $this->pageUrl,
            'typePath' => $request->type,
        ];
        return view('admin.' . $this->pageUrl . '.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $id = decrypt($id);
        $data = User::where('id', $id)->first();
        $input = $request->all();
        $request->validate([
            'full_name' => 'required',
            // 'mobile_number' => 'numeric|digits_between:8,12',
            'email' => 'required|email|unique:users,email,' . $data->id,
        ],
            [
                'full_name.required' => 'Please fill user name!',
                'email' => 'Please fill email!',
                'email.unique' => 'This email is already been taken!',
                'mobile_number.required' => 'Please fill mobile number!',
            ]);
        try {
            $data->full_name = $input['full_name'];
            $data->email = $input['email'];
            $data->mobile_number = $input['mobile_number'];
            if ($request->hasfile('album_profile')) {
                $destination = 'public/' . $data->profile_image;
                if (File::Exists($destination)) {
                    File::delete($destination);
                }
                $image = $request->album_profile;
                $png_url = "be_file-" . rand() . '.' . $image->extension();
                $image->move(public_path('admin_assets/uploads/user/'), $png_url);
                $mediaName = 'admin_assets/uploads/user/' . $png_url;
                $data->profile_image = $mediaName;
            }
            $data->save();
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
        $datas = User::where('id', $id)->first();
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

    // public function shoow(Request $request)
    // {
    //     return $request->user()->hasVerifiedEmail()
    //     ? redirect($this->redirectPath())
    //     : view('verification.notice', [
    //         'pageTitle' => __('Account Verification'),
    //     ]);
    // }

    // public function register(RegisterRequest $request)
    // {
    //     $user = User::create($request->validated());

    //     event(new Registered($user));

    //     auth()->login($user);

    //     return redirect('/')->with('success', "Account successfully registered.");
    // }

    public function verifyUser($email_verified_at)
    {
        $verifyUser = User::where('email_verified_at', $email_verified_at)->first();
        if (isset($verifyUser)) {
            $verifycheck = ($verifyUser->is_email_verified);
            if ($verifycheck == null) {
                $verifyUser->is_email_verified = 1;
                $verifyUser->save();
                $status = "Your e-mail is verified. You can now login.";
            } else {
                $status = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return redirect('/admin-login')->with('errMsg', "Sorry your email cannot be identified.");
        }

        return redirect('/admin-login')->with('success', $status);
    }

    public function newexport() 
{
    return Excel::download(new ClientExport, 'Client.xlsx');
}
}
