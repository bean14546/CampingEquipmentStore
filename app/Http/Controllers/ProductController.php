<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function productCreate(Request $request)
    {
        $validate = $request->validate([
            'image' => 'required|string',
            'name' => 'required|string|max:100',
            'price' => 'required',
            'description' => 'string',
            'amount' => 'required',
            'category' => 'required|string',
        ]);

        $product = Product::create($validate);

        $response = [
            'product' => $product,
            'message' => 'Create Success',
        ];
        return response($response, 201);
    }

    public function productCount()
    {
        return Product::all()->count();
    }

    public function productRead()
    {
        return Product::all();
    }

    public function productReadID($id)
    {
        return Product::find($id);
    }

    public function productReadForGuest(){
        return Product::limit(3)->get();
    }

    public function productReadCategory($category)
    {
        return Product::where('category', 'like', '%' . $category . '%')->get();
    }

    public function productUpdate(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        $response = [
            'product' => $product,
            'message' => 'Update Success',
        ];
        return response($response, 200);
    }

    public function productDelete($id)
    {
        Product::destroy($id);

        $response = [
            'message' => 'Delete Success',
        ];
        return response($response, 200);
    }

    public function productSearch($keyword)
    {
        return Product::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('price', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orWhere('amount', 'like', '%' . $keyword . '%')
            ->orWhere('category', 'like', '%' . $keyword . '%')
            ->get();
    }



}
