<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Experience;
use App\Models\User;

class ExperienceSeeder extends Seeder
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

        // On récupère tous les utilisateurs comme ça
        $users = User::all();

        foreach ($users as $user) {
            // Chaque user aura entre 1 et 3 expériences aléatoires
            for ($i = 0; $i < rand(1, 3); $i++) {
                $experience = new Experience();
                $experience->position = $faker->jobTitle();
                $experience->company = $faker->company();
                $experience->start_date = $faker->dateTimeBetween('-10 years', '-2 years');
                $experience->end_date = $faker->dateTimeBetween('-2 years', 'now');
                $experience->city = $faker->city();
                $experience->address = $faker->address();
                $experience->postal_code = $faker->postcode();
                $experience->description = $faker->sentence(10);
                $experience->user_id = $user->id;
                $experience->save();
            }
        }
    }
}
