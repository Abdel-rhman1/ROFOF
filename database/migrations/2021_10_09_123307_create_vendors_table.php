<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors2', function (Blueprint $table) {
            $table->id();
            $table->integer("admin_id");
            $table->integer("paln_id");
            $table->integer("stor_id");
            $table->string("Name");
            $table->string("email")->uniqe(); //optional
            $table->string("phone");
            $table->boolean("is_wattsap");
            $table->string("address");
            $table->string("about");
            $table->string("image");
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
        Schema::dropIfExists('vendors2');
    }
}
