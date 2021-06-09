<?php

namespace Database\Seeders;

use App\Models\Navlink;
use Illuminate\Database\Seeder;

class NavlinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Navlink::create(['group' => 'navbar', 'title' => 'Home', 'slug' => 'home', 'route' => 'home']);
        Navlink::create(['group' => 'navbar', 'title' => 'Shops', 'slug' => 'shop', 'route' => 'shop']);
        Navlink::create(['group' => 'navbar','title' => 'Plans','slug' => 'plans','route' => 'plans']);
        Navlink::create(['group' => 'navbar','title' => 'Support','slug' => 'support','route' => 'support']);
        Navlink::create(['group' => 'navbar','title' => 'Blog','slug' => 'blog','route' => 'blog']);
    }
}
