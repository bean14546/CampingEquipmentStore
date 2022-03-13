<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userCount()
    {
        return User::all()->count();
    }

    public function userRead()
    {
        return User::all();
    }

    public function userReadID($id)
    {
        return User::find($id);
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());

        $response = [
            'user' => $user,
            'message' => 'Update Success'
        ];
        return response($response, 200);
    }

    public function userDelete($id)
    {
        User::destroy($id);

        $response = [
            'message' => 'Delete Success'
        ];
        return response($response, 200);
    }

    public function userSearch($keyword)
    {
        return User::where('firstName', 'like', '%' . $keyword . '%')
            ->orWhere('lastName', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->orWhere('phoneNumber', 'like', '%' . $keyword . '%')
            ->orWhere('gender', 'like', '%' . $keyword . '%')
            ->get();
    }
}
