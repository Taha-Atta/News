<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\RelateNewsSite;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RelatedSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $faktory = Factory::create();

        for($i = 0;$i < 5;$i++){
            RelateNewsSite::create([
                'name'=> $faktory->sentence(1),
                'url'=> $faktory->url(),
            ]);
        }
        //
    }
}
