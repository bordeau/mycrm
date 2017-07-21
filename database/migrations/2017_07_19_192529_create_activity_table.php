<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity', function (Blueprint $table) {
            $table->bigIncrements('id');

			$table->string('subject', 255 );
			$table->longtext('body' );
			$table->dateTime('start_date');
			$table->boolean('reminder')->default(true);

			// look at polymorphic relations in the Eloquent relations section
			$table->bigInteger('what_id')->unsigned()->nullable()->comment('can be an opportunity or other what undefined now');
			$table->bigInteger('who_id')->unsigned()->nullable()->comment('can be a person, entity, or person_entities');

			$table->enum('status', ['new', 'completed'])->default('new');
			$table->enum('type', ['call', 'email', 'meeting', 'other'])->nullable();

			$table->bigInteger('owner_id')->unsigned();
			$table->bigInteger('created_by_id')->unsigned();
			$table->bigInteger('modified_by_id')->unsigned();

            $table->timestamps();

		//	$table->foreign('what_id')->references('id')->on('opportunity');
		//	$table->foreign('who_id')->references('id')->on('persons');
		//	$table->foreign('who_id')->references('id')->on('person_entities');
		//	$table->foreign('who_id')->references('id')->on('entity');
			$table->foreign('owner_id')->references('id')->on('users');
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
        Schema::table('activity', function (Blueprint $table) {
			Schema::dropIfExists('activity_users');
            Schema::dropIfExists('activity');
        });
    }
}
