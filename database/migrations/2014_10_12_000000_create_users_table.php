<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('nama');
            $table->string('no_kakitangan');
            $table->string('no_kad_pengenalan');
            $table->string('email')->unique();
            $table->string('kategori_petugas');
            $table->string('tugasan');

            $table->string('no_telefon')->nullable();
            $table->string('stesen')->nullable();
            $table->string('blok')->nullable();
            $table->string('luput_pwd')->nullable();
            $table->string('peranan')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
