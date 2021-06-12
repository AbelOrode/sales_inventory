<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class StaffController extends Controller
{

    public function index()
    {
       $staff = Staff::all();
       return response()->json($staff);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
        ]);

        if($request->image){ //If a photo exists
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $extension = explode('/', $sub)[1];
            $name = time().".".$extension;
            $image = Image::make($request->image)->resize(240, 200);
            $upload_path = 'images/staff/';
            $image_url = $upload_path.$name;
            $image->save($image_url);

            $staff = new Staff;
            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->contact = $request->contact;
            $staff->salary = $request->salary;
            $staff->address = $request->address;
            $staff->image = $image_url;
            $staff->nid = $request->nid;
            $staff->join_date = $request->join_date;

            $staff->save();

        }else{
            $staff = new Staff;
            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->contact = $request->contact;
            $staff->salary = $request->salary;
            $staff->address = $request->address;
            $staff->nid = $request->nid;
            $staff->join_date = $request->join_date;

            $staff->save();
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
