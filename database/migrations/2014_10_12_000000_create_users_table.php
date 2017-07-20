<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 100)->unique();
			$table->string('firstname', 100);
			$table->string('lastname', 100);
            $table->string('email', 200);
            $table->string('password', 100)->nullable();

			$table->boolean('active')->default(false);
			$table->boolean('frozen')->default(false);
			$table->boolean('system_mgr')->default(false);
			$table->boolean('password_reset')->default(false);

			$table->dateTime('password_reset_at')->nullable();
			$table->dateTime('password_changed_at')->nullable();
			$table->dateTime('lastlogin_at')->nullable();

			$table->integer('profile_id')->unsigned();
			$table->bigInteger('manager_id')->unsigned();

			$table->bigInteger('created_by_id')->unsigned();
			$table->bigInteger('modified_by_id')->unsigned();

			$table->softDeletes();
            $table->rememberToken();
            $table->timestamps();


			$table->foreign('profile_id')->references('id')->on('profiles');
			$table->foreign('manager_id')->references('id')->on('users');
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
		Schema::dropIfExists('opportunity_users');
        Schema::dropIfExists('users');
    }
}
