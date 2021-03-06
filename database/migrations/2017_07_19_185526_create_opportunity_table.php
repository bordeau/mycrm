<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if ( Schema::hasTable('opportunity')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('owner_id')->references('id')->on('users');
				$table->foreign('created_by_id')->references('id')->on('users');
				$table->foreign('modified_by_id')->references('id')->on('users');
			}
		}
		else {
	        Schema::table('opportunity', function (Blueprint $table) {
				$table->bigIncrements('id');

				$table->string('name', 100);

				$table->enum('status', ['new', 'proposal', 'won', 'lost'])->default('new');
				$table->date('proposal_at')->nullable();
				$table->date('won_lost_at')->nullable();

				$table->bigInteger('owner_id')->unsigned();
				$table->bigInteger('created_by_id')->unsigned();
				$table->bigInteger('modified_by_id')->unsigned();

				$table->softDeletes();
	            $table->timestamps();

				if ( Schema::hasTable('users')  ) {
					$table->foreign('owner_id')->references('id')->on('users');
					$table->foreign('created_by_id')->references('id')->on('users');
					$table->foreign('modified_by_id')->references('id')->on('users');
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
        Schema::table('opportunity', function (Blueprint $table) {
            Schema::dropIfExists('opportunity');
        });
    }
}
