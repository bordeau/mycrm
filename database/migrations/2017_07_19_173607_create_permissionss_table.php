<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if ( Schema::hasTable('permissions')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('created_by_id')->references('id')->on('users');
				$table->foreign('modified_by_id')->references('id')->on('users');
			}
		}
		else {
			Schema::create('permissions', function (Blueprint $table) {
	        	$table->increments('id');
				$table->string('name', 100);

				$table->bigInteger('created_by_id')->unsigned();
				$table->bigInteger('modified_by_id')->unsigned();

	            $table->timestamps();

				if ( Schema::hasTable('users')  ) {
					$table->foreign('created_by_id')->references('id')->on('users');
					$table->foreign('modified_by_id')->references('id')->on('users');
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
        Schema::dropIfExists('permissions');
    }
}
