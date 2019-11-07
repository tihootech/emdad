<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntroducesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('introduces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('madadju_id');
            $table->unsignedInteger('organ_id');
            $table->unsignedInteger('operator_id')->default(0);
            $table->unsignedSmallInteger('status')->default(1); // 1:pending, 2:accepted, 3:rejected
            $table->boolean('confirmed')->default(1);
            $table->text('information')->nullable();
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
        Schema::dropIfExists('introduces');
    }
}
