<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovaPortfolioTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('preview')->nullable();
            $table->string('preview_file_name_original')->nullable();
            $table->string('preview_mime_type')->nullable();
            $table->string('preview_disk')->nullable();
            $table->unsignedInteger('preview_size')->nullable();
            $table->string('full_url')->nullable();
            $table->string('full')->nullable();
            $table->string('full_file_name_original')->nullable();
            $table->string('full_mime_type')->nullable();
            $table->string('full_disk')->nullable();
            $table->unsignedInteger('full_size')->nullable();
            $table->nullableTimestamps();
        });
        Schema::create('media_portfolio', function (Blueprint $table) {
            $table->unsignedInteger('media_id');
            $table->unsignedInteger('portfolio_id');

            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
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
        Schema::table('media_portfolio', function (Blueprint $table) {
            $table->dropForeign(['portfolio_id']);
            $table->dropForeign(['media_id']);
        });
        Schema::dropIfExists('media_portfolio');
        Schema::dropIfExists('media');
        Schema::dropIfExists('portfolios');
        
    }
}
