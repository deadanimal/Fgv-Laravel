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
        Schema::create('quality_controls', function (Blueprint $table) {
            $table->id();
            $table->string('no_qc')->nullable();
            $table->foreignIdFor(Pokok::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tandan::class)->constrained()->cascadeOnDelete();
            $table->string('status_bunga')->nullable();
            $table->string('status_qc')->nullable();
            $table->foreignId('id_sv_qc')->nullable();
            $table->string('url_gambar')->nullable();
            $table->string('catatan')->nullable();
            $table->string('jum_bagging')->nullable();
            $table->string('jum_bagging_lulus')->nullable();
            $table->string('jum_bagging_rosak')->nullable();
            $table->string('peratus_rosak')->nullable();
            $table->foreignId('pengesah_id')->nullable();
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
        Schema::dropIfExists('quality_controls');
    }
};
