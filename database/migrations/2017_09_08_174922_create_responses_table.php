<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function(Blueprint $table){
            $table->increments('id');
            $table->text('body')->nullable();
            $table->text('images')->nullable();
            $table->text('audios')->nullable();
            $table->text('videos')->nullable();
            $table->text('suggestions')->nullable();
            $table->unsignedInteger('value')->nullable();
            $table->unsignedInteger('building_id');
            $table->unsignedInteger('respondent_id');
            $table->unsignedInteger('question_id');
            $table->foreign('building_id')->references('id')->on('buildings');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('respondent_id')->references('id')->on('respondents');
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
        Schema::drop("responses");
    }
}
