<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCubonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cubons', function (Blueprint $table) {
            $table->id();
            $table->integer("vendor_id");
            $table->integer("stor_id");
            $table->integer("branch_id");
            $table->integer("type");
            $table->date("validTo");
            $table->boolean("freeShipping");
            $table->integer("minimumNoFP");
            $table->integer("NOFUsing");
            $table->string("toalUsingPeerCustomer");
            $table->integer("paymentId");
            $table->string("Includingcategory");
            $table->string("includingProducts");
            $table->string("includingCustomers");
            $table->string("nonIncludingCategories");
            $table->string("nonIncludingBrand");
            $table->string("nonIncludingProducts");
            $table->string("nonIncludingCustomersGroup");
            $table->string("Notes");
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
        Schema::dropIfExists('cubons');
    }
}
