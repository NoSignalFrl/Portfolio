<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\User;
use App\Models\Skill;
use App\Models\Experience;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++){
            $user = new User;
            $user->email = $faker->unique()->email;
            $user->password = bcrypt('123456');
            $user->name = $faker->lastName;
            // $user->prenoms = $faker->firstName;
            $user->phone = $faker->
            $user->save();
        }
    }
}
