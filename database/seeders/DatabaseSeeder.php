<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Defalut User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $this->call(NavlinkSeeder::class);

        Event::create([
            'title' => 'Ring Ceremony',
            'detail' => 'Bride and groom exchanges rings',
            'image' => 'https://i.ibb.co/G07BQ6Z/ring-2407552-640.jpg',
            'start' => '2021-11-07 10:00:00',
            'end' => '2021-11-07 17:00:00',
        ]);

        Event::create([
            'title' => 'Mehndi Function',
            'detail' => 'Mehndi design are imprinted on bride, groom and relatives hands',
            'image' => 'https://i.ibb.co/dttmK0T/henna-691901-640.jpg',
            'start' => '2021-11-12 18:00:00',
            'end' => '2021-11-12 22:00:00',
        ]);

        Event::create([
            'title' => 'Marraige',
            'detail' => 'Both exchange vows to take care each other for lifetime',
            'image' => 'https://i.ibb.co/CmHGrpG/beach-1854076-640.jpg',
            'start' => '2021-11-14 19:00:00',
            'end' => '2021-11-15 04:00:00',
        ]);

        Guest::create([
            'name' => 'Bimla Mousi',
            'relation' => 'Mousi ji',
            'adults' => 6,
            'kids' => 2,
            'senior' => 'Shyam Babu Gupta',
            'contact' => 'chintoo',
            'number' => '9310115615',
            'address' => 'CD Block, Hari Nagar, New Delhi 110064',
            'travelby' => 'car',
            'note' => 'has ertica car, to be used for transportation of items',
            'image' => Guest::defaultImage(),
        ]);
    }
}
