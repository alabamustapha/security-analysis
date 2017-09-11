<?php

use Illuminate\Database\Seeder;


class BuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('buildings')->insert([
        	'name' => 'Schools',
        ]); 

        DB::table('buildings')->insert([
        	'name' => 'Hospitals',
        ]);
        DB::table('buildings')->insert([
        	'name' => 'Stadiums',
        ]);
        DB::table('buildings')->insert([
        	'name' => 'Restaurants',
        ]);
    }
}
