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
		Schema::create('profile_permissions', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('profiles_id')->unsigned();
			$table->integer('permissions_id')->unsigned();

			$table->timestamps();

			$table->foreign('profiles_id')->references('id')->on('profiles');
			$table->foreign('permissions_id')->references('id')->on('permissions');
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
