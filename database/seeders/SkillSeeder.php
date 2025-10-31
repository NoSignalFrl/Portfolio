<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\User;
use App\Models\Skill;

class SkillSeeder extends Seeder
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
            // Chaque user aura entre 2 et 5 skills aléatoires
            for ($i = 0; $i < rand(2, 5); $i++) {
                $skill = new Skill();
                $skill->skill = ucfirst($faker->word());
                $skill->description = $faker->sentence();
                $skill->user_id = $user->id;
                $skill->save();
            }
        }
    }
}
