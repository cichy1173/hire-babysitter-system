<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('content', 2000)
                    ->nullable();
            $table->string('photo', 50)
                    ->nullable();
            $table->timestamp('send_date')
                    ->useCurrent();
            $table->binary('read');
            $table->foreignId('from_id_user')
                    ->nullable()
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            $table->foreignId('to_id_user')
                    ->nullable()
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
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
        Schema::dropIfExists('messages');
    }
}
