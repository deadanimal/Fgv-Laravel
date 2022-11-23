<?php

use App\Models\Kerosakan;
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
        Schema::create('data_kerosakans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kerosakan::class);
            $table->string('jenis');
            $table->foreignIdFor(Tandan::class);
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
        Schema::dropIfExists('data_kerosakans');
    }
};
