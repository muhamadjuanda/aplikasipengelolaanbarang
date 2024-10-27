@extends('layout')

@section('content')
    <h3>Tambah Barang</h3>

    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="form-floating mb-1">
                    <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang"
                        name="kode_barang" placeholder="Kode Barang" value="{{ old('kode_barang') }}">
                    <label for="kode_barang">Kode Barang</label>
                    @error('kode_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-1">
                    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang"
                        name="nama_barang" placeholder="Nama Barang" value="{{ old('nama_barang') }}">
                    <label for="nama_barang">Nama Barang</label>
                    @error('nama_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-1">
                    <input type="text" class="form-control @error('jenis_barang') is-invalid @enderror" id="jenis_barang"
                        name="jenis_barang" placeholder="Jenis Barang" value="{{ old('jenis_barang') }}">
                    <label for="jenis_barang">Jenis Barang</label>
                    @error('jenis_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-1">
                    <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku"
                        name="sku" placeholder="SKU" value="{{ old('sku') }}">
                    <label for="sku">SKU</label>
                    @error('sku')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="form-floating mb-1">
                    <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan"
                        name="satuan" placeholder="Satuan" value="{{ old('satuan') }}">
                    <label for="satuan">Satuan</label>
                    @error('satuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-1">
                    <input type="text" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli"
                        name="harga_beli" placeholder="Harga Beli" value="{{ old('harga_beli') }}">
                    <label for="harga_beli">Harga Beli</label>
                    @error('harga_beli')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-1">
                    <input type="text" class="form-control @error('jumlah_stok') is-invalid @enderror" id="jumlah_stok"
                        name="jumlah_stok" placeholder="Jumlah Stok" value="{{ old('jumlah_stok') }}">
                    <label for="jumlah_stok">Jumlah Stok</label>
                    @error('jumlah_stok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-1">
                    <label for="photo" class="form-label">Foto</label>
                    <input class="form-control @error('photo') is-invalid @enderror" type="file" id="photo"
                        name="photo" accept="image/*" onchange="previewImage(event)">
                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!-- Tempat untuk menampilkan pratinjau gambar -->
                <div id="imagePreview" class="mt-2">
                    <img id="preview" src="#" alt="Preview"
                        style="display: none; max-width: 150px; border: 1px solid #ccc; border-radius:10px;">
                </div>

                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary my-2">Simpan</button>

            </div>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            // Jika ada file yang dipilih
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                // Ketika file selesai dibaca
                reader.onload = function(e) {
                    preview.src = e.target.result; // Mengatur src gambar
                    preview.style.display = 'block'; // Menampilkan gambar
                }

                reader.readAsDataURL(input.files[0]); // Membaca file sebagai data URL
            } else {
                preview.src = '#'; // Reset src jika tidak ada file
                preview.style.display = 'none'; // Sembunyikan gambar
            }
        }
    </script>
@endsection
