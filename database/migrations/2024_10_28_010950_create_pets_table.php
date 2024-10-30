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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->text('foto');
            $table->string('especie');
            $table->string('cor', 20);
            $table->string('sexo', 20);
            $table->string('raca', 30)->nullable();
            $table->integer('peso');
            $table->date('data_de_aniversario')->nullable();
            $table->text('vacinas')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
