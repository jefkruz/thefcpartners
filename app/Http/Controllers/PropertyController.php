<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class PropertyController
 * @package App\Http\Controllers
 */
class PropertyController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $data['properties']= Property::all();
        $data['i'] = 1;
        $data['page_title'] = 'Properties';
        return view('admin.property.index', $data);
    }

    public function profileshare($username)
    {
        if($username == 'admin'){
            return to_route('home');
        }
        $data['page_title']= 'Share profile';
        $data['properties'] = Property::all();
        $data['profile'] = User::whereUsername($username)->firstOrFail();
        $data['shareComponent'] = (new \Jorenvh\Share\Share)->page(
            route('profileshare', $username),
            'View My Profile ',
        )
            ->whatsapp()
            ->facebook()
            ->twitter()
            ->telegram();


        return view('pages.share_profile',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = new Property();
        return view('admin.property.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required',
            'form' => 'required|file|mimes:pdf|max:5120',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
        $property = $request->all();

        if ($banner = $request->file('banner')) {
            $postImage = time(). "." . $banner->getClientOriginalExtension();
            Storage::disk(env('DEFAULT_DISK'))->putFileAs('property_upload',
                $banner,
                $postImage
            );
            $property['banner'] = $postImage;
        }else{
            unset($property['banner']);

        }

        if ($form = $request->file('form')) {
            $formFile = time(). "." . $form->getClientOriginalExtension();
            Storage::disk(env('DEFAULT_DISK'))->putFileAs('form_upload',
                $form,
                $formFile
            );
            $property['form'] = $formFile;
        }else{
            unset($property['form']);

        }


        Property::create( $property);
        $notification = array(
            'message' => 'Property created successfully',
            'alert-type' => 'success'
        );

        return to_route('properties.index')
            ->with( $notification);
    }

    public function deleteImage($propertyID, $imageID)
    {
        $property = Property::findOrFail($propertyID);
        $image = PropertyImage::where('property_id', $property->id)->whereId($imageID)->firstOrFail();

        $image->delete();

        $notification = array(
            'message' => 'Image deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()
            ->with( $notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::findOrFail($id);

        return view('admin.property.show', compact('property'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::find($id);

        return view('admin.property.edit', compact('property'));
    }

    public function uploadImage($id, Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);
        $property = Property::findOrFail($id);

        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();

        Storage::disk(env('DEFAULT_DISK'))->putFileAs('property_upload',
            $file,
            $filename
        );

        $propImage = new PropertyImage();
        $propImage->property_id = $property->id;
        $propImage->image = $filename;
        $propImage->save();

        $notification = array(
            'message' => 'Image uploaded successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }


    public function subscribe($id)
    {
        $subscribe =  Property::findOrFail($id);
        return Storage::disk(env('DEFAULT_DISK'))->download('form_upload/' . $subscribe->form);
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required',
            'form' => 'file|mimes:pdf|max:5120',
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $input = $request->all();
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $postImage = time(). "." . $banner->getClientOriginalExtension();
            Storage::disk(env('DEFAULT_DISK'))->putFileAs('property_upload',
                $banner,
                $postImage
            );

            $input['banner'] = $postImage;
        }

        if ($request->hasFile('form')) {
            $form = $request->file('form');
            $formFile = time(). "." . $form->getClientOriginalExtension();
            Storage::disk(env('DEFAULT_DISK'))->putFileAs('form_upload',
                $form,
                $formFile
            );
            $input['form'] = $formFile;
        }


        $property->update($input);
        $notification = array(
            'message' => 'Property updated successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('properties.index')
            ->with( $notification);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $property = Property::find($id)->delete();
        $notification = array(
            'message' => 'Property deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('properties.index')
            ->with($notification);
    }
}
