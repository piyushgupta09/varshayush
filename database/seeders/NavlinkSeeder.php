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
        // ID 1
        Navlink::create(['group' => 'navbar',
            'title' => 'Event', 'slug' => 'events',
        ]);

        // ID 2
        Navlink::create(['group' => 'navbar',
            'title' => 'Guest','slug' => 'guests',
        ]);

        // ID 3
        Navlink::create(['group' => 'navbar',
            'title' => 'Tasks', 'slug' => 'tasks',
        ]);

        // ID 4
        Navlink::create(['group' => 'navbar',
            'title' => 'Profile', 'slug' => 'profile',
        ]);

    }
}
