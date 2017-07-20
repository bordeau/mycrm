<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunityUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunity_users', function (Blueprint $table) {
			$table->bigIncrements('id');

			$table->bigInteger('opportunity_id')->unsigned();
			$table->integer('users_id')->unsigned();
			$table->string('role', 100)->comment('role on opportunity team');
			$table->double('split', 6, 3)->nullabe();

			$table->bigInteger('created_by_id')->unsigned();
			$table->bigInteger('modified_by_id')->unsigned();

            $table->timestamps();

			$table->foreign('opportunity_id')->references('id')->on('opportunity');
			$table->foreign('users_id')->references('id')->on('users');
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
        Schema::table('opportunity_users', function (Blueprint $table) {
            Schema::dropIfExists('opportunity_users');
        });
    }
}
