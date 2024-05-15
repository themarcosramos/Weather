<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('condicoes_climaticas', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->string('descricao');
            $table->timestamps();
        });
        
        DB::table('condicoes_climaticas')->insert([
            ['codigo' => 395, 'descricao' => 'Neve moderada ou forte na área com trovoadas'],
            ['codigo' => 392, 'descricao' => 'Neve leve na área com trovoadas'],
            ['codigo' => 389, 'descricao' => 'Chuva moderada ou forte na área com trovoadas'],
            ['codigo' => 386, 'descricao' => 'Chuva fraca na área com trovoadas'],
            ['codigo' => 377, 'descricao' => 'Chuvas moderadas ou fortes de pedaços de gelo'],
            ['codigo' => 374, 'descricao' => 'Chuvas leves de pedaços de gelo'],
            ['codigo' => 371, 'descricao' => 'Nevascas moderadas ou fortes'],
            ['codigo' => 368, 'descricao' => 'Nevascas leves'],
            ['codigo' => 365, 'descricao' => 'Chuvas de saraiva moderadas ou fortes'],
            ['codigo' => 362, 'descricao' => 'Chuvas de saraiva leves'],
            ['codigo' => 359, 'descricao' => 'Chuva torrencial'],
            ['codigo' => 356, 'descricao' => 'Chuva moderada ou forte'],
            ['codigo' => 353, 'descricao' => 'Chuva leve'],
            ['codigo' => 350, 'descricao' => 'Pedras de gelo'],
            ['codigo' => 338, 'descricao' => 'Neve pesada'],
            ['codigo' => 335, 'descricao' => 'Neve pesada intermitente'],
            ['codigo' => 332, 'descricao' => 'Neve moderada'],
            ['codigo' => 329, 'descricao' => 'Neve moderada intermitente'],
            ['codigo' => 326, 'descricao' => 'Neve leve'],
            ['codigo' => 323, 'descricao' => 'Neve leve intermitente'],
            ['codigo' => 320, 'descricao' => 'Chuva de saraiva moderada ou forte'],
            ['codigo' => 317, 'descricao' => 'Chuva de saraiva leve'],
            ['codigo' => 314, 'descricao' => 'Chuva congelante moderada ou forte'],
            ['codigo' => 311, 'descricao' => 'Chuva congelante leve'],
            ['codigo' => 308, 'descricao' => 'Chuva forte'],
            ['codigo' => 305, 'descricao' => 'Chuva forte às vezes'],
            ['codigo' => 302, 'descricao' => 'Chuva moderada'],
            ['codigo' => 299, 'descricao' => 'Chuva moderada às vezes'],
            ['codigo' => 296, 'descricao' => 'Chuva leve'],
            ['codigo' => 293, 'descricao' => 'Chuva leve intermitente'],
            ['codigo' => 284, 'descricao' => 'Garoa congelante intensa'],
            ['codigo' => 281, 'descricao' => 'Garoa congelante'],
            ['codigo' => 266, 'descricao' => 'Garoa leve'],
            ['codigo' => 263, 'descricao' => 'Garoa leve intermitente'],
            ['codigo' => 260, 'descricao' => 'Nevoeiro congelante'],
            ['codigo' => 248, 'descricao' => 'Nevoeiro'],
            ['codigo' => 230, 'descricao' => 'Tempestade de neve'],
            ['codigo' => 227, 'descricao' => 'Neve soprada'],
            ['codigo' => 200, 'descricao' => 'Surto de tempestades nas proximidades'],
            ['codigo' => 185, 'descricao' => 'Garoa congelante intermitente nas proximidades'],
            ['codigo' => 182, 'descricao' => 'Garoa intermitente nas proximidades'],
            ['codigo' => 179, 'descricao' => 'Neve intermitente nas proximidades'],
            ['codigo' => 176, 'descricao' => 'Chuva intermitente nas proximidades'],
            ['codigo' => 143, 'descricao' => 'Névoa'],
            ['codigo' => 122, 'descricao' => 'Nublado'],
            ['codigo' => 119, 'descricao' => 'Nublado'],
            ['codigo' => 116, 'descricao' => 'Parcialmente Nublado'],
            ['codigo' => 113, 'descricao' => 'Céu Limpo/Ensolarado']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condicoes_climaticas');
    }
};
