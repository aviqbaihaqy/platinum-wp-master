<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            $table->string('profile_photo')->default('uploads/profiles_pictures/dummy-profile.jpg');

            $table->string('nip')->nullable();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone');
            $table->string('country_code')->nullable();

            $table->string('company')->nullable();

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
        Schema::dropIfExists('user_details');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
