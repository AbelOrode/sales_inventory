<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $product = DB::table('products')
             ->join('categories', 'products.category_id', 'categories.id')
                ->join('suppliers', 'products.supplier_id', 'suppliers.id')->select('categories.category_name', 'suppliers.name', 'products.*')
                 ->orderBy('products.id', 'DESC')->get();

     return response()->json($product);

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
        $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required'
        ]);

        if($request->image){ //If a photo exists
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $extension = explode('/', $sub)[1];
            $name = time().".".$extension;
            $image = Image::make($request->image)->resize(240, 200);
            $upload_path = 'images/product/';
            $image_url = $upload_path.$name;
            $image->save($image_url);

            $product = new Product();
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->category_id = $request->category_id;
            $product->root = $request->root;
            $product->supplier_id = $request->supplier_id;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->image = $image_url;

            $product->save();

            return response()->json("Product created successfully");

        }else{
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->category_id = $request->category_id;
            $product->root = $request->root;
            $product->supplier_id = $request->supplier_id;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;

            $product->save();
            return response()->json("Product created successfully");

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
        $product = Product::findOrFail($id);
        return response()->json($product);
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
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['category_id'] = $request->category_id;
        $data['root'] = $request->root;
        $data['supplier_id'] = $request->supplier_id;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['buying_date'] = $request->buying_date;
        $data['product_quantity'] = $request->product_quantity;
        $image = $request->newImage;

        if($image){
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $extension = explode('/', $sub)[1];
            $name = time().".".$extension;
            $image = Image::make($image)->resize(240, 200);
            $upload_path = 'images/product/';
            $image_url = $upload_path.$name;
            $success = $image->save($image_url);

            if($success){
                $data['image'] = $image_url;
                $img = DB::table('products')->where('id', $id)->update($data);
                $image_path = $img->image;
                $done = unlink($image_path);
                $user = DB::table('products')->where('id', $id)->update($data);
                return response()->json("Product created successfully");
            }else{
                $oldPhoto = $request->image;
                $data['image'] = $oldPhoto;
                $user = DB::table('products')->where('id', $id)->update($data);
                return response()->json("Product created successfully");
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
        Product::findOrFail($id)->delte();
        return response()->json("Record deleted successfully");
    }

    public function search($name){
        return Product::where('product_name','LIKE', '%'.$name.'%')->get();
    }
}
