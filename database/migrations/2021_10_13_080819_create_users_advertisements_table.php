<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_advertisements', function (Blueprint $table) {
            $table->foreignId('id_advertisement')
                    ->constrained('advertisements')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('id_user')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamp('time_from')
                    ->useCurrent();
            $table->timestamp('time_to')
                    ->useCurrent();
            $table->binary('accepted')
                    ->default(0);
            $table->binary('created_user_opinion')
                    ->default(0);
            $table->binary('created_supervisor_opinion')
                    ->default(0);
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
        Schema::dropIfExists('users_advertisements');
    }
}
