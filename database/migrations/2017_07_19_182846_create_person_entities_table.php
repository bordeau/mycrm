<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if ( Schema::hasTable('person_entities')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('created_by_id')->references('id')->on('users');
				$table->foreign('modified_by_id')->references('id')->on('users');
			}
			if ( Schema::hasTable('persons')  ) {
				$table->foreign('person_id')->references('id')->on('persons');
			}
			if ( Schema::hasTable('entity')  ) {
				$table->foreign('entity_id')->references('id')->on('entity');
			}
		}
		else {
	        Schema::table('person_entities', function (Blueprint $table) {
				$table->bigIncrements('id');

				$table->bigInteger('person_id')->unsigned();
				$table->bigInteger('entity_id')->unsigned();
				$table->boolean('active')->default(true);
				$table->boolean('primary_person')->default(false)->comment('is person primary person for entity');
				$table->boolean('primary_entity')->default(false)->comment('is entity primary entity for person');

	            $table->string('email', 200)->nullable();
				$table->string('phone', 25)->nullable();
				$table->string('mobile', 25)->nullable();

				$table->string('role', 200)->nullable();


				$table->bigInteger('created_by_id')->unsigned();
				$table->bigInteger('modified_by_id')->unsigned();

				$table->json('addresses_json')->nullable()->comment('{[ { type: "mailing", address: { street1: "blah", city: "blah", state: "FL"}},{ type: "physical", address: { street1: "blah", city: "blah", state: "FL" }} ]}');

				$table->softDeletes();
	            $table->timestamps();

				if ( Schema::hasTable('users')  ) {
					$table->foreign('created_by_id')->references('id')->on('users');
					$table->foreign('modified_by_id')->references('id')->on('users');
				}
				if ( Schema::hasTable('persons')  ) {
					$table->foreign('person_id')->references('id')->on('persons');
				}
				if ( Schema::hasTable('entity')  ) {
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
        Schema::table('person_entities', function (Blueprint $table) {
            Schema::dropIfExists('person_entities');
        });
    }
}
