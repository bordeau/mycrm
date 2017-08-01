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
		if ( Schema::hasTable('hasfile')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('created_by_id')->references('id')->on('users');
			//	$table->foreign('modified_by_id')->references('id')->on('users');
			}
			if ( Schema::hasTable('file')  ) {
				$table->foreign('file_id')->references('id')->on('file');
			}
		}
		else {
	        Schema::table('hasfile', function (Blueprint $table) {
				$table->bigIncrements('id');

				$table->bigInteger('file_id')->unsigned();


				// lookup polymoprhic Eloquent relationships in models --- looks like polymoprhic is in the model vs. migration
				$table->bigInteger('object_id')->unsigned();
				$table->string( "object_type", 75 );

				$table->bigInteger('created_by_id')->unsigned();
			//	$table->bigInteger('modified_by_id')->unsigned();   // should be only insert/delete

				$table->timestamps();

				if ( Schema::hasTable('users')  ) {
					$table->foreign('created_by_id')->references('id')->on('users');
				//	$table->foreign('modified_by_id')->references('id')->on('users');
				}
				if ( Schema::hasTable('file')  ) {
					$table->foreign('file_id')->references('id')->on('file');
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
        Schema::dropIfExists('hasfile');
    }
}
