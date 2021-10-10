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
            $table->integer("vendor_id");
            $table->integer("stor_id");
            $table->integer("branch_id");
            $table->integer("category_id");
            $table->integer("brand_id");
            $table->integer("employeer_id");
            $table->integer("cost");
            $table->integer("price");
            $table->integer("qty");
            $table->boolean("unlimitedOrNot");
            $table->integer("alert_quantity");
            $table->integer("remaining");
            $table->string("mainImage");
            $table->boolean("moreThanImage");
            $table->text("tags");
            $table->boolean("is_variant");
            $table->boolean("is_diffPrice");
            $table->text("product_details");
            $table->boolean("is_active");
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