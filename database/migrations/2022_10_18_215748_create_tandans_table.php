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
        Schema::create('tandans', function (Blueprint $table) {
            $table->id();
            $table->char('no_daftar', 128)->nullable();
            $table->foreignId('pokok_id')->constrained('pokoks')->cascadeOnDelete();

            $table->char('kitaran', 128)->nullable();
            $table->char('deskripsi_kitaran', 128)->nullable();
            $table->char('status_tandan', 128)->nullable();
            $table->char('catatan', 128)->nullable();
            $table->integer('umur')->nullable();

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
        Schema::dropIfExists('tandans');
    }
};
