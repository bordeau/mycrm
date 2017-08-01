<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if ( Schema::hasTable('entity_entities')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('created_by_id')->references('id')->on('users');
			//	$table->foreign('modified_by_id')->references('id')->on('users');
			}
			if ( Schema::hasTable('entity')  ) {
				$table->foreign('child_entity_id')->references('id')->on('entity');
				$table->foreign('entity_id')->references('id')->on('entity');
			}
		}
		else {
	        Schema::table('entity_entities', function (Blueprint $table) {
	            $table->bigIncrements('id');

				$table->bigInteger('entity_id')->unsigned();
				$table->bigInteger('child_entity_id')->unsigned();

				$table->bigInteger('created_by_id')->unsigned();

				$table->softDeletes();
	            $table->timestamps();

				if ( Schema::hasTable('users')  ) {
					$table->foreign('created_by_id')->references('id')->on('users');
				//	$table->foreign('modified_by_id')->references('id')->on('users');
				}
				if ( Schema::hasTable('entity')  ) {
					$table->foreign('child_entity_id')->references('id')->on('entity');
					$table->foreign('entity_id')->references('id')->on('entity');
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
        Schema::table('entity_entities', function (Blueprint $table) {
            Schema::dropIfExists('entity_entities');
        });
    }
}
