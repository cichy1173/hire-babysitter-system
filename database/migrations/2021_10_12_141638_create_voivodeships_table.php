<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoivodeshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voivodeships', function (Blueprint $table) {
            $table->id();
            $table->string('voivodeship_name', 50)
                    ->unique();
            $table->foreignId('id_country')
                    ->constrained('countries')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->timestamps();
            $table->index('voivodeship_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voivodeships');
    }
}
