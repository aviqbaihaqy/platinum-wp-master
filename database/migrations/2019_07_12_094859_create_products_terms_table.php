<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_terms', function (Blueprint $table) {
            $table->uuid('id');

            $table->uuid('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('CASCADE');

            $table->string('warranty_unit');

            $table->text('warranty_terms');

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
        Schema::dropIfExists('products_terms');
    }
}
