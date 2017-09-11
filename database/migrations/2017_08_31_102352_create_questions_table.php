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
            $table->unsignedInteger('building_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('question_id')->nullable();
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
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
