<?php

namespace App\Http\Controllers;

use App\Models\ProductHistory;

use Illuminate\Http\Request;

class ProductHistoryController extends Controller
{
    public function productHistoryCreate(Request $request)
    {
        $validate = $request->validate([
            'image' => 'required|string',
            'name' => 'required|string|max:100',
            'price' => 'required',
            'description' => 'string',
            'category' => 'required|string',
            'quantity' => 'required',
            'total' => 'required',
            'user_id' => 'required',
        ]);

        $product = ProductHistory::create($validate);

        $response = [
            'product' => $product,
            'message' => 'Create Success'
        ];
        return response($response, 201);
    }

    public function productHistoryCount()
    {
        return ProductHistory::all()->count();
    }

    public function productHistoryRead()
    {
        // return ProductHistory::all();
        return ProductHistory::with('users')->get(); // users => function name in ProductHistory Model
    }

    public function productHistoryDelete($id)
    {
        ProductHistory::destroy($id);

        $response = [
            'message' => 'Delete Success'
        ];
        return response($response, 200);
    }

    public function productHistorySearch($keyword)
    {
        return ProductHistory::with('users')
        ->where('name', 'like', '%' . $keyword . '%')
        ->orWhere('price', 'like', '%' . $keyword . '%')
        ->orWhere('description', 'like', '%' . $keyword . '%')
        ->orWhere('quantity', 'like', '%' . $keyword . '%')
        ->orWhere('category', 'like', '%' . $keyword . '%')
        ->orWhere('total', 'like', '%' . $keyword . '%')
        ->get();
    }
}
