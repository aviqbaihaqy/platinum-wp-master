<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('product_code')->unique();

            $table->string('name');
            $table->string('uri');
            $table->double('buying_price', 20, 2)->default(0);
            $table->double('price', 20, 2)->default(0);

            $table->uuid('subcategory_id');
            $table->foreign('subcategory_id')
                ->references('id')
                ->on('subcategories')
                ->onDelete('CASCADE');

            $table->uuid('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('CASCADE');

            $table->string('status')->default('available');
            $table->text('description')->nullable();

            $table->integer('is_favourite')->default(0);

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
        Schema::dropIfExists('products');
    }
}
