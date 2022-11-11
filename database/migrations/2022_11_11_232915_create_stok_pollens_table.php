<?php

use App\Models\Pollen;
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
        Schema::create('stok_pollens', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pollen::class)->constrained()->cascadeOnDelete();
            $table->integer('amaun_keluar')->nullable();
            $table->integer('amaun_kembali')->nullable();
            $table->integer('amaun_semasa')->nullable();
            $table->string('dicipta_oleh')->nullable();
            $table->string('dikemaskini_oleh')->nullable();
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
        Schema::dropIfExists('stok_pollens');
    }
};
