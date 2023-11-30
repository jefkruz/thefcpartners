<?php

namespace App\Http\Controllers;

use App\Mail\VerifyReceiptMail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public static function sendVerificationMail($code)
    {
        $s = Setting::first();
        $toEmail = $s->admin_email;
        Mail::to($toEmail)->send(new VerifyReceiptMail($code));
        return true;
    }
}
