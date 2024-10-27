@extends('layout')

@section('content')
    <div class="container">
        <div class="card my-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Informasi Barang</h5>
                <a href="{{ route('barang.cetak-pdf', $barang->kode_barang) }}" class="btn btn-primary">Cetak PDF</a>
            </div>

            <div class="card-body">
                <p class="card-text"><strong>Kode Barang:</strong> {{ $barang->kode_barang }}</p>
                <p class="card-text"><strong>Nama Barang:</strong> {{ $barang->nama_barang }}</p>
                <p class="card-text"><strong>Jenis Barang:</strong> {{ $barang->jenis_barang }}</p>
                <p class="card-text"><strong>SKU:</strong> {{ $barang->sku }}</p>
                <p class="card-text"><strong>Satuan:</strong> {{ $barang->satuan }}</p>
                <p class="card-text"><strong>Harga Beli:</strong> Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}
                </p>
                <p class="card-text"><strong>Jumlah Stok:</strong> {{ $barang->jumlah_stok }}</p>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto:</label>
                    @if ($barang->foto)
                        <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto Barang" class="img-fluid"
                            style="max-width: 300px;">
                    @else
                        <p class="text-muted">Tidak ada foto yang diunggah.</p>
                    @endif
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
