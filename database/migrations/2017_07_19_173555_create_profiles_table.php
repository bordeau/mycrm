<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  		Schema::create('profiles', function (Blueprint $table) {
          	$table->increments('id');
      			$table->string('name', 100);
      			$table->boolean('default')->default(false);

      			$table->bigInteger('created_by_id')->unsigned();
      			$table->bigInteger('modified_by_id')->unsigned();

                  $table->timestamps();

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
        Schema::dropIfExists('profiles');
    }
}
