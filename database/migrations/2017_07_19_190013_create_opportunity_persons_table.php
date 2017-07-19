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
        Schema::table('opportunity_persons', function (Blueprint $table) {
            $table->bigIncrements('id');

			$table->bigInteger('person_entities_id')->unsigned();
			$table->bigInteger('opportunity_id')->unsigned();
			$table->string('role', 100)->comment('role in opportunity');

			$table->integer('created_by_id')->unsigned();
			$table->integer('modified_by_id')->unsigned();

            $table->timestamps();

			$table->foreign('opportunity_id')->references('id')->on('opportunity');
			$table->foreign('person_entities_id')->references('id')->on('person_entities');
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
        Schema::table('opportunity_persons', function (Blueprint $table) {
            Schema::dropIfExists('opportunity_persons');
        });
    }
}
