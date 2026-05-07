<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Trigger setelah INSERT (Menambah Karyawan) 
        DB::unprepared("
            CREATE TRIGGER trg_karyawan_insert
            AFTER INSERT ON KARYAWAN
            FOR EACH ROW
            BEGIN
                INSERT INTO TLOG (Tanggal, Jam, Keterangan)
                VALUES (CURDATE(), CURTIME(), CONCAT('INSERT: Menambah karyawan baru bernama ', NEW.Nama));
            END
        ");

        // 2. Trigger setelah UPDATE (Mengubah Data Karyawan) 
        DB::unprepared("
            CREATE TRIGGER trg_karyawan_update
            AFTER UPDATE ON KARYAWAN
            FOR EACH ROW
            BEGIN
                INSERT INTO TLOG (Tanggal, Jam, Keterangan)
                VALUES (CURDATE(), CURTIME(), CONCAT('UPDATE: Mengubah data karyawan ID ', OLD.Id, ' (', OLD.Nama, ')'));
            END
        ");

        // 3. Trigger setelah DELETE (Menghapus Karyawan) 
        DB::unprepared("
            CREATE TRIGGER trg_karyawan_delete
            AFTER DELETE ON KARYAWAN
            FOR EACH ROW
            BEGIN
                INSERT INTO TLOG (Tanggal, Jam, Keterangan)
                VALUES (CURDATE(), CURTIME(), CONCAT('DELETE: Menghapus karyawan bernama ', OLD.Nama));
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_karyawan_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_karyawan_update");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_karyawan_delete");
    }
};
