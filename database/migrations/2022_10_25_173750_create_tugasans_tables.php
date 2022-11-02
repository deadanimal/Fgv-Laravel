<?php

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
        Schema::create('tugasans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tandan::class)->constrained()->cascadeOnDelete();
            $table->string('jenis');
            $table->string('catatan');
            $table->string('status');
            $table->string('tarikh');
            $table->foreignId('petugas_id');
            $table->string('catatan_petugas')->nullable();
            $table->foreignId('pengesah_id')->nullable();
            $table->string('catatan_pengesah')->nullable();
            $table->date('tarikh_pengesahan')->nullable();
            $table->string('url_gambar')->nullable();
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
        Schema::dropIfExists('tugasans');
    }
};
