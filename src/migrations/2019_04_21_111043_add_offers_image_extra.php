<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOffersImageExtra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('image_file_name_original')->nullable()->after('image');
            $table->string('image_mime_type')->nullable()->after('image_file_name_original');
            $table->string('image_disk')->nullable()->after('image_mime_type');
            $table->unsignedInteger('image_size')->nullable()->after('image_disk');
            $table->string('image_remote_url')->nullable()->after('image_size');


            $table->integer('position')->default(0)->after('url');
            $table->integer('position_on_main')->default(0)->after('url');

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
            $table->dropColumn('image_file_name_original', 'position', 'position_on_main', 'image_mime_type', 'image_disk', 'image_size', 'image_remote_url');
        });
    }
}
