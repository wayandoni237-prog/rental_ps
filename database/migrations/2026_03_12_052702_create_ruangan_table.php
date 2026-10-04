<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruangan');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_normal', 10, 2);
            $table->decimal('harga_diskon', 10, 2)->nullable();
            $table->integer('persen_diskon')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['tersedia', 'dipesan', 'tidak_tersedia'])->default('tersedia');
            $table->integer('kapasitas')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruangan');
    }
};