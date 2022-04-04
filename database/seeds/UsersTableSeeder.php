<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        $user = new User();

        $user->name = 'Grazia';
        $user->email = 'graziaegraziella@gmail.com';
        $user->password = $faker->password();
        $user->phone_number = '3272483027';
        $user->restaurant_name = 'Grazia e Graziella';
        $user->address = 'Viale Battista Bardanzellu, 27';
        $user->vat_number = $faker->randomNumber(9, true);
        $user->img_path = 'restaurant-1.jpg';
        $user->slug = User::getUniqueSlugFromTitle($user->restaurant_name);
        $user->description = 'Il ristorante Grazia e Graziella in pochi anni è riuscito ad affermarsi come attività di riferimento per la zona e non solo.';
        $user->save();

        $user->categories()->sync([ 
            rand(1, 10),
            rand(1, 10),
            rand(1, 10),
        ]);


        $user = new User();

        $user->name = 'Kaori';
        $user->email = 'kaori@gmail.com';
        $user->password = $faker->password();
        $user->phone_number = '3909847811';
        $user->restaurant_name = 'Grazia e Graziella';
        $user->address = 'Viale Battista Bardanzellu, 27';
        $user->vat_number = $faker->randomNumber(9, true);
        $user->img_path = 'restaurant-1.jpg';
        $user->slug = User::getUniqueSlugFromTitle($user->restaurant_name);
        $user->description = 'Il ristorante Grazia e Graziella in pochi anni è riuscito ad affermarsi come attività di riferimento per la zona e non solo.';
        $user->save();

        $user->categories()->sync([ 
            rand(1, 10),
            rand(1, 10),
            rand(1, 10),
        ]);




        
    }
}
