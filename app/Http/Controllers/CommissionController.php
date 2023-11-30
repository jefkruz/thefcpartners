<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Payout;
use App\Models\SuccessfulPayout;
use App\Models\WalletSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class CommissionController
 * @package App\Http\Controllers
 */
class CommissionController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['i'] = 1;
        $data['commissions'] = Commission::all();

        return view('admin.commission.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commission = new Commission();
        return view('pages.main.commission.create', compact('commission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commission = Commission::create($request->all());

        return redirect()->route('commissions.index')
            ->with('success', 'Commission created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commission = Commission::find($id);

        return view('pages.main.commission.show', compact('commission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commission = Commission::find($id);

        return view('commission.edit', compact('commission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Commission $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission $commission)
    {

        $commission->update($request->all());

        return redirect()->route('commissions.index')
            ->with('success', 'Commission updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $commission = Commission::find($id)->delete();
        $notification = array(
            'message' => 'Commission deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function withdrawFund(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);
        $user = Session::get('user');

        if($user->bank_code == null || $user->acc_number == null){
            $notification = array(
                'message' => 'Please update bank details',
                'alert-type' => 'error'
            );
            return to_route('profile')->with($notification);
        }

        $setting = WalletSetting::first();
        $minimum = $setting->minimum_payout;
        if($minimum > $request->amount){
            $notification = array(
                'message' => 'Please enter an amount greater than NGN' . $minimum,
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $payouts = Payout::where('user_id', $user->id)->get();
        $interests = Commission::where('user_id', $user->id)->get();
        $accrued = $interests->sum('interest_amount');
        $withdrawn = $payouts->sum('amount');

        $balance = $accrued - $withdrawn;
        if($request->amount > $balance){
            $notification = array(
                'message' => 'Account limit exceeded',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.flutterwave.com/v3/transfers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "account_bank": "'. $user->bank_code .'",
                "account_number": "'. $user->acc_number .'",
                "amount": '. $request->amount .',
                "narration": "Withdrawal",
                "currency": "NGN"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . env('FLW_SECRET_KEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resp = json_decode($response, true);


        if($resp['status'] != 'success'){
            $notification = array(
                'message' => 'Please check account balance',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $p = new Payout();
        $p->user_id = $user->id;
        $p->currency = 'NGN';
        $p->amount = $request->amount;
        $p->fee = $resp['data']['fee'];
        $p->reference = $resp['data']['reference'];
        $p->bank_name = $resp['data']['bank_name'];
        $p->bank_code = $resp['data']['bank_code'];
        $p->account_number = $resp['data']['account_number'];
        $p->narration = $resp['data']['narration'];
        $p->save();

        $mail = new SuccessfulPayout();
        $mail->name = $user->firstname . ' ' . $user->lastname;
        $mail->email = $user->email;
        $mail->amount = $p->amount;
        $mail->bank = $p->bank_name;
        $mail->account_name = $user->acc_name;
        $mail->account_number = $p->account_number;
        $mail->reference = $p->reference;
        $mail->save();

        $notification = array(
            'message' => $resp['message'],
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
