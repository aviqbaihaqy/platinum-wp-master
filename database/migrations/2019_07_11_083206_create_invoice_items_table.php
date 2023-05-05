<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('invoice_id');
            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('CASCADE');

            $table->uuid('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('CASCADE');

            $table->integer('amount');
            $table->double('total', 20, 2);

            $table->text('note')->nullable();

            $table->string('delivery_status')->default('undelivered');

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
        Schema::dropIfExists('invoice_items');
    }
}
