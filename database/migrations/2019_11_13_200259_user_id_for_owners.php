<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserIdForOwners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operators', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->after('id')->nullable();
        });
        Schema::table('organs', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operators', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('organs', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
