<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if ( Schema::hasTable('purchase_products')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('created_by_id')->references('id')->on('users');
				$table->foreign('modified_by_id')->references('id')->on('users');
			}
			if ( Schema::hasTable('products')  ) {
				$table->foreign('product_id')->references('id')->on('products');
			}
			if ( Schema::hasTable('purchases')  ) {
				$table->foreign('purchase_id')->references('id')->on('purchases');
			}
		}
		else {
	        Schema::table('purchase_products', function (Blueprint $table) {
	            $table->bigIncrements('id');

				$table->bigInteger('product_id')->unsigned();
				$table->bigInteger('purchase_id')->unsigned();
				$table->integer("quantity")->default(0);
				$table->decimal("proposal_price", 17, 2 )->default(0.0);
				$table->integer("build_time")->nullable()->comment("same units a product if applicable");

				$table->bigInteger('created_by_id')->unsigned();
				$table->bigInteger('modified_by_id')->unsigned();

				$table->softDeletes();
	            $table->timestamps();

				if ( Schema::hasTable('users')  ) {
					$table->foreign('created_by_id')->references('id')->on('users');
					$table->foreign('modified_by_id')->references('id')->on('users');
				}
				if ( Schema::hasTable('products')  ) {
					$table->foreign('product_id')->references('id')->on('products');
				}
				if ( Schema::hasTable('purchases')  ) {
					$table->foreign('purchase_id')->references('id')->on('purchases');
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
        Schema::table('purchase_products', function (Blueprint $table) {
            Schema::dropIfExists('purchase_products');
        });
    }
}
