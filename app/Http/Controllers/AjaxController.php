<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    public function getBanks()
    {
        $selectedBank = Session::get('user')->bank_code;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.flutterwave.com/v3/banks/NG',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . env('FLW_SECRET_KEY')
            ),
        ));

        $response = curl_exec($curl);

        $payload = [];

        curl_close($curl);
        $resp = json_decode($response, true);

        if($resp['status'] == 'success'){
            $payload = $resp['data'];
        }

        return response(['status' => true, 'data' => [
            'banks' => $this->sortBanksAscending($payload),
            'selected' => $selectedBank
        ]], 200);
    }

    public function getBankAccount(Request $request)
    {
        $request->validate([
            'bank' => 'required',
            'account_number' => 'required'
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.flutterwave.com/v3/accounts/resolve',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
              "account_number": "' . $request->account_number . '",
              "account_bank": "' . $request->bank . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . env('FLW_SECRET_KEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resp = json_decode($response, true);
        if(array_key_exists('status', $resp) && $resp['status'] == 'success'){

            if(
                array_key_exists('account_number', $resp['data'])
                && array_key_exists('account_name', $resp['data'])
                && $resp['data']['account_number'] == $request->account_number
            ){
                return response(['status' => true, 'data' => $resp['data']['account_name']], 200);
            }

        }

        return response(['status' => false, 'message' => 'Unable to find account'], 400);
    }

    private function sortBanksAscending($banks)
    {
        $arr = [];
        $new_payload = [];
        foreach($banks as $bank){
            array_push($arr, $bank['name']);
        }
        sort($arr);
        foreach($arr as $item){
            foreach($banks as $b){
                if($b['name'] == $item){
                    array_push($new_payload, $b);
                    break;
                }
            }
        }

        return $new_payload;
    }

    public function setReceiptCode(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $receipt = Receipt::whereIdAndStatus($request->id, 'PENDING')->firstOrFail();

        $str = '1234567890';
        $code = substr(str_shuffle($str), 2, 6);

        $receipt->code = $code;
        $receipt->expiry = time() + 300;
        $receipt->save();

        EmailController::sendVerificationMail($receipt->code);

        return response(['status' => true], 200);
    }
}
