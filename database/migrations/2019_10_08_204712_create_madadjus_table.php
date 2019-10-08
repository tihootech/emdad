<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMadadjusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('madadjus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('father_name')->nullable();
            $table->date('birthday')->nullable();
            $table->string('national_code')->unique();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('madadjus');
    }
}
