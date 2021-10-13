<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer("stor_id");
            // $table->integer("branch_id");
            $table->integer("group_id")->nullable();
            $table->string("Fname");
            $table->string("Lname");
            $table->string("email");
            $table->string("country");
            $table->string("phone");
            $table->string("brithday");
            $table->string("gender");
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
        Schema::dropIfExists('customers');
    }
}
