<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            
            
        Schema::create('group_conditions', function (Blueprint $table) {
            $table->id();
            $table->integer("stor_id");
            $table->integer("group_id");
            $table->string("conditionToJoinType");
            $table->string("conditionToJoin");
            $table->string("conditionValue");
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
        Schema::dropIfExists('group_conditions');
    }
}
