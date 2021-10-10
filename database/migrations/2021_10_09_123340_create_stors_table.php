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
            $table->integer("plan_id");
            $table->integer("branch_id");
            $table->string("Name");
            $table->text("description");
            $table->string("location_lang");
            $table->string("location_lat");
            $table->string("broswer_icon");
            $table->string("stor_activities");
            $table->string("phone");
            $table->string("whattsap")->unique();
            $table->string("telegram")->unique();
            $table->string("mail")->unique();
            $table->string("instrgram")->unique();
            $table->string("twitter")->unique();
            $table->string("facebook");
            $table->string("youtube");
            $table->string("snapchat");
            $table->string("iosApplicationUrl");
            $table->string("AndroidApplicationURL");
            $table->string("defaultLang");
            $table->string("defaultCurrency");
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
