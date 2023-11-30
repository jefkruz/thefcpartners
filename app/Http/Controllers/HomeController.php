<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\Commission;
use App\Models\Country;
use App\Models\Payout;
use App\Models\Post;
use App\Models\Property;
use App\Models\Receipt;
use App\Models\Team;
use App\Models\User;
use App\Models\WalletSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['users'] = User::all();
        $this->data['posts'] = Post::all();

        $this->data['properties']= Property::all();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Session::get('user');

        $data['username'] = $user->username;
        $id = $user->id;
        $data['i'] = 1;
        $data['page_title']= 'Dashboard';
        $data['tops'] = User::take(5)->get();
        $data['posts'] = Post::take(5)->get();
        $data['commission'] = Commission::where('user_id',$id)->get();
        $data['payouts'] = Payout::where('user_id',$id)->get();
//        $data['sum']  =   Receipt::groupBy('user_id')->orderByRaw('SUM(amount) DESC')->take(5)->get();
        $data['sum']  =   [];
        $data['upline'] = User::find($user->referral_id);
        $data['referrals'] = User::where('referral_id',$id)->get()->take(5);
        $data['receipts'] = Receipt::where('user_id',$id)->get()->take(5);
        $data['pending'] =  Receipt::where('user_id',$id)->where('status','PENDING')->get();
        $data['confirmed'] =  Receipt::where('user_id',$id)->where('status','APPROVED')->get();
        return view('pages.main.home',$data);
    }

    public function profile()
    {
        $user = Session::get('user');
        $data['user'] = $user;
        $data['countries'] = [];// Country::all();
        $referer = $user->referral_id;
        $data['page_title']= 'Profile';
        $data['upline'] = User::where('id',$referer)->first();
        return view('pages.main.profile',$data);
    }
    public function referrals()
    {
        $user = Session::get('user');

        $id = $user->id;

        $data['page_title'] = 'Referrals';
        $data['referrals'] = User::where('referral_id',$id)->get();
        return view('pages.main.referrals',$data);
    }

    public function listProperties()
    {

        $data['properties']= Property::all();
        $data['page_title']= 'Properties';
        return view('pages.main.properties',$data);
    }

    public function viewProperties($id)
    {
        $data['property']= Property::where('id',$id)->first();
        $data['page_title']= $data['property']['name'];
        return view('pages.main.view_properties',$data);
    }
    public function viewreferral($username)
    {
        $data['page_title'] = 'Referrals';
        $referral = User::where('username',$username)->first();
        $data['referral'] = User::where('username',$username)->first();
        $data['i'] = 1;
        $user =$referral->id;
        $data['downlines'] = User::where('referral_id',$user)->get();

        return view('pages.main.view_referrals',$data);
    }


    public function updateprofile(Request $request)
    {

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'b_date' => 'required',
            'b_month' => 'required',
            'gender' => 'required',

        ]);

        $id = Session::get('user')->id;
        $user = User::where('id',$id)->first();


        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->phone = $request->input('phone');
        $user->b_date = $request->input('b_date');
        $user->b_month = $request->input('b_month');
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->update();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with( $notification);

    }

    public function updateBank(Request $request)
    {
        $request->validate([
            'bank' => 'required',
            'bank_code' => 'required',
            'acc_number' => 'required',
            'acc_name' => 'required'
        ]);

        $user = User::find(Session::get('user')->id);
        $user->bank = $request->bank;
        $user->bank_code = $request->bank_code;
        $user->acc_name = $request->acc_name;
        $user->acc_number = $request->acc_number;
        $user->save();

        session()->put('user', $user);

        $notification = array(
            'message' => 'Bank Updated Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }



    public function commission()
    {
        $user = Session::get('user');
        $data['commissions'] = Commission::where('user_id',$user->id)->get();
        $data['payouts'] = Payout::where('user_id',$user->id)->get();
        $data['setting'] = WalletSetting::first();
        return view('pages.main.commission.index', $data);
    }

    public function updateimage(Request $request)
    {
        $request->validate([
            'avatar' => 'required'
        ]);

        $user = User::find(Session::get('user')->id);

        $image = $request->avatar;
        $arr1 = explode(";", $image);
        $arr2 = explode(",", $arr1[1]);
        $data = base64_decode($arr2[1]);

        $filename = $user->firstname . '-' . $user->lastname . '-' . time() . '.png';

        Storage::disk(env('DEFAULT_DISK'))->put(
            'user_profile/' . $filename,
            $data
        );

        $user->avatar = $filename;
        $user->update();

        session()->put('user', $user);

        $notification = array(
            'message' => 'Image Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }

    public function viewpost($slug)
    {
        $data['post'] = Post::where('slug', $slug)->first();
        $data['page_title'] = 'Read';
        return view('pages.main.view_post',$data);
    }

}
