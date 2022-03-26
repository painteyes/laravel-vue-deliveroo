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
        for($i = 0; $i < 10; $i++) {
            $dish = new Dish();

            $dish->name = 'pasta col tonno';
            $dish->ingredients = 'pennette, pomodoro, cipolla, tonno';
            $dish->price = 8.50;
            $dish->type = $dishes_type[rand(0, 4)];
            $dish->user_id = rand(1,10);
            $dish->img_path = 'immagine';
            $dish->visible = true;
            $dish->save();
        }

        foreach($categories as $category) {
            $new_category = new Category();
            $new_category->name = $category;
            $new_category->slug = Str::slug($category);
            $new_category->save();
        }
    }
}
