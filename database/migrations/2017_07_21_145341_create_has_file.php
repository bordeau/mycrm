<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHasFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasfile', function (Blueprint $table) {
			$table->bigIncrements('id');

			$table->bigInteger('file_id')->unsigned();


			// lookup polymoprhic Eloquent relationships in models
			$table->bigInteger('object_id')->unsigned();
			$table->string( "object_type", 75 );

			$table->bigInteger('created_by_id')->unsigned();
		//	$table->bigInteger('modified_by_id')->unsigned();   // should be only insert/delete

			$table->timestamps();

			$table->foreign('file_id')->references('id')->on('file');
			$table->foreign('created_by_id')->references('id')->on('users');
		//	$table->foreign('modified_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasfile');
    }
}
