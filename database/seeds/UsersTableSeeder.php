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
        for($i = 0; $i < 10; $i++) {
            $user = new User();

            $user->name = $faker->name();
            $user->email = $faker->email();
            $user->password = $faker->password();
            $user->restaurant_name = $faker->company();
            $user->address = $faker->streetAddress();
            $user->vat_number = $faker->randomNumber(9, true);
            // $user->img_path 
            $user->slug = User::getUniqueSlugFromTitle($user->restaurant_name);
            $user->description = $faker->text(50);
            $user->save();

            $user->categories()->sync([1, 2, 3]);
        }
    }
}
