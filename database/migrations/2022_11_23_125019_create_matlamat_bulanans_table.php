<?php

use App\Models\MatlamatTahunan;
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
        Schema::create('matlamat_bulanans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MatlamatTahunan::class)->constrained()->cascadeOnDelete();
            $table->string('proses');
            $table->string('matlamat');
            $table->string('bulan');
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
        Schema::dropIfExists('matlamat_bulanans');
    }
};
