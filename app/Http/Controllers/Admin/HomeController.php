<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        $user = Auth::user();
        $data = [
            'user' => $user
        ];
        return view('pages.admin.home', $data);
    }

    // public function graph($id)
    // {
    //     $restaurant = User::findOrFail($id);
    //     $dishes = Dish::all()->where('user_id', '=', $restaurant->id);

    //     $data = [
    //         'dishes' => $dishes
    //     ];

    //     // Mostra al ristorante solo la propria lista dei piatti verificandolo tramite $id
    //     if(Auth::user()->id == $id) {
    //         return view('pages.admin.index', $data);
    //     } else {
    //         abort('404');
    //     }
    // } 

    public function graph($id){

        // $user_id = $request->user()->id;
        // $restaurant_id = User::find($user_id)->restaurant->id;
        // $orders = Order::all()->where('restaurant_id', $restaurant_id);
        
        // foreach ($orders as $item) {
        //   $item->order = $item->order;
        // }
        if(Auth::user()->id == $id) {
            return view('pages.admin.graph');
            } else {
                abort('404');
            }
        }
}
