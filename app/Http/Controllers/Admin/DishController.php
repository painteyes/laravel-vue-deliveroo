<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Dish;
use Illuminate\Http\Request;
use App\User;
use Error;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
    */

    // Ritorna una lista di tutti i piatti di un ristorante
    public function getRestaurantDishes($id)
    {
        $restaurant = User::findOrFail($id);
        $dishes = Dish::all()->where('user_id', '=', $restaurant->id);

        $data = [
            'dishes' => $dishes
        ];

        // Mostra al ristorante solo la prorpia lista dei piatti verificandolo tramite $id
        if(Auth::user()->id == $id){
            return view('pages.admin.index', $data);

        }else{
            return dd('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
    */

    // Mostra il form per creare un nuovo piatto
    public function create($id)
    {
        if(Auth::user()->id == $id){
            return view('pages.admin.createDish');

        }else{
            return dd('404');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    // Salva un nuovo piatto
    public function store(Request $request)
    {
        
        // Valida i dati del form 
        // $request->validate(); /** aggiungere le regole di validazione */

        // Salva in un array i dati del form
        $form_data = $request->all();

        //** Manipola l'array (form_data) */ 
        // 1. Aggiunge una chiave user_id
        $form_data['user_id'] = Auth::user()->id;

        // 2.Sovrascrive il valore della chiave img_path
        if(isset($form_data['img_path'])) {
            // Put the image in the storage folder
            $img_path = Storage::put('upload', $form_data['img_path']);
            // Save the path to the file in the cover column of the dish
            $form_data['img_path'] = $img_path;
        }
    
        // Crea un nuovo piatto
        $dish = new Dish();

        // Fa il fill dell'array (form_data)
        $dish->fill($form_data);

        // Salva il piatto
        $dish->save();
        
        // Manca la rotta per il return
        return redirect()->route('admin.dishes', ['id' => Auth::user()->id]);
    }

    /**
     * Display the specified resource.
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
    */

    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request, Dish $dish, $id)
    {
        // Valida i dati del form 
        $request->validate(); /** aggiungere le regole di validazione */

        // Salva in un array i dati del form
        $form_data = $request->all();

        $dish = Dish::findOrFail($id);
        $dish->update($form_data);

        // Manca la rotta per il return
        // return redirect()->route();
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
    */

    public function destroy(Dish $dish, $id)
    {
        $dish = Dish::findOrFail($id);

        // Azzera tutte le relazioni nella tabella ponte
        $dish->orders()->sync([]);

        // Elimina l'upload dell'immagine del piatto nella cartella storage
        Storage::delete($dish->img_path);
        
        // Elimina il piatto
        $dish->delete();

        // redirect
    }
}
