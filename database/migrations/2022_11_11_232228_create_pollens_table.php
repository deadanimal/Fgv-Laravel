<?php

use App\Models\Pokok;
use App\Models\Tandan;
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
        Schema::create('pollens', function (Blueprint $table) {
            $table->id();
            $table->string('no_pollen')->nullable();
            $table->foreignIdFor(Pokok::class)->nullable();
            $table->foreignIdFor(Tandan::class)->nullable();
            $table->string('masa_masuk_pertama')->nullable();
            $table->string('masa_keluar_pertama')->nullable();
            $table->date('tarikh_ketuk')->nullable();
            $table->string('masa_masuk_kedua')->nullable();
            $table->string('masa_keluar_kedua')->nullable();
            $table->date('tarikh_ayak')->nullable();
            $table->string('berat_pollen')->nullable();
            $table->string('bil_uji')->nullable();
            $table->date('tarikh_uji')->nullable();
            $table->string('masa_uji')->nullable();
            $table->string('viabiliti_pollen')->nullable();
            $table->date('tarikh_qc')->nullable();
            $table->foreignId('pemeriksa_id')->nullable();
            $table->string('catatan_pemeriksa')->nullable();
            $table->foreignId('pengesah_id')->nullable();
            $table->string('catatan_pengesah')->nullable();
            $table->foreignId('id_sv_pollen')->nullable();
            $table->string('status_pollen')->nullable();
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
        Schema::dropIfExists('pollens');
    }
};
