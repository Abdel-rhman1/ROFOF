<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer("order_id");
            $table->integer("vendor_id");
            $table->integer("Product_id");
            $table->string("KiloGram");
            $table->integer("qty");
            $table->integer("price");
            $table->integer("totlalRequired");
            $table->boolean("haveCupon");
            $table->integer("cubonId");
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
        Schema::dropIfExists('sales');
    }
}
