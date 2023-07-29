<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Author::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'address' => $faker->address,
                'image' => $faker->imageUrl(640, 480, 'people', true),
                'content' => $faker->paragraph,
                'status' => $faker->boolean(80),
            ]);
        }
    }
}
