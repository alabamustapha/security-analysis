<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $general = Category::create([
        	'name' => 'General',
        ]);

        $opl =  Category::create([
        	'name' => 'OPL',
        ]);

        $mpl = Category::create([
        	'name' => 'MPL',
        ]);

        $sub_mpl = Category::create([
        	'name' => 'SUB MPL',
        	'category_id' => $mpl->id,
        ]);

    }
}
