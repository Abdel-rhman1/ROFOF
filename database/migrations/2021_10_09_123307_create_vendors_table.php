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
            $table->integer("admin_id")->default(null);
            $table->string("name");
            $table->string("email")->uniqe(); //optional
            $table->string("phone");
            $table->string("password");
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
