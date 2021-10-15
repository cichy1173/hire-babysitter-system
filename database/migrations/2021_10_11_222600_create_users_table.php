<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_account_type')
                    ->constrained('account_types')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->string('name', 40);
            $table->string('surname', 50);
            $table->string('nickname', 15)
                    ->unique()
                    ->nullable();
            $table->string('email')
                    ->unique();
            $table->timestamp('email_verified_at')
                    ->nullable();
            $table->string('password', 128);
            $table->string('salt', 128)
                        ->default('12345');
            $table->string('photo', 50)
                    ->nullable();
            $table->float('reputation', 2, 1);
            $table->string('about', 3000)
                    ->nullable();
            $table->string('schedule', 50)
                    ->nullable();
            $table->tinyInteger('is_blocked')
                        ->default(0);
            $table->timestamp('blocked_to')
                    ->nullable();
            $table->tinyInt('is_deleted')
                        ->default(0);
            $table->tinyInteger('require_pass_reset')
                    ->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->index(['id', 'nickname', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
