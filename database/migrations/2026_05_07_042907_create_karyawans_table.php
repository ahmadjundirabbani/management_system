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
        Schema::create('KARYAWAN', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Nama', 150);
            $table->date('Tgl Lahir');
            $table->decimal('Gaji', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('KARYAWAN');
        Schema::dropIfExists('TLOG');
    }
};
