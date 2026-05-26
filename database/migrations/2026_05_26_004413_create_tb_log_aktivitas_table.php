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
        Schema::create('tb_log_aktivitas', function (Blueprint $table) {
            $table->id('id_log');
            
            // Foreign Key ke tb_user
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('tb_user')->onDelete('cascade');
            
            $table->string('aktivitas', 100);
            $table->dateTime('waktu_aktivitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_log_aktivitas');
    }
};
