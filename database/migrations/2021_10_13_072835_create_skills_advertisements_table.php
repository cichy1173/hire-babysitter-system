<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills_advertisements', function (Blueprint $table) {
            $table->foreignId('id_skill')
                    ->constrained('skills')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('id_advertisement')
                    ->constrained('advertisements')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->binary('is_deleted');
            $table->primary(['id_skill', 'id_advertisement']);
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
        Schema::dropIfExists('skills_advertisements');
    }
}
