<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Either midtrans or cash
            $table->string('payment_method');

            $table->uuid('shipping_address_id')->nullable();
            $table->foreign('shipping_address_id')
                ->references('id')
                ->on('shipping_addresses')
                ->onDelete('CASCADE');

            // If midtrans, this shall be filled
            $table->uuid('midtrans_snap_token')->nullable();
            $table->foreign('midtrans_snap_token')
                ->references('snap_token')
                ->on('midtrans')
                ->onDelete('CASCADE');

            // payer
            $table->uuid('payer_id')->nullable();
            $table->foreign('payer_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            $table->string('payer_name')->nullable();

            // payment status
            $table->string('status');

            $table->timestamps();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->onDelete('CASCADE');
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
        Schema::dropIfExists('transactions');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
