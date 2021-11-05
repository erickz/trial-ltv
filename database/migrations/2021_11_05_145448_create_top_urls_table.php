<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_urls', function (Blueprint $table) {
            $table->id();
            //Apply index to It in order to improve the speed of the query when searching this column
            $table->string('original_url')->index();
            $table->string('shortened_url')->index();
            $table->integer('access_count');
            $table->softDeletes();
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
        Schema::dropIfExists('top_urls');
    }
}
