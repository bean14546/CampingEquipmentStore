<?php

namespace App\Http\Controllers;

use App\Models\PersonalAccessToken;
use Illuminate\Http\Request;

class StartedOnController extends Controller
{
    public function activeUsersRead(){
        return PersonalAccessToken::with("activeUsers")->get(); // userStartedOn => function name in PersolAccessToken Model
    }

    public function activeUsersCount(){
        return PersonalAccessToken::all()->count();
    }
    public function activeUsersSearch($keyword){
        return PersonalAccessToken::with("activeUsers")
                ->where('tokenable_id', 'like', '%' . $keyword . '%')->get(); // userStartedOn => function name in PersolAccessToken Model
    }
}
