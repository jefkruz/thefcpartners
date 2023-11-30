<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //

    public function index()
    {
        $data['page_title'] = 'Home';
        $data['properties']= Property::all();
        $data['acts']= Act::all();
        $data['teams']= Team::all();
        $data['posts'] = Post::all();
        $data['clients'] = Client::all();
        return view('pages.index',$data);
    }

    public function property()
    {
        $data['properties'] = Property::all();
        $data['page_title']= 'Properties';
        return view('pages.properties',$data);
    }
    public function posts()
    {
        $data['blogs'] = Post::all();
        $data['page_title']= 'Posts';
        return view('pages.main.posts',$data);
    }
    public function viewproperty($slug)
    {
        $data['property'] = Property::where('slug',$slug)->firstOrFail();
        $data['page_title']= 'Properties';
        return view('pages.view_properties',$data);
    }

    public function about()
    {
        $data['page_title']= 'About Us';
        $data['teams']= Team::all();
        $data['clients'] = Client::all();
        return view('pages.about',$data);
    }

    public function contact()
    {

        $data['page_title']= 'Contact Us';

        return view('pages.contact',$data);
    }

    public function messages(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'fullname' => 'required',
            'subject' => 'required',
            'note' => 'required',



        ]);

        $message = new Message();

        $message->fullname = $request->fullname;
        $message->email= $request->email;
        $message->subject = $request->subject;
        $message->note =$request->note;
        $message->save();

        $notification = array(
            'message' => 'We Have Received Your Message',
            'alert-type' => 'success'
        );

        return redirect()->back()->with( $notification);






    }

    public function profileshare($username)
    {
        $data['page_title']= 'Share profile';
        $data['properties'] = Property::all();
        $data['profile'] = User::where('username', $username)->firstOrFail();
        $data['shareComponent'] = (new \Jorenvh\Share\Share)->page(
            'https://thefcpartners.com/profile/share/'.$username,
            'View My Profile ',
        )
            ->whatsapp()
            ->facebook()
            ->twitter()
            ->telegram();


        return view('pages.share_profile',$data);
    }

}
