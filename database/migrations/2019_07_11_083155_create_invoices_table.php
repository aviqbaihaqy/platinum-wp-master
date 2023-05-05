<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            // If the user ID does not exist, fill this instead
            $table->string('client_name')->nullable();

            $table->string('invoice_code');
            $table->double('discount', 20, 2)->default(0);
            $table->double('grand_total', 20, 2);

            $table->uuid('transaction_id')->nullable();

            $table->uuid('shipping_id')->nullable();
            $table->foreign('shipping_id')
                ->references('id')
                ->on('shippings')
                ->onDelete('CASCADE');

            $table->uuid('inputter_id')->nullable();
            $table->foreign('inputter_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
            $table->string('sales_name')->nullable();

            $table->string('status')->default('unpaid');
            $table->datetime('payment_due');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('invoices');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
