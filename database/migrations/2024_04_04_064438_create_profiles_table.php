<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('foto')->nullable();
            $table->string('nama');
            $table->string('no_hp');
            $table->string('nik')->unique()->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat_ktp')->nullable();
            $table->string('domisili')->nullable();
            $table->enum('agama', ['islam', 'kristen', 'katolik', 'hindu', 'budha', 'konghucu'])->nullable();
            $table->enum('status_pernikahan', ['belum menikah', 'menikah', 'cerai'])->nullable();
            $table->string('kontak_darurat')->nullable();
            $table->string('mcu')->nullable();
            $table->string('no_rek_bca')->nullable();
            $table->enum('pendidikan_terakhir', ['sd', 'smp', 'sma', 'd3', 's1', 's2', 's3'])->nullable();
            $table->date('tgl_bergabung')->nullable();
            $table->string('nrp')->nullable();
            $table->string('no_kontrak')->nullable();
            $table->enum('status_kontrak', ['aktif', 'tidak aktif'])->nullable();
            $table->string('lokasi_site')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
