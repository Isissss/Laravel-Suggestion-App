<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\Status;
use App\Models\Tag;
use App\Models\User;
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
         Post::factory(10)->create();

         Status::create([
             'name' => 'Being considered',
             ]
         );
        Status::create([
                'name' => 'In development',
            ]
        );
        Status::create([
                'name' => 'Implemented',
            ]
        );
        Status::create([
                'name' => 'Rejected',
            ]
        );

        Tag::create([
                'name' => 'Quality of Life',
            ]
        );

        Tag::create([
                'name' => 'Patron',
            ]
        );

        Tag::create([
                'name' => 'New feature',
            ]
        );

        Tag::create([
                'name' => 'Stop additions',
            ]
        );
        Tag::create([
                'name' => 'Store ideas',
            ]
        );
        Tag::create([
                'name' => 'Bundles',
            ]
        );

        Tag::create([
                'name' => 'Ranks',
            ]
        );

        Tag::create([
                'name' => 'Perks',
            ]
        );


        Tag::create([
                'name' => 'Crates',
            ]
        );
    }
}
