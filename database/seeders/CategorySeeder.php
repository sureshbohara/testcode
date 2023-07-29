<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            $name = $faker->unique()->word;
            DB::table('categories')->insert([
                'parent_id' => 0,
                'name' => $name,
                'slug' => $faker->slug,
                'image' => $faker->imageUrl(640, 480, 'cats', true),
                'type' => $faker->randomElement(['Popular', 'Latest', 'Upcoming', 'Normal']), // Ensure a valid value is assigned
                'description' => $faker->paragraph,
                'order_level' => $faker->randomElement([1, 2, 3]),
                'status' => $faker->boolean(80),
                'meta_title' => $faker->sentence,
                'meta_description' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

