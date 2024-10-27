<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    protected $model = Barang::class;

    public function definition()
    {
        return [
            'kode_barang' => 'KB' . $this->faker->unique()->numberBetween(1000, 9999), // Contoh kode barang
            'nama_barang' => $this->faker->word, // Bisa ganti dengan text jika ingin lebih panjang
            'jenis_barang' => $this->faker->randomElement(['Elektronik', 'Pakaian', 'Makanan', 'Perabotan']), // Contoh pilihan jenis barang
            'sku' => 'SKU-' . $this->faker->unique()->numberBetween(100, 999), // Contoh SKU
            'satuan' => $this->faker->randomElement(['pcs', 'kg', 'liter']), // Contoh satuan
            'harga_beli' => $this->faker->numberBetween(1000, 100000), // Harga beli
            'jumlah_stok' => $this->faker->numberBetween(1, 100), // Jumlah stok
            'foto' => 'img1.png', // Gunakan foto yang diinginkan
        ];
    }
}
