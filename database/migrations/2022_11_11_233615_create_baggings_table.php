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
        Schema::create('baggings', function (Blueprint $table) {
            $table->id();
            $table->string('no_bagging')->nullable();
            $table->foreignIdFor(Pokok::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tandan::class)->constrained()->cascadeOnDelete();
            $table->string('url_gambar')->nullable();
            $table->foreignId('id_sv_balut')->nullable();
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('baggings');
    }
};
