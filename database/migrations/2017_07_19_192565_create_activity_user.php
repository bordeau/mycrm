<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_users', function (Blueprint $table) {
            $table->bigIncrements('id');

			$table->bigInteger('activity_id')->unsigned();
			$table->integer('users_id')->unsigned();

			$table->integer('created_by_id')->unsigned();
			$table->integer('modified_by_id')->unsigned();

            $table->timestamps();


			$table->foreign('activity_id')->references('id')->on('activity');
			$table->foreign('users_id')->references('id')->on('users');
			$table->foreign('created_by_id')->references('id')->on('users');
			$table->foreign('modified_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_users', function (Blueprint $table) {
            Schema::dropIfExists('activity_users');
        });
    }
}
