<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_approval', function (Blueprint $table) {
			$table->bigIncrements('id');

			$table->string("step", 100);
			$table->enum( "status", ["new", "approved", "rejected"] );
			$table->enum( "type", ["proposal", "sale"] );
			$table->longtext("status_comment")->nullable();
			$table->bigInteger('assigned_approver_id')->unsigned();
			$table->bigInteger('purchase_id')->unsigned();
			$table->bigInteger('created_by_id')->unsigned();
			$table->bigInteger('modified_by_id')->unsigned();

            $table->timestamps();

			$table->foreign('purchase_id')->references('id')->on('purchases');
			$table->foreign('assigned_approver_id')->references('id')->on('users');
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
        Schema::table('purchase_approval', function (Blueprint $table) {
            Schema::dropIfExists('purchase_approval');
        });
    }
}
