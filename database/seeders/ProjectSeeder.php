<?php

namespace Database\Seeders;
use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        $types = Type::all();

        $technologyIds = Technology::all()->pluck('id')->toArray();


        for ($i=0; $i < 100 ; $i++) { 
            $newProject = new Project();
            $newProject->type_id = ($faker->randomElement($types))->id;
            $newProject->title = ucfirst($faker->unique()->words(5, true));
            $newProject->content = $faker->paragraphs(10, true);
            $newProject->slug = $faker->slug();
            $newProject->image = $faker->imageUrl(480, 360, 'project', true, 'projects', true, 'png');
            $newProject->save();

            $newProject->slug = Str::of("$newProject->id " . $newProject->title)->slug('-');
            $newProject->save();

            $newProject->technologies()->sync([$faker->randomElement($technologyIds), $faker->randomElement($technologyIds), $faker->randomElement($technologyIds) ]);

        }
    }
}
