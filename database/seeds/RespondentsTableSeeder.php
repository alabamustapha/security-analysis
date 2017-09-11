<?php

use Illuminate\Database\Seeder;
use App\Building;

class RespondentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $building_ids = Building::pluck('id')->toArray();
        for ($i=0; $i < 10 ; $i++) { 
	        	DB::table('respondents')->insert([
	        	'name' 			=> $faker->name,
	        	'building_id' 	=> $building_ids[array_rand($building_ids)]
	        ]); 
        }
    }
}
