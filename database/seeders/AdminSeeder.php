<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $admins = [
            [
                'name' => 'Books Store',
                'email' => 'admin@example.com',
                'password' => bcrypt('password123'),
                'address' => '123 Admin Street',
                'contact' => '1234567890',
                'gender' => 'Male',
                'facebook' => 'https://www.facebook.com/admin',
                'instagram' => 'https://www.instagram.com/admin',
                'twitter' => 'https://www.twitter.com/admin',
                'profiles' => 'https://www.example.com/admin',
                'bio' => 'I am an admin user.',
                'status' => 1,
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'author@example.com',
                'password' => bcrypt('password123'),
                'address' => '456 Vendor Street',
                'contact' => '0987654321',
                'gender' => 'Female',
                'facebook' => 'https://www.facebook.com/author',
                'instagram' => 'https://www.instagram.com/author',
                'twitter' => 'https://www.twitter.com/author',
                'profiles' => 'https://www.example.com/author',
                'bio' => 'I am a author user.',
                'status' => 1,
            ],
        ];

        foreach ($admins as $adminData) {
            Admin::create($adminData);
        }
    }
}
