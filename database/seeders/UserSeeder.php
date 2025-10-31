<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\User;


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

        for ($i = 0; $i < 10; $i++) {
            $user = new User;
            $user->email = $faker->unique()->safeEmail();
            $user->password = bcrypt('123456');
            $user->name = $faker->name();
            $user->birthday = $faker->date();
            $user->phone = $faker->phoneNumber();
            $user->save();
        }
    }
}
