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
        Schema::create('kualitis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tandan::class)->constrained()->cascadeOnDelete();
            $table->date('tarikh');
            $table->string('petugas');
            $table->string('pengesah');
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
        Schema::dropIfExists('kualitis');
    }
};
