<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Product as ProductResources;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return $this->sendResponse(ProductResources::collection($product),"All Products sent");
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validate = Validator::make($input,[
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
        ]);

        if($validate->fails()){
                return $this->sendError("please validate error",$validate->errors());
        }

        
        $product = Product::create($input);

        return $this->sendResponse(new ProductResources($product) ,"Product created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return $this->sendError("Product not found");
        }
        return $this->sendResponse(new ProductResources($product) ,"Product found successfully");

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();
        $validate = Validator::make($input,[
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
        ]);

        if($validate->fails()){
                return $this->sendError("please validate error",$validate->errors());
        }

        
        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->price = $input['price'];
        $product->save();
        return $this->sendResponse(new ProductResources($product) ,"Product updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse(new ProductResources($product) ,"Product deleted successfully");

    }
}
