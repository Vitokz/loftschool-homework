<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();
         \App\Models\Product::factory(10)->create();

        $categories=['Action','RPG','Shooter','Quests','Online','MMORPG'];
        for($i=0;$i<=5;$i++) {
            // \App\Models\Book::factory(10)->create();
            DB::table('categories')->insert([
                'namecategory' =>$categories[$i],
                'text' => mt_rand(100, 150),
                'created_at'=> $today = date("Y-m-d H:i:s"),
                'updated_at'=> $today = date("Y-m-d H:i:s"),
            ]);
        }


    }
}
