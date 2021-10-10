<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingCompaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_compaigns', function (Blueprint $table) {
            $table->id();
            $table->integer("vendor_id");
            $table->integer("stor_id");
            $table->integer("branch_id");
            $table->string("Name");
            $table->text("message");
            $table->string("link");
            $table->string("shortLink");
            $table->string("conditionToJoin");
            $table->string("conditionToJoinType");
            $table->string("conditionValue");
            $table->string("goal");
            $table->string("time");
            $table->integer("requiredMoney");
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
        Schema::dropIfExists('marketing_compaigns');
    }
}
