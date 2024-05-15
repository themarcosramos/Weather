<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('previsoes', function (Blueprint $table) {
            $table->id();
            $table->string('cidade',128);
            $table->float('temperatura',4);
            $table->integer('codigo_previsao');
            $table->string('descricao',128);
            $table->string('icone',512);
            $table->float('umidade',4);
            $table->float('indice_uv',4);
            $table->float('visibilidade',4);
            $table->dateTime('data_local');
            $table->float('vento',4);
            $table->boolean('dia_noite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('previsoes');
    }
};
