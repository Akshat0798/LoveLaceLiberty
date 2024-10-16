<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanSubscription;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    public function showSubscribe()
    {
        return view('frontend.page.sub.index');
    }

    public function subscribe(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id',$id)->first();
        $user->is_subscribed = 1;
        $user->save();
        Session::flash('success', 'Payment successfully');
        return redirect()->route('client.dashboard.index');
    }

    

    public function subcriptionSuccess()
    {
        Session::flash('success', 'Payment successfully');
        return redirect()->route('business.dashboard.index');
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
        Business::whereIn('id', Business::select('id')->where('user_id', $user->id)->orderBy('id', 'asc')->skip(1)->take(10000)->pluck('id'))->delete();

        return response()->json(['status' => true, 'message' => 'Subscription canceled successfully!']);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $plan = Plan::where('title',$request->plan)->first();
        // dd($plan);
        if ($plan) {
            DB::beginTransaction();
            try {
                if ($plan->type == 'Monthly') {
                    $enddate = date('Y-m-d', strtotime("+1 month -1 day"));
                } else {
                    $enddate = date('Y-m-d', strtotime("+1 year -1 day"));
                }
                $user = \Auth::user();
                $subscriptions = $user->subscriptions()->active()->get(); // getting all the active subscriptions
                dd($subscriptions);
                $subscriptions->map(function ($subscription) {
                    $subscription->cancel(); // cancelling each of the active subscription
                });
                $subscription = $request->Business()->newSubscription($plan->id, $plan->gateway_plan_id)
                    ->create($request->token);

                if ($subscription->latest_invoice->payment_intent->status === 'requires_action') {
                    // 3D Secure authentication is required, redirect user to Stripe's authentication page
                    return redirect($subscription->latest_invoice->payment_intent->next_action->redirect_to_url->url);
                }

                $sub = PlanSubscription::firstOrCreate(['teacher_id' => \Auth::user()->id]);
                $sub->plan_id = $request->plan;
                $sub->subscription_id = $subscription->id;
                $sub->total_students = $plan->total_students;
                $sub->price = $plan->price;
                $sub->start_date = date('Y-m-d');
                $sub->end_date = $enddate;
                $sub->status = 0;
                $sub->save();

                Business::whereIn('id', Business::select('id')->where('teacher_id', $user->id)
                        ->orderBy('id', 'asc')->skip($plan->total_students)
                        ->take(10000)->pluck('id'))
                    ->delete();

                DB::commit();
                return response()->json(['status' => true, 'message' => 'Plan subscribed successfully.']);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }

        } else {
            DB::rollback();
            return redirect()->back();
        }
    }

    public function downloadInvoice(Request $request,$id)
    {
        $id = decrypt($id);
        $data = PlanSubscription::where('user_id',$id)->where('subscription_id','!=',null)->first();
        if($data){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET', null));
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
        } else {
            Session::flash('error', 'You need to first by the subscription');
            return redirect()->back();
        }
    }
}