<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespondentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respondents', function(Blueprint $table){
        	$table->increments('id');
        	$table->string('name');
        	$table->unsignedInteger('building_id');
        	$table->foreign('building_id')->references('id')->on('buildings');
        	$table->unique(['name', 'building_id'], 'unique_respondent_for_building');
        	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('respondents');
    }
}
