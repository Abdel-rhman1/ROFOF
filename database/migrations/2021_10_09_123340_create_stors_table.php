<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stors', function (Blueprint $table) {
            $table->id();
            $table->integer("vendor_id");
            $table->integer("plan_id")->default(0);
            $table->string("name");
            $table->integer("stor_type");
            $table->string("invitation_cubon")->nullable();
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
        Schema::dropIfExists('stors');
    }
}
