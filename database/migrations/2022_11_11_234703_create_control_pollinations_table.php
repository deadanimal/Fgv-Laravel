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
        Schema::create('control_pollinations', function (Blueprint $table) {
            $table->id();
            $table->string('no_cp')->nullable();
            $table->foreignIdFor(Pokok::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tandan::class)->constrained()->cascadeOnDelete();
            $table->integer('bil_pemeriksaan')->nullable();
            $table->integer('tambahan_hari')->nullable();
            $table->string('no_pollen')->nullable();
            $table->string('peratus_pollen')->nullable();
            $table->foreignId('id_sv_cp')->nullable();
            $table->string('url_gambar')->nullable();
            $table->string('catatan')->nullable();
            $table->string('pengesah_id')->nullable();
            $table->string('catatan_pengesah')->nullable();
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
        Schema::dropIfExists('control_pollinations');
    }
};
