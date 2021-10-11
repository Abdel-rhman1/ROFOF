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
            $table->boolean("mainBranch");
            $table->string("Name");
            $table->string("country");
            $table->string("city");
            $table->string("address");
            $table->string("postal_code");
            $table->string("street");
            $table->string("state");
            $table->string("phone")->nullable();
            $table->string("mobile")->nullable();
            $table->string("whattsap")->nullable();
            $table->string("period")->nullable();
            $table->boolean("uponrecipt")->nullable();
            $table->string("uponreciptcost")->nullable();
            $table->string("sun")->nullable();
            $table->string("mon")->nullable();
            $table->string("tues")->nullable();
            $table->string("wend")->nullable();
            $table->string("thur")->nullable();
            $table->string("fri")->nullable();
            $table->string("sta")->nullable();
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
