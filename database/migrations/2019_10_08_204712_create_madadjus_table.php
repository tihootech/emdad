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
            $table->string('muid')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('national_code')->unique()->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('male')->nullable();
            $table->string('education_grade')->nullable();
            $table->string('education_field')->nullable();
            $table->text('work_experience')->nullable();
            $table->string('skill')->nullable();
            $table->string('training')->nullable();
            $table->string('favourites')->nullable();
            $table->unsignedSmallInteger('region')->nullable();
            $table->text('address')->nullable();
            $table->string('insurance_number')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->boolean('married')->nullable();
            $table->string('military_status')->nullable();
            $table->string('warden_name')->nullable();
            $table->string('warden_national_code')->nullable();
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
