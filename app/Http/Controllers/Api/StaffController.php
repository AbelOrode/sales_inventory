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
        $staff = Staff::findOrFail($id);
        return response()->json($staff);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['contact'] = $request->contact;
        $data['salary'] = $request->salary;
        $data['address'] = $request->address;
        $data['nid'] = $request->nid;
        $data['join_date'] = $request->join_date;
        $image = $request->newImage;

        if($image){
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $extension = explode('/', $sub)[1];
            $name = time().".".$extension;
            $image = Image::make($request->image)->resize(240, 200); //Image intervention dependency
            $upload_path = 'images/staff/';
            $image_url = $upload_path.$name;
            $success = $image->save($image_url);
            if($success){
                $data['image'] = $image_url;
                $img = DB::table('staff')->where('id', $id)->first();
                $img_path = $img->image;
                $done = unlink($img_path);
                $user = DB::table('staff')->where('id', $id)->update($data); // Upload new image to the database if old image has been modified
            }else{
                $oldPhoto = $request->image;
                $data['image'] = $oldPhoto;
                $user = DB::table('staff')->where('id', $id)->update($data);
            }
        }
    }


    public function destroy($id)
    {
        $employee = Staff::findOrFail($id);
        $photo = $employee->image;

        if ($photo){
            unlink($photo);
            Staff::findOrFail($id)->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Record deleted successfully',
            ], 201);
        }else{
            Staff::findOrFail($id)->delete();
            return response()->json([
                'status' => 0,
                'message' => 'An error has occurred',
            ], 404);
        }
    }
}
