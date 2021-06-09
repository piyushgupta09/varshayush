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
            'title' => 'Home', 'slug' => 'home',
        ]);

        // ID 2
        Navlink::create(['group' => 'navbar', 'hasChild' => true,
            'title' => 'Event', 'slug' => 'event',
        ]);

        // ID 3
        Navlink::create(['group' => 'navbar',  'hasChild' => true,
            'title' => 'People','slug' => 'people',
        ]);

        // ID 4
        Navlink::create(['group' => 'navbar',
            'title' => 'Invitation', 'slug' => 'invitation',
        ]);

        // Sub-menu for ID 2
        Navlink::create(['parent_id' => 2, 'group' => 'navbar',
            'title' => 'Occasion', 'slug' => 'occasion',
        ]);
        Navlink::create(['parent_id' => 2, 'group' => 'navbar',
            'title' => 'Ritual', 'slug' => 'ritual',
        ]);

        // Sub-menu for ID 3
        Navlink::create(['parent_id' => 3, 'group' => 'navbar',
            'title' => 'Guest', 'slug' => 'guest',
        ]);
        Navlink::create(['parent_id' => 3, 'group' => 'navbar',
            'title' => 'Vendor', 'slug' => 'vendor',
        ]);

    }
}
