<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if ( Schema::hasTable('emails')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('created_by_id')->references('id')->on('users');
				$table->foreign('modified_by_id')->references('id')->on('users');
			}
		}
		else {
			Schema::table('emails', function (Blueprint $table) {
	        	$table->bigIncrements('id');
				$table->string("subject");
				$table->longtext("body");
				$table->bigInteger("from_user")->unsigned();
				$table->json("to_person_email_json")->comment("{[{name:'Joe Blow': email:'Jb@test.com' }]}");

				// look at polymorphic relations in the Eloquent relations section
				$table->bigInteger("related_id")->unsigned()->nullable()->commment("can be an other table relation, must specify related_type");
				$table->enum("related_type", ["opportunity", "entity", "persons"])->nullable();

				$table->integer('created_by_id')->unsigned();

				$table->softDeletes();
	            $table->timestamps();

				if ( Schema::hasTable('users')  ) {
					$table->foreign('from_user')->references('id')->on('users');
					$table->foreign('created_by_id')->references('id')->on('users');
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
		Schema::table('emails', function (Blueprint $table) {
            Schema::dropIfExists('emails');
        });
    }
}
