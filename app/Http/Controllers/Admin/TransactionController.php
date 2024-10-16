<?php

namespace App\Http\Controllers\Admin;

use App\Models\Business;
use App\Models\Plan;
use App\Models\PlanSubscription;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Auth;
use Valid;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Storage;
use Illuminate\Support\Str;
use DB;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Subscription;

class TransactionController extends Controller
{
    public $pageUrl = "transaction";
    public $langPath = "transaction";
    public $delete = "transaction.delete";

    public function __construct() {
        $this->Models = new Transaction();
        $this->sortable_columns = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'title',
            4 => 'price',
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
            $totaldata = $this->Models->getModel($limit, $start, $search, $this->sortable_columns[$orderby], $order)->whereStatus(1)->count();
            $response = $this->Models->getModel($limit, $start, $search, $this->sortable_columns[$orderby], $order)->whereStatus(1)    
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
                    $u['name'] = Str::words(ucfirst($value->getBusiness->name ?? ""), 40);
                    $u['email'] = Str::words(ucfirst($value->getBusiness->email ?? ""), 40);
                    $u['title'] = Str::words(ucfirst($value->getPlan->title ?? ""), 40);
                    $u['price'] = Str::words(ucfirst('$'.$value->getPlan->price ?? ""), 40);
                    if($value->status == 1){
                        $u['status'] = 'Active' ;
                    } else {
                        $u['status'] = 'Pending' ;
                    }
                    $u['actions'] = '<div class="btn-group" role="group" aria-label="User Actions">';
                    // $u['actions'] .= '<a href="'.route('admin.'.$this->pageUrl.'.edit',[encrypt($value->id)]).'" class="btn btn-info btn-sm " data-toggle="tooltip" title="Edit" style="float:right;"> <i class="fas fa-edit"></i></a>';
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
        return view('admin.' . $this->pageUrl . '.index', $data );
    }

    public function create(Request $request) {
        $business = Business::select('businesses.id','businesses.name')->whereStatus(3)->leftjoin('business_categories', 'businesses.id', 'business_categories.user_id')->get();
        $datas = $this->Models::all();
        $data = [
            "page_title" => "Admin | Manage " . ucwords(trans('admin_lang.' . $this->langPath)),
            "langPath" => $this->langPath,
            'pagePath' => $this->pageUrl,
            'pageLang' => $this->pageUrl,
            'pageName' => $this->pageUrl,
            'sdata'    => $datas, 
            'business' => $business,
        ];
        return view('admin.' . $this->pageUrl . '.create', $data);
    }

    public function store(Request $request) {
        $user = Business::where('id', $request->id)->first();

        $basic = 'price_1ODkgRSJnwLVModyBy1HAcr4';
        $enhanced = 'price_1OAQB0SJnwLVModyaU4VUsis';
        $premium = 'price_1OAQCESJnwLVModyhFF13U4w';
        $trail = [];
        \Stripe\Stripe::setApiKey("sk_test_51OAAsWSJnwLVModyjwSh4e8wC3Ggo2rLsltkv1ASHPQuok5mrh43m1p0b6G4apsVC4K5TdqVu9ZOAV4g5M6cpopa004myGyMMF");
        // \Stripe\Stripe::setApiKey(base9_decode(config('app.STRIPE_SECRET_VALUE'), config('app.STRIPE_SECRET_SALT')));
        if (empty($user->stripe_id) && $user->stripe_id == "") {
            $options = [
                "email" => $user->email,
                "name" => $user->name,
            ];
            // dd($user->createAsStripeCustomer($options));
            $stripeCustomer = $user->createAsStripeCustomer($options);

            $customer_stripe_id = $stripeCustomer->id;
            Business::where('id', $user->id)->update(['stripe_id' => $customer_stripe_id]);
        } else {
            $customer_stripe_id = $user->stripe_id;
        }
        if ($request->plan == 'basic') {
            $pln = Plan::where('title','basic')->first();
            $tran = new Transaction();
            $tran->user_id = $user->id;
            $tran->plan_id = $pln->id;
            $tran->amount = 100;
            $tran->transaction_time = date('Y-m-d h:i:s');
            $tran->status = 0;
            $tran->save();

            Business::where('id', $request->id)->update([
                'status' => '0',
            ]);
            Session::flash('success', 'Successfully list on behere');
            return redirectRoute($this->pageUrl . '.index');


            // $session = \Stripe\Checkout\Session::create([
            //     "line_items" => [
            //         [
            //             "price" => $basic,
            //             "quantity" => 1,
            //         ],
            //     ],
            //     //'automatic_tax' => ['enabled' => true],
            //     "customer" => $customer_stripe_id,
            //     "mode" => "payment",
            //     "success_url" => route('admin.subcriptionSuccess', ['payment' => 'success']),
            //     "cancel_url" => route('admin.subcriptionCancel', ['payment' => 'cancel']),
            //     "subscription_data" => $trail,
            // ]);
        } else if ($request->plan == 'enhanced') {
            $pln = Plan::where('title','enhanced')->first();
            $tran = new Transaction();
            $tran->user_id = $user->id;
            $tran->plan_id = $pln->id;
            $tran->amount = 50;
            $tran->transaction_time = date('Y-m-d h:i:s');
            $tran->status = 0;
            $tran->save();

            $session = \Stripe\Checkout\Session::create([
                "line_items" => [
                    [
                        "price" => $enhanced,
                        "quantity" => 1,
                    ],
                ],
                //'automatic_tax' => ['enabled' => true],
                "customer" => $customer_stripe_id,
                "mode" => "subscription",
                "success_url" => route('admin.subcriptionSuccess', ['payment' => 'success']),
                "cancel_url" => route('admin.subcriptionCancel', ['payment' => 'cancel']),
                "subscription_data" => $trail,
            ]);
        } else if ($request->plan == 'premium') {
            $pln = Plan::where('title','premium')->first();
            $tran = new Transaction();
            $tran->user_id = $user->id;
            $tran->plan_id = $pln->id;
            $tran->amount = 70;
            $tran->transaction_time = date('Y-m-d h:i:s');
            $tran->status = 0;
            // $tran->transaction_time = date('Y-m-d h:i:s');
            $tran->save();

            $session = \Stripe\Checkout\Session::create([
                "line_items" => [
                    [
                        "price" => $premium,
                        "quantity" => 1,
                    ],
                ],
                //'automatic_tax' => ['enabled' => true],
                "customer" => $customer_stripe_id,
                "mode" => "subscription",
                "success_url" => route('admin.subcriptionSuccess', ['payment' => 'success']),
                "cancel_url" => route('admin.subcriptionCancel', ['payment' => 'cancel']),
                "subscription_data" => $trail,
            ]);
        }

        // $pln = Plan::where('plan_id', $plan)->first();

        if (isset($session->url) && $session->url != "") {
            Business::where('id', $request->id)->update([
                'status' => '0',
            ]);
            return redirect($session->url);

        } else {
            return redirect()->back();
        }
    }

    public function edit($id) {
        $id = decrypt($id);
        $business = Business::select('businesses.id','businesses.name')->get();
        $datas = $this->Models::where('id', $id)->first();
        $data = [
            'page_title' => 'Admin | Update  ' . ucwords(trans('admin_lang.' . $this->langPath)),
            'business' => $business,
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

        Stripe::setApiKey("sk_test_51OAAsWSJnwLVModyjwSh4e8wC3Ggo2rLsltkv1ASHPQuok5mrh43m1p0b6G4apsVC4K5TdqVu9ZOAV4g5M6cpopa004myGyMMF");
       
        $invoice = \Stripe\Invoice::all(array("subscription" => $data->subscription_id));
        foreach ($invoice as $key => $value) {
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET', null));
                $stripe = $stripe->invoices->retrieve(
                $value->id,
                []
              );
              return redirect()->to($stripe->invoice_pdf);
        }
        $plan = Plan::where('title',$request->plan)->first(); 
        if ($plan) {
            DB::beginTransaction();
            try {
                if ($plan->type == 'basic') {
                    $enddate = '';
                } else {
                    $enddate = date('Y-m-d', strtotime("+1 month -1 day"));
                }

                $user = Business::where('id',$data->user_id)->first();
                Stripe::setApiKey("sk_test_51OAAsWSJnwLVModyjwSh4e8wC3Ggo2rLsltkv1ASHPQuok5mrh43m1p0b6G4apsVC4K5TdqVu9ZOAV4g5M6cpopa004myGyMMF");
			

                $subscriptions = Subscription::all([
                    'customer' => $user->stripe_id,
                ]);
			$subscription = \Stripe\Subscription::retrieve($data->subscription_id);

                    $customer = \Stripe\Customer::retrieve(
                        $user->stripe_id,
                        ['expand' => ['subscriptions']]
                    );

          $user->subscription('main')->swap('provider-plan-id');
          $subscription->update(
				$subscription->id,
				[
					'items' => [
						[
							'id' => $subscription->items->data[0]->id,
							'deleted' => true,
						],
						['price' => $plan->payment_id],
					],
					'proration_behavior' => 'create_prorations',
				]
			);
// $sub = \Stripe\Subscription::update($subscription, [
//     'cancel_at_period_end' => false,
//     'proration_behavior' => 'create_prorations',
//     'items' => [
//       [
//         'id' => $subscription->items->data[0]->id,
//         'price' => $plan->payment_id, // the new Price to update to
//       ],
//     ],
//   ]);


                // $sub = \Stripe\Subscription::update($subscription, [
                //     'cancel_at_period_end' => false,
                //     'proration_behavior' => 'create_prorations',
                //     'items' => [
                //       [
                //         'id' => $subscription->items->data[0]->id,
                //         'price' => $plan->payment_id, // the new Price to update to
                //       ],
                //     ],
                //   ]);

                //   $response = $stripe->subscriptions->cancel(
                //     $subscription,
                //     ['prorate' => 'true']
                // );

                $sub = PlanSubscription::firstOrCreate(['user_id' => $data->user_id]);
                $sub->plan_id = $plan->id;
                $sub->subscription_id = $subscriptions->id;
                $sub->price = $plan->price;
                $sub->start_date = date('Y-m-d');
                $sub->end_date = $enddate;
                $sub->status = 0;
                $sub->save();


                DB::commit();
                Session::flash('success', 'Subscription update successfully');
                return redirectRoute($this->pageUrl . '.index');
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }

        } else {
            DB::rollback();
            return redirect()->back();
        }   
    }


    public function subcriptionSuccess()
    {
        Session::flash('success', 'Payment successfully');
        return redirectRoute($this->pageUrl . '.index');
    }

    public function subcriptionCancel(Request $request)
    {
        $request->validate([
            'reason' => 'required',
            'subscription_id' => 'required',
            'reason_detail' => 'required',
        ], ['reason_detail.required' => 'The reason detail field is required.']);

        $user = \Auth::user();
        $sub = PlanSubscription::find($request->subscription_id);
        if ($sub) {
            $stripe = new \Stripe\StripeClient("sk_test_51OAAsWSJnwLVModyjwSh4e8wC3Ggo2rLsltkv1ASHPQuok5mrh43m1p0b6G4apsVC4K5TdqVu9ZOAV4g5M6cpopa004myGyMMF");
            $stripe->subscriptions->cancel($sub->subscription_id, []);

            $sub->reason = $request->reason;
            $sub->reason_detail = $request->reason_detail;
            $sub->status = 0;
            $sub->subscription_id = "";
            $sub->delete();
        }
        // Business::whereIn('id', Business::select('id')->where('user_id', $user->id)->orderBy('id', 'asc')->skip(1)->take(10000)->pluck('id'))->delete();

        return response()->json(['status' => true, 'message' => 'Subscription canceled successfully!']);
    }

    public function destroy(Request $request, $id)
    {

        $id = decrypt($id);
        $data = $this->Models::where('id', $id)->first();

        $user = Business::where('id',$data->user_id)->first();
        $sub = PlanSubscription::where('user_id',$data->user_id)->first();
        if ($sub) {
            // $stripe = new \Stripe\StripeClient("sk_test_51OAAsWSJnwLVModyjwSh4e8wC3Ggo2rLsltkv1ASHPQuok5mrh43m1p0b6G4apsVC4K5TdqVu9ZOAV4g5M6cpopa004myGyMMF");
            Stripe::setApiKey("sk_test_51OAAsWSJnwLVModyjwSh4e8wC3Ggo2rLsltkv1ASHPQuok5mrh43m1p0b6G4apsVC4K5TdqVu9ZOAV4g5M6cpopa004myGyMMF");
            $stripe = \Stripe\Subscription::retrieve($data->subscription_id);
            $stripe->cancel();
            $sub->status = 0;
            $sub->delete();

            $tran = Transaction::where('user_id',$data->user_id)->whereStatus(1)->first();
            $tran->status = 0;
            $tran->save();
        }

        Session::flash('error', 'Subscription canceled successfullyy!');
        return redirectRoute($this->pageUrl . '.index');
    }
}
