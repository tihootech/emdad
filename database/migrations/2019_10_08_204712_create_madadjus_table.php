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
            $table->string('muid');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_code')->unique();
            $table->date('birthday')->nullable();
            $table->boolean('male');
            $table->string('education_grade');
            $table->string('education_field')->nullable();
            $table->text('work_experience')->nullable();
            $table->string('skill')->nullable();
            $table->string('training')->nullable();
            $table->string('favourites')->nullable();
            $table->unsignedSmallInteger('region')->nullable();
            $table->text('address');
            $table->string('insurance_number')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile');
            $table->boolean('married');
            $table->string('military_status');
            $table->string('warden_name');
            $table->string('warden_national_code');
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
