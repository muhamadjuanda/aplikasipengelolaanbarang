<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSkuToBarangTable extends Migration
{
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->string('sku')->after('jenis_barang'); // Menambahkan kolom sku setelah kolom jenis_barang
        });
    }

    public function down()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('sku'); // Menghapus kolom sku jika rollback
        });
    }
}
