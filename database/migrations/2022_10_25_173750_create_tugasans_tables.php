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
            $table->string('aktiviti');
            $table->string('status');
            $table->string('tarikh');
            $table->foreignId('pengesah_id')->nullable();
            $table->date('tarikh_pengesahan')->nullable();
            $table->foreignId('petugas_id');
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
        Schema::dropIfExists('tugasan');
    }
};
