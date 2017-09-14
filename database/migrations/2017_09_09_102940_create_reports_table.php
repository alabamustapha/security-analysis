<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('building_id');
            $table->unsignedInteger('page');
            $table->longText('body');
            $table->string('title')->nullable();
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->unique(["building_id", "page"], "unique_building_report_page");
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
        Schema::drop('reports');
    }
}
