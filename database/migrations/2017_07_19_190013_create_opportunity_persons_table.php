<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunityPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if ( Schema::hasTable('opportunity_persons')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('created_by_id')->references('id')->on('users');
				$table->foreign('modified_by_id')->references('id')->on('users');
			}
			if ( Schema::hasTable('opportunity')  ) {
				$table->foreign('opportunity_id')->references('id')->on('opportunity');
			}
			if ( Schema::hasTable('person_entities')  ) {
				$table->foreign('person_entities_id')->references('id')->on('person_entities');
			}
			if ( Schema::hasTable('person')  ) {
				$table->foreign('person_id')->references('id')->on('person');
			}
		}
		else {
	        Schema::table('opportunity_persons', function (Blueprint $table) {
	            $table->bigIncrements('id');

	      			$table->bigInteger('person_entities_id')->unsigned()->nullable()->comment('1 of person_entities_id or person_id must have a value');
	      			$table->bigInteger('person_id')->unsigned()->nullable()->comment('1 of person_entities_id or person_id must have a value');
	      			$table->bigInteger('opportunity_id')->unsigned();
	      			$table->string('role', 100)->comment('role in opportunity');

	      			$table->bigInteger('created_by_id')->unsigned();
	      			$table->bigInteger('modified_by_id')->unsigned();

	      			$table->softDeletes();
	                  $table->timestamps();

					if ( Schema::hasTable('users')  ) {
  						$table->foreign('created_by_id')->references('id')->on('users');
  						$table->foreign('modified_by_id')->references('id')->on('users');
  					}
  					if ( Schema::hasTable('opportunity')  ) {
  						$table->foreign('opportunity_id')->references('id')->on('opportunity');
  					}
  					if ( Schema::hasTable('person_entities')  ) {
  						$table->foreign('person_entities_id')->references('id')->on('person_entities');
  					}
  					if ( Schema::hasTable('person')  ) {
  						$table->foreign('person_id')->references('id')->on('person');
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
        Schema::table('opportunity_persons', function (Blueprint $table) {
            Schema::dropIfExists('opportunity_persons');
        });
    }
}
