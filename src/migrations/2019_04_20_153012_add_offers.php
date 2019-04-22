<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('portfolio_id');
            $table->string('name');
            $table->text('overview')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('on_main')->default(1);
            $table->string('url')->nullable();
            $table->string('price')->nullable();
            $table->string('additional_1')->nullable();
            $table->string('additional_2')->nullable();
            $table->nullableTimestamps();
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function(Blueprint $table){
            $table->dropForeign(['portfolio_id']);
        });
        Schema::dropIfExists('offers');
    }
}
