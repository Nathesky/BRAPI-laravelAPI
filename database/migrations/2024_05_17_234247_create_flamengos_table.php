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
        Schema::create('flamengos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('campeonato_id');
            $table->string('tecnico');
            $table->string('titulos');
            $table->string('jogabonito');
            $table->timestamps();

            $table->foreign('campeonato_id')->references('id')->on('campeonatos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flamengos');
    }
};
