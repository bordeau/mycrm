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
		if ( Schema::hasTable('activity_users')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('created_by_id')->references('id')->on('users');
				$table->foreign('modified_by_id')->references('id')->on('users');
				$table->foreign('users_id')->references('id')->on('users');
			}
			if ( Schema::hasTable('activity')  ) {
				$table->foreign('activity_id')->references('id')->on('activity');
			}
		}
		else {
	        Schema::table('activity_users', function (Blueprint $table) {
	            $table->bigIncrements('id');

				$table->bigInteger('activity_id')->unsigned();
				$table->integer('users_id')->unsigned();

				$table->integer('created_by_id')->unsigned();
				$table->integer('modified_by_id')->unsigned();

				$table->softDeletes();
	            $table->timestamps();


				if ( Schema::hasTable('users')  ) {
					$table->foreign('created_by_id')->references('id')->on('users');
					$table->foreign('modified_by_id')->references('id')->on('users');
					$table->foreign('users_id')->references('id')->on('users');
				}
				if ( Schema::hasTable('activity')  ) {
					$table->foreign('activity_id')->references('id')->on('activity');
				}
	        });
		}
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
