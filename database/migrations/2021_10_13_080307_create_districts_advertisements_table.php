<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts_advertisements', function (Blueprint $table) {
            $table->foreignId('id_district')
                    ->constrained('districts')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('id_advertisement')
                    ->constrained('advertisements')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->primary(['id_district', 'id_advertisement']);
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
        Schema::dropIfExists('districts_advertisements');
    }
}
