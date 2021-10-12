<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {            
            $table->id();
            $table->integer("stor_id");
            $table->integer("branch_id")->nullable();
            $table->string("categories")->default("");
            $table->string("type");
            $table->integer("employeer_id");
            $table->integer("price");
            $table->integer("qty")->default(0);
            $table->boolean("unlimitedOrNot")->default(false);
            $table->integer("alert_quantity")->default(0);
            $table->integer("remaining")->default(0);
            $table->string("mainImage")->nullable();
            $table->string("viedo")->nullable();
            $table->boolean("moreThanImage")->default(false);
            $table->boolean("is_variant")->default(false);
            $table->boolean("is_diffPrice")->default(false);
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
        Schema::dropIfExists('products');
    }
}