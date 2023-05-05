<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('sender_id');
            $table->foreign('sender_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            $table->uuid('reciever_id');
            $table->foreign('reciever_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            $table->string('type')->default('info');
            $table->text('message');

            $table->string('status')->default('unread');

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
        Schema::dropIfExists('notifications');
    }
}
