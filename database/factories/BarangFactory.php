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
            'kode_barang' => 'KB' . $this->faker->unique()->numberBetween(1000, 9999),
            'nama_barang' => $this->faker->word,
            'jenis_barang' => $this->faker->randomElement(['Elektronik', 'Pakaian', 'Makanan', 'Perabotan']),
            'sku' => 'SKU-' . $this->faker->unique()->numberBetween(100, 999),
            'satuan' => $this->faker->randomElement(['pcs', 'kg', 'liter']),
            'harga_beli' => $this->faker->numberBetween(1000, 100000),
            'jumlah_stok' => $this->faker->numberBetween(1, 100),
            'foto' => 'photos/img1.png',
        ];
    }
}
