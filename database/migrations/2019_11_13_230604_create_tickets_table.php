<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid');
            $table->string('notification_history_uid')->nullable();
            $table->string('title');
            $table->unsignedInteger('user_id');
            $table->string('status')->default('open'); // open, answered, closed
            $table->unsignedSmallInteger('priority'); // 1,2,3
            $table->string('type'); // complaint, official
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
        Schema::dropIfExists('tickets');
    }
}
