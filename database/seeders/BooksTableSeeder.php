<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Books;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
       public function run(){
        $faker = Faker::create();
        $userId = 1;
        $numberOfRecords = 10;
        for ($i = 0; $i < $numberOfRecords; $i++) {
            \DB::table('books')->insert([
                'category_id' => $faker->numberBetween(1, 10),
                'name' => $faker->sentence(3),
                'slug' => $faker->unique()->slug(3),
                'tags' => $faker->words(3, true),
                'image' => $faker->imageUrl(),
                'type' => $faker->randomElement(['Popular', 'Latest', 'Upcoming', 'Normal']),
                'stock' => $faker->numberBetween(0, 100),
                'short_details' => $faker->paragraph(2),
                'long_details' => $faker->paragraph(5),
                'status' => $faker->boolean(75),
                'view_count' => $faker->numberBetween(0, 1000),
                'meta_title' => $faker->sentence(6),
                'meta_description' => $faker->paragraph(3),
                'created_by' => $userId,
                'updated_by' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
