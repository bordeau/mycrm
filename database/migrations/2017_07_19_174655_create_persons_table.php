<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if ( Schema::hasTable('persons')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('owner_id')->references('id')->on('users');
				$table->foreign('created_by_id')->references('id')->on('users');
				$table->foreign('modified_by_id')->references('id')->on('users');
			}
			DB::unprepared( 'CREATE TRIGGER `persons_BEFORE_INSERT` BEFORE INSERT ON `persons` FOR EACH ROW BEGIN if ( new.`created_at` is null ) then set new.`created_at` = now(); end if; if ( new.`updated_at` is null ) then set new.`updated_at` = now(); end if; END' );
	    	DB::unprepared( 'CREATE TRIGGER `persons_BEFORE_UPDATE` BEFORE UPDATE ON `persons` FOR EACH ROW BEGIN if ( new.`created_at` is null ) then set new.`created_at` = old.`created_at`; end if; if ( new.`updated_at` is null ) then set new.`updated_at` = now(); end if; END' );

		}
		else {
	        Schema::table('persons', function (Blueprint $table) {
	    			$table->bigIncrements('id');

	    			$table->string('firstname', 100);
	    			$table->string('lastname', 100);
	    			$table->string('middlename', 100)->nullable();
	                $table->string('email', 200)->nullable()->comment('at least one of email or phone must exist');
	    			$table->string('phone', 25)->nullable()->comment('at least one of email or phone must exist');
	    			$table->string('mobile', 25)->nullable();
	    			$table->string('salu', 5)->nullable();
	    			$table->string('suffix', 10)->nullable();
	    			$table->boolean('active')->default(true);

	    			$table->bigInteger('owner_id')->unsigned();

	    			$table->string('entityname', 100)->nullable();


	    			$table->enum('type', ['lead', 'person', 'individual'])->default('lead')->comment('lead is pre opporunity; person after opportunity and has entityname, else individual');
	    			$table->enum('status', ['new', 'contacted', 'converted'])->default('new')->comment('status is for when type=lead');
	    			$table->dateTime('converted_at')->nullable();
	    			$table->dateTime('active_changed_at')->nullable();

	    			$table->bigInteger('created_by_id')->unsigned();
	    			$table->bigInteger('modified_by_id')->unsigned();

	    			$table->json('addresses_json')->nullable()->comment('{[ { type: "mailing", address: { street1: "blah", city: "blah", state: "FL"}},{ type: "physical", address: { street1: "blah", city: "blah", state: "FL" }} ]}');

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
		// example creating trigger or stored procedure --- need this minimum for each table if turn off letting Eloquent manage time stamps


	/**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('person_entities');
        Schema::dropIfExists('persons');
    }
}
