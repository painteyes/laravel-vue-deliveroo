<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Dish;
use Illuminate\Http\Request;
use App\User;
use App\Dish;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Ritorna tutti i piatti di un ristorante
    public function getRestaurantDishes($id)
    {
        $restaurant = User::findOrFail($id);
        $dishes = Dish::all()->where('user_id', '=', $id);

        // Mancano ancora la rotta
        return view('pages.admin.dishesList');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Crea un nuovo piatto
    public function create()
    {
        return view('pages.admin.createDish');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // valida i dati del form "mancano le regole di validazione"
        $request->validate();

        // salva i dati del form sotto forma di array
        $form_data = $request->all();

        // manipoliamo l'array (form_data): 
        // 1. aggiungendo una chiave user_id
        $form_data['user_id'] = Auth::user()->id;
        
        // 2. sovrascrive il valore della chiave img_path dell'array ($form_data)
        $img_path = Storage::put('upload', $form_data['img_path']);
        $form_data['img_path'] = $img_path;

        // creiamo una nuova istanza e facciamo il fill dell'array (form_data) manipolato
        $dish = new Dish();
        $dish->fill($form_data);
        $dish->save();
        
        // Mancano le rotte
        // return redirect()->route();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish, $id)
    {
        $dish = Dish::findOrFail($id);
        $data = [
            'dish' => $dish
        ];
        
        return view('pages.admin.editDish', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish, $id)
    {
        $request->validate();

        // salva i dati del form sotto forma di array
        $form_data = $request->all();

        $dish = Dish::findOrFail($id);
        $dish->update($form_data);

        // Mancano le rotte
        // return redirect()->route();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish, $id)
    {
        $dish = Dish::findOrFail($id);
        $dish->orders()->sync([]);
        $dish->delete();
        
    }
}
