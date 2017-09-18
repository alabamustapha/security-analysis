<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ResponsesTableSeeder::class);
        //$this->call(RespondentsTableSeeder::class);
        //$this->call(BuildingsTableSeeder::class);
        //$this->call(CategoriesTableSeeder::class);
    }
}
