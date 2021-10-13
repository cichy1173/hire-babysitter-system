<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_account_type')
                    ->constrained('account_types')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->foreignId('id_user')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('title', 50);
            $table->string('content', 5000);
            $table->double('hour_rate', 4, 2);
            $table->integer('age_min');
            $table->integer('age_max');
            $table->integer('child_num');
            $table->timestamp('date_from')
                    ->useCurrent();
            $table->timestamp('date_to')
                    ->nullable();
            $table->binary('is_deleted');
            $table->timestamp('supervise_from')
                    ->useCurrent();
            $table->timestamp('supervise_to')
                    ->nullable();
            $table->index(['id_user', 'title']);
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
        Schema::dropIfExists('advertisements');
    }
}
