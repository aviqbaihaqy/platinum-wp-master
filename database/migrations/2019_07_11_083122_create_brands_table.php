<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('brand_logo');
            $table->string('name');

            $table->timestamps();
        });

        /*Schema::table('products', function (Blueprint $table) {
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('CASCADE');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('brands');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
