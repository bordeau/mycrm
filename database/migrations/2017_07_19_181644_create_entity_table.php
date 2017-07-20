<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entity', function (Blueprint $table) {
			$table->bigIncrements('id');

			$table->string('name', 100);
			$table->string('middlename', 100)->nullable();
            $table->string('email', 200)->nullable()->comment('at least one of email or phone must exist');
			$table->string('phone', 25)->nullable()->comment('at least one of email or phone must exist');
			$table->boolean('active')->default(true);

			$table->enum('type', ['biz-p', 'gov', 'fam', 'biz-np'])->nullable()->comment('biz-p=business for profit, gov=government, fam=family, biz-np=business non-profit, edu should fit into the others');

			$table->bigInteger('created_by_id')->unsigned();
			$table->bigInteger('modified_by_id')->unsigned();

			$table->json('addresses_json')->nullable()->comment('{[ { type: "mailing", address: { street1: "blah", city: "blah", state: "FL"}},{ type: "physical", address: { street1: "blah", city: "blah", state: "FL" }} ]}');

			$table->softDeletes();
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
        Schema::table('entity', function (Blueprint $table) {
			Schema::dropIfExists('entity_entities');
			Schema::dropIfExists('person_entities');
            Schema::dropIfExists('entity');
        });
    }
}
