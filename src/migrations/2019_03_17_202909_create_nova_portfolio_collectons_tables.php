<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovaPortfolioCollectonsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->nullableTimestamps();
        });
        Schema::create('collection_media', function (Blueprint $table) {
            $table->unsignedInteger('media_id');
            $table->unsignedInteger('collection_id');

            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collection_media', function (Blueprint $table) {
            $table->dropForeign(['collection_id']);
            $table->dropForeign(['media_id']);
        });
        Schema::dropIfExists('collection_media');
        Schema::dropIfExists('collections');

    }
}
