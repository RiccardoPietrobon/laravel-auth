<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            $project = new Project;
            $project->title = $faker->catchPhrase();
            $project->slug = Str::of($project->title)->slug('-');
            $project->text = $faker->paragraph(15);
            $project->save();
        }
    }
}