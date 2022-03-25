<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RestaurantController extends Controller
{
    public function show($slug) {
        $user = User::where('slug', '=', $slug)->first();
        if (!$user) {
            abort('404');
        }
        return view('pages.guests.singleRestaurant', compact('user'));
    }
}
