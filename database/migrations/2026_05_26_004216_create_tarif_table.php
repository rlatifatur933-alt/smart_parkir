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
        Schema::create('tb_tarif', function (Blueprint $table) {
            $table->id('id_test_tarif'); // Sesuai skema gambar: id_tarif
            $table->enum('jenis_kendaraan', ['motor', 'mobil', 'lainnya']);
            $table->decimal('tarif_per_jam', 10, 0);
            $table->timestamps();
        });
        
        // Rename manual jika ingin persis id_tarif di DB
        Schema::table('tb_tarif', function (Blueprint $table) {
            $table->renameColumn('id_test_tarif', 'id_tarif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_tarif');
    }
};
