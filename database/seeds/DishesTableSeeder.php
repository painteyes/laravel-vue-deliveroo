<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Dish;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
       
        $dishes_type = ['Primi', 'Secondi', 'Contorni', 'Dolci', 'Anti Pasto'];

        $dish = new Dish();

        $dish->name = 'Tagliatelle ai funghi porcini';
        $dish->ingredients = 'tagliatelle, funghi porcini, pomodoro';
        $dish->price = 8.50;
        $dish->type = $dishes_type[rand(0, 4)];
        $dish->user_id = 1;
        $dish->img_path = "dish-1.jpg";
        $dish->visible = true;
        $dish->save();

        $dish = new Dish();

        $dish->name = 'Bistecca ai ferri';
        $dish->ingredients = 'carne di vitello, rosmarino';
        $dish->price = 15.00;
        $dish->type = $dishes_type[rand(0, 4)];
        $dish->user_id = 1;
        $dish->img_path = "dish-2.jpg";
        $dish->visible = true;
        $dish->save();

        $dish = new Dish();

        $dish->name = 'Hosomoki';
        $dish->ingredients = 'riso, alga nori, gamberi, salsa';
        $dish->price = 10.00;
        $dish->type = $dishes_type[rand(0, 4)];
        $dish->user_id = 2;
        $dish->img_path = "dish-3.jpg";
        $dish->visible = true;
        $dish->save();

        $dish = new Dish();

        $dish->name = 'Temaki';
        $dish->ingredients = 'riso, alga nori, salmone, avocado';
        $dish->price = 15.00;
        $dish->type = $dishes_type[rand(0, 4)];
        $dish->user_id = 2;
        $dish->img_path = "dish-4.jpg";
        $dish->visible = true;
        $dish->save();

        // $dish = new Dish();

        // $dish->name = 'Tagliatelle ai funghi porcini';
        // $dish->ingredients = 'pennette, pomodoro, cipolla, tonno';
        // $dish->price = 8.50;
        // // $dish->type = $dishes_type[rand(0, 4)];
        // $dish->user_id = 1;
        // $dish->img_path = "https://i.scdn.co/image/ab67616d0000b2737172dd8b8efda356b64ad596";
        // $dish->visible = true;
        // $dish->save();

        // $dish = new Dish();

        // $dish->name = 'Ravioli di mozzarella e salsicce alle noci';
        // $dish->ingredients = 'ravioli, mozzarella, salsiccia, noci';
        // $dish->price = 15.00;
        // // $dish->type = $dishes_type[rand(0, 4)];
        // $dish->user_id = 1;
        // $dish->img_path = "https://i.scdn.co/image/ab67616d0000b2737172dd8b8efda356b64ad596";
        // $dish->visible = true;
        // $dish->save();

        // $dish = new Dish();

        // $dish->name = 'Ravioli di mozzarella e salsicce alle noci';
        // $dish->ingredients = 'ravioli, mozzarella, salsiccia, noci';
        // $dish->price = 15.00;
        // // $dish->type = $dishes_type[rand(0, 4)];
        // $dish->user_id = 1;
        // $dish->img_path = "https://i.scdn.co/image/ab67616d0000b2737172dd8b8efda356b64ad596";
        // $dish->visible = true;
        // $dish->save();

        // $dish = new Dish();

        // $dish->name = 'Ravioli di mozzarella e salsicce alle noci';
        // $dish->ingredients = 'ravioli, mozzarella, salsiccia, noci';
        // $dish->price = 15.00;
        // // $dish->type = $dishes_type[rand(0, 4)];
        // $dish->user_id = 1;
        // $dish->img_path = "https://i.scdn.co/image/ab67616d0000b2737172dd8b8efda356b64ad596";
        // $dish->visible = true;
        // $dish->save();



        

        
    }
}
