<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if ( Schema::hasTable('purchases')  ) {
			if ( Schema::hasTable('users')  ) {
				$table->foreign('created_by_id')->references('id')->on('users');
				$table->foreign('modified_by_id')->references('id')->on('users');
			}
			if ( Schema::hasTable('opportunity')  ) {
				$table->foreign('opportunity_id')->references('id')->on('opportunity');
			}
			if ( Schema::hasTable('persons')  ) {
					$table->foreign('persons_id')->references('id')->on('persons');
			}
		}
		else {
		        Schema::table('purchases', function (Blueprint $table) {
					$table->bigIncrements('id');

					$table->bigInteger('opportunity_id')->unsigned();
					$table->dateTime("offerdate");
					$table->dateTime("solddate")->nullable();
					$table->enum("type", ["proposal", "purchase"])->default("proposal")->comment("until approved its a proposal");
					$table->boolean("complete")->default(false);
					$table->decimal("total_price", 17, 2 )->default(0.00)->comment("this is going to be roll-up from purchase_products");
					$table->enum( "fullfillment_status", ["processing", "building", "setup", "test", "shipping", "shipped", "installed", "complete"])->nullable()->comment("null while proposal");
					$table->date("target_delivery_date")->nullable();
					$table->date("start_date")->nullable();
					$table->enum("proposal_status", ["new", "in review", "approval pending", "cancelled", "approved"]);
					$table->bigInteger('entity_id')->unsigned()->nullable()->comment("only nullable if purchaser is indvidual");
					$table->bigInteger('persons_id')->unsigned()->nullable()->comment("not nullable if purchaser is indvidual, else can be primary customer contact");

					$table->bigInteger('created_by_id')->unsigned();
					$table->bigInteger('modified_by_id')->unsigned();

					$table->softDeletes();
		            $table->timestamps();

					if ( Schema::hasTable('users')  ) {
						$table->foreign('created_by_id')->references('id')->on('users');
						$table->foreign('modified_by_id')->references('id')->on('users');
					}
					if ( Schema::hasTable('opportunity')  ) {
						$table->foreign('opportunity_id')->references('id')->on('opportunity');
					}
					if ( Schema::hasTable('persons')  ) {
							$table->foreign('persons_id')->references('id')->on('persons');
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
        Schema::table('purchases', function (Blueprint $table) {
			Schema::dropIfExists('purchase_approval');
			Schema::dropIfExists('purchase_products');
            Schema::dropIfExists('purchases');
        });
    }
}
