<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function(Blueprint $table){
            $table->increments('id');
            $table->text('body');            
            $table->enum('type', ['checkbox', 'rating', 'text', 'dropdown', 'date', 'location', 'radio']);
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
            $table->text('options')->nullable();
            $table->unsignedInteger('building_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('question_id')->nullable();
            $table->foreign('building_id')->references('id')->on('buildings');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('question_id')->references('id')->on('questions');
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
        Schema::drop('questions');    
    }
}
