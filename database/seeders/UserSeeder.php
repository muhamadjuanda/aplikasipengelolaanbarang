<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID'); // Menggunakan bahasa Indonesia

        // Menginsert 100 data
        for ($i = 0; $i < 100; $i++) {
            DB::table('barang')->insert([
                'kode_barang' => $faker->unique()->numerify('BRG-####'),
                'nama_barang' => $faker->word,
                'jenis_barang' => $faker->word,
                'sku' => $faker->word,
                'satuan' => $faker->randomElement(['pcs', 'kg', 'liter']),
                'harga_beli' => $faker->numberBetween(10000, 500000),
                'jumlah_stok' => $faker->numberBetween(1, 100),
                'foto' => 'images/img1.png', // Menggunakan img1.png untuk semua entri
            ]);
        }
    }
}
