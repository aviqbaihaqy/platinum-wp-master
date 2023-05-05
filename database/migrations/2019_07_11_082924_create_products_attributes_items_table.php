<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsAttributesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_attributes_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('products_attribute_id');
            $table->foreign('products_attribute_id')
                ->references('id')
                ->on('products_attributes')
                ->onDelete('CASCADE');

            $table->string('value');

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
        Schema::dropIfExists('products_attributes_items');
    }
}
