<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUniqueRespondentForBuildingFromRespondentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('respondents', function(Blueprint $table){
            $table->dropUnique('unique_respondent_for_building');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('respondents', function(Blueprint $table){
            $table->unique(['name', 'building_id'], 'unique_respondent_for_building');
        });
        
    }
}
