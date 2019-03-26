<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoToLandings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('landings', function (Blueprint $table) {
            $table->text('heading')->after('name')->nullable();
            $table->text('subheading')->after('heading')->nullable();
            
            $table->string('seo_title')->after('collection_id')->nullable();
            $table->text('seo_description')->after('seo_title')->nullable();
            $table->text('seo_keywords')->after('seo_description')->nullable();

            $table->tinyInteger('show_contact_form')->after('seo_description')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('landings', function (Blueprint $table) {
            $table->dropColumn([
                'heading',
                'subheading',
                'seo_title',
                'seo_description',
                'seo_keywords',
                'show_contact_form',
            ]);
        });
    }
}
