<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks_records', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('CASCADE');

            $table->string('event');
            $table->integer('amount');

            $table->text('details');

            $table->uuid('executor_id');
            $table->foreign('executor_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

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
        Schema::dropIfExists('stocks_records');
    }
}
