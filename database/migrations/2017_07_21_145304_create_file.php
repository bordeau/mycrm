<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('file', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string("title", 255 );
			$table-integer( "version" )->default(1)->nullable()->comment("trigger will handle setting the version based on title");
			$table->string("url", 1000 )->nullable()->comment("either url or body must be present");
			$table->binary( "body" )->nullable()->comment("either  is url or body must be present");
			$table->string( "mime", 50 )->nullable()->comment("only with body has value");
			$table->boolean("current_version")->nullable()->default(true);
			$table->enum( "type", ["file", "url"]);

			$table->bigInteger('owner_id')->unsigned();
			$table->bigInteger('created_by_id')->unsigned();
			$table->bigInteger('modified_by_id')->unsigned();

			$table->softDeletes();
			$table->timestamps();

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
        Schema::dropIfExists('file');
    }
}
