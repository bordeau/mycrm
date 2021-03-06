<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if ( Schema::hasTable('profile_permissions')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('created_by_id')->references('id')->on('users');
				$table->foreign('modified_by_id')->references('id')->on('users');
			}
			if ( Schema::hasTable('profiles')  ) {
				$table->foreign('profiles_id')->references('id')->on('profiles');
			}
			if ( Schema::hasTable('permissions')  ) {
				$table->foreign('permissions_id')->references('id')->on('permissions');
			}
		}
		else {
			Schema::create('profile_permissions', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('profiles_id')->unsigned();
				$table->integer('permissions_id')->unsigned();

				$table->bigInteger('created_by_id')->unsigned();
				$table->bigInteger('modified_by_id')->unsigned();

				$table->timestamps();

				if ( Schema::hasTable('users')  ) {
					$table->foreign('created_by_id')->references('id')->on('users');
					$table->foreign('modified_by_id')->references('id')->on('users');
				}
				if ( Schema::hasTable('profiles')  ) {
					$table->foreign('profiles_id')->references('id')->on('profiles');
				}
				if ( Schema::hasTable('permissions')  ) {
					$table->foreign('permissions_id')->references('id')->on('permissions');
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
        Schema::dropIfExists('profile_permissions');
    }
}
