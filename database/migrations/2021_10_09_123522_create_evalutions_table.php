<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvalutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evalutions', function (Blueprint $table) {
            $table->id();
            $table->integer("vendor_id");
            $table->integer("stor_id");
            $table->integer("customer_id");
            $table->boolean("share_Stor_Evalution");
            $table->boolean("shar_Product_Evalution");
            $table->boolean("requestStorEvalution");
            $table->boolean("requesttransportation");
            $table->boolean("requestProductsEvalution");
            $table->text("thankingMessage");
            $table->boolean("SendingMessageAfetrEvalution");
            $table->boolean("afterperiod");
            $table->boolean("sending_Method");
            $table->text("messageContent");
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
        Schema::dropIfExists('evalutions');
    }
}
