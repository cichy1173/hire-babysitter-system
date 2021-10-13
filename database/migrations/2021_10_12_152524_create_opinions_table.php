<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpinionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinions', function (Blueprint $table) {
            $table->id();
            $table->string('content', 500);
            $table->tinyInteger('grade');
            $table->timestamp('create_date')
                    ->useCurrent();
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
        Schema::dropIfExists('opinions');
    }
}
