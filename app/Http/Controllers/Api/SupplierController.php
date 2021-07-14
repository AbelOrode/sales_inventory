<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class SupplierController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:suppliers|max:255',
            'email' => 'required',
            'phone' => 'required|unique:suppliers'
        ]);
        if ($request->photo) { //If a photo exists
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $extension = explode('/', $sub)[1];
            $name = time() . "." . $extension;
            $image = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'images/supplier/';
            $image_url = $upload_path . $name;
            $image->save($image_url);

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->photo = $image_url;
            $supplier->save();

            return response()->json([
                'status' => 1,
                'Message' => 'Record created successfully'
            ], 201);

        } else {
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->save();

            return response()->json([
                'status' => 1,
                'Message' => 'Record created successfully'
            ], 201);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$supplier = DB::table('suppliers')->where('id', $id)->first();
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['contact'] = $request->contact;
        $data['phone'] = $request->salary;
        $data['shopname'] = $request->address;


        $image = $request->newPhoto;

        if($image){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $extension = explode('/', $sub)[1];
            $name = time().".".$extension;
            $image = Image::make($request->photo)->resize(240, 200); //Image intervention dependency
            $upload_path = 'images/supplier/';
            $image_url = $upload_path.$name;
            $success = $image->save($image_url);
            if($success){
                $data['photo'] = $image_url;
                $img = DB::table('suppliers')->where('id', $id)->first();
                $img_path = $img->image;
                $done = unlink($img_path);
                $user = DB::table('suppliers')->where('id', $id)->update($data); // Upload new image to the database if old image has been modified
            }else{
                $oldPhoto = $request->photo;
                $data['photo'] = $oldPhoto;
                $user = DB::table('suppliers')->where('id', $id)->update($data);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $photo = $supplier->photo;
        if($photo){
            unlink($photo);
            $supplier->delete();
        }else{
            $supplier->delete();
        }
        return  response()->json("Record deleted successfully");
    }
}
