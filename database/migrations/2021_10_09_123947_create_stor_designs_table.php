<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stor_designs', function (Blueprint $table) {
            $table->id();
            $table->integer("stor_id");
            $table->string("product_show_method");
            $table->string("storColor");
            $table->string("mainMenu");
            $table->string("backgroundStyle");
            $table->boolean("allowPagination");
            $table->boolean("allowShowAllButton");
            $table->boolean("sameheightForAllProduct");
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
        Schema::dropIfExists('stor_designs');
    }
}
