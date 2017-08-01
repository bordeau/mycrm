<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if ( Schema::hasTable('products')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('created_by_id')->references('id')->on('users');
				$table->foreign('modified_by_id')->references('id')->on('users');
			}
		}
		else {
	        Schema::table('products', function (Blueprint $table) {
	            $table->bigIncrements('id');
	      			$table->string("name", 255 );
	      			$table->integer("quantity");
	      			$table->decimal("price", 17, 2 );
	      			$table->string( "discount description")->nullable();
	      			$table-double("discount")->nullable();
	      			$table->integer("build_time")->nullable();
	      			$table->enum("build_time_unit", ["day", "hour", "minute"]);

	      			$table->bigInteger('created_by_id')->unsigned();
	      			$table->bigInteger('modified_by_id')->unsigned();

	      			$table->softDeletes();
	                $table->timestamps();

					if ( Schema::hasTable('users')  ) {
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
        Schema::table('products', function (Blueprint $table) {
			Schema::dropIfExists('purchase_products');
            Schema::dropIfExists('products');
        });
    }
}
