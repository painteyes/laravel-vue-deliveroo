<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class SearchController extends Controller
{
    public function getRestaurants(Request $request) {
       
        /** Salva le categorie selezionate dall'utente dopo 
         *  che il componente SearchRestaurant le invia con
         *  axios (nei params) tramite metodo post  */
        $categories = $request->categories; 

        /** Salva tutte le categorie insieme ai ristoranti */
        $categoriesWithRestaurants = Category::with('users')
        ->whereIn('name', $categories)
        ->get();

        //** Ristoranti filtrati in base alla categorie */ 
        $filteredRestaurants = [];

        /** Contiene l'id dei ristoranti già pushati in $filteredRestaurants, 
         *  viene controllato per non ripetere lo stesso ristorante più volte
         *  se questo ha più categorie */  
        $users_id = [];

        foreach ($categoriesWithRestaurants as $category) {
            foreach ($category->users as $user) {
                if(!in_array($user->id, $users_id)) {
                    $users_id[] = $user->id;
                    $filteredRestaurants[] = $user;
                } 
            }
        }

        return response()->json([
            'success'=> true, 
            'result' => $filteredRestaurants
        ]);
    }
}
