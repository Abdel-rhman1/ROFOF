<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->integer("vendor_id");
            $table->integer("stor_id");
            $table->string("Name");
            $table->string("country");
            $table->string("city");
            $table->string("address");
            $table->string("postal_code");
            $table->string("street");
            $table->string("state");
            $table->string("phone");
            $table->string("mobile");
            $table->string("whattsap");
            $table->string("period");
            $table->boolean("uponrecipt");
            $table->string("uponreciptcost");
            $table->string("sun");
            $table->string("mon");
            $table->string("tues");
            $table->string("wend");
            $table->string("thur");
            $table->string("fri");
            $table->string("sta");
            $table->string("location_lat");
            $table->string("location_lang");
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
        Schema::dropIfExists('branches');
    }
}
