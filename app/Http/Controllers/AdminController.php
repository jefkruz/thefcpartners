<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\Client;
use App\Models\Commission;
use App\Models\CommissionDisbursement;
use App\Models\Post;
use App\Models\Property;
use App\Models\Receipt;
use App\Models\Team;
use App\Models\User;
use App\Models\WalletSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $data['i'] = 1;

    }

    public function index()
    {
        $data['page_title'] = 'Admin Dashboard';
        $data['users'] = User::whereRole('user')->get();
        $data['posts'] = Post::all();
        $data['commissions'] =Commission::all();
        $data['properties']= Property::all();
        $data['receipts'] =Receipt::all();
        $month = date('m');
        $data['birthdays'] = User::where('b_month',$month)->get();
        return view('admin.dashboard',$data);
    }


    public function receipts()
    {

        $data['i'] = 1;
        $data['receipts'] =  Receipt::all();
        $data['page_title']= 'Transactions';
        $data['pending'] =  Receipt::where('status','PENDING')->get();
        $data['confirmed'] =  Receipt::where('status','APPROVED')->get();
        return view('admin.receipt.index', $data);
    }
    public function showreceipts($id)
    {
        $receipt = Receipt::findOrFail($id);

        return view('admin.receipt.show', compact('receipt'));
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'code' => 'required'
        ]);


        $receipt = Receipt::whereIdAndStatus($request->id, 'PENDING')->firstOrFail();

        if($receipt->code != $request->code){
            $notification = array(
                'message' => 'Incorrect code',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        if($receipt->expiry <= time()){
            $notification = array(
                'message' => 'Code is expired. Try again',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $receipt->status = 'APPROVED';
        $receipt->code = null;
        $receipt->expiry = null;
        $receipt->update();

        $setting = WalletSetting::first();
        $realtor = User::findOrFail($receipt->user_id);

        $p1 = new Commission();
        $p1->user_id = $realtor->id;
        $p1->receipt_id = $receipt->id;
        $p1->downline = $realtor->referral_id;
        $p1->percentage = $setting->first_interest;
        $p1->product_amount = $receipt->amount;
        $p1->interest_amount = floor(($setting->first_interest / 100) * $receipt->amount);
        $p1->save();

        $first = [
            'name' => $realtor->firstname . ' ' . $realtor->lastname,
            'email' => $realtor->email,
            'estate' => $receipt->estate_name,
            'client' => $receipt->client_name,
            'amount' => $receipt->amount,
            'percentage' => $p1->percentage,
            'commission' => $p1->interest_amount,
        ];

        $this->sendDisbursementMail($first);

        $nextRealtor = User::find($realtor->referral_id);
        if($nextRealtor){
            $p2 = new Commission();
            $p2->user_id = $nextRealtor->id;
            $p2->receipt_id = $receipt->id;
            $p2->downline = $nextRealtor->referral_id;
            $p2->percentage = $setting->second_interest;
            $p2->product_amount = $receipt->amount;
            $p2->interest_amount = floor(($setting->second_interest / 100) * $receipt->amount);
            $p2->save();

            $second = [
                'name' => $nextRealtor->firstname . ' ' . $nextRealtor->lastname,
                'email' => $nextRealtor->email,
                'estate' => $receipt->estate_name,
                'client' => $receipt->client_name,
                'amount' => $receipt->amount,
                'percentage' => $p2->percentage,
                'commission' => $p2->interest_amount,
            ];

            $this->sendDisbursementMail($second);


            $finalRealtor = User::find($nextRealtor->referral_id);
            if($finalRealtor){
                $p3 = new Commission();
                $p3->user_id = $finalRealtor->id;
                $p3->receipt_id = $receipt->id;
                $p3->downline = $finalRealtor->referral_id;
                $p3->percentage = $setting->third_interest;
                $p3->product_amount = $receipt->amount;
                $p3->interest_amount = floor(($setting->third_interest / 100) * $receipt->amount);
                $p3->save();

                $third = [
                    'name' => $finalRealtor->firstname . ' ' . $finalRealtor->lastname,
                    'email' => $finalRealtor->email,
                    'estate' => $receipt->estate_name,
                    'client' => $receipt->client_name,
                    'amount' => $receipt->amount,
                    'percentage' => $p3->percentage,
                    'commission' => $p3->interest_amount,
                ];

                $this->sendDisbursementMail($third);
            }

        }



        $notification = array(
            'message' => 'Transaction Confirmed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with( $notification);
    }

    private function sendDisbursementMail(array $realtor)
    {
        $mail = new CommissionDisbursement();
        $mail->name = $realtor['name'];
        $mail->email = $realtor['email'];
        $mail->client = $realtor['client'];
        $mail->estate = $realtor['estate'];
        $mail->amount = $realtor['amount'];
        $mail->percentage = $realtor['percentage'];
        $mail->commission = $realtor['commission'];
        $mail->save();
    }

    public function paid($id)
    {
        $paid = Commission::find($id);

        $paid->status = 'PAID';
        $paid->update();
        $notification = array(
            'message' => 'Commission Payment Confirmed',
            'alert-type' => 'success'
        );

        return redirect()->back()->with( $notification);
    }
    public function birthdays()
    {
        $data['page_title'] = 'Birthdays';
        $data['i'] = 1;
        $month = date('m');
        $data['users'] = User::where('b_month',$month)->get();
        return view('admin.birthdays',$data);
    }

    public function settings()
    {
        $data['page_title'] = 'Settings';
        $data['setting'] = WalletSetting::first();


        return view('admin.settings',$data);
    }

    public function updateWalletSetting(Request $request)
    {
        $request->validate([
            'first_interest' => 'required',
            'second_interest' => 'required',
            'third_interest' => 'required',
            'minimum_payout' => 'required'
        ]);

        $setting = WalletSetting::first();
        $setting->first_interest = $request->first_interest;
        $setting->second_interest = $request->second_interest;
        $setting->third_interest = $request->third_interest;
        $setting->minimum_payout = $request->minimum_payout;
        $setting->save();
        return back()->with('success', 'Wallet settings updated');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = User::find(Session::get('admin')->id);
        $verified = password_verify($request->current_password, $user->password);
        if(!$verified){
            return back()->with('error', 'Incorrect password');
        }
        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('success', 'Password updated');
    }


}
