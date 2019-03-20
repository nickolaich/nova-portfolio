<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovaPortfolioLandingsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('landings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url_slug')->nullable();
            $table->integer('has_options')->default(0);
            $table->integer('collection_id')->nullable();
            $table->nullableTimestamps();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->text('content');
            $table->string('header')->nullable();
            $table->nullableTimestamps();
        });

        Schema::create('landing_media', function (Blueprint $table) {
            $table->unsignedInteger('media_id');
            $table->unsignedInteger('landing_id');
            $table->unsignedInteger('position')->default(0);

            $table->foreign('landing_id')->references('id')->on('landings')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
        });


        Schema::create('landing_section', function (Blueprint $table) {
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('landing_id');
            $table->unsignedInteger('position')->default(0);
            $table->string('header')->nullable();

            $table->foreign('landing_id')->references('id')->on('landings')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });

        Schema::table('portfolios', function(Blueprint $table){
            $table->unsignedInteger('slider_collection_id')->after('label')->nullable();
            $table->unsignedInteger('main_collection_id')->after('slider_collection_id')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolios', function(Blueprint $table){
            $table->dropColumn('slider_collection_id');
            $table->dropColumn('main_collection_id');
        });

        Schema::table('landing_media', function (Blueprint $table) {
            $table->dropForeign(['landing_id']);
            $table->dropForeign(['media_id']);
        });
        Schema::table('landing_section', function (Blueprint $table) {
            $table->dropForeign(['landing_id']);
            $table->dropForeign(['section_id']);
        });
        Schema::dropIfExists('landing_media');
        Schema::dropIfExists('landing_section');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('landings');

    }
}
