@extends('layout')

@section('content')
    <h3>Edit Barang</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-3 row">
                    <label for="kode_barang" class="col-sm-4 col-form-label">Kode Barang:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                            value="{{ old('kode_barang', $barang->kode_barang) }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_barang" class="col-sm-4 col-form-label">Nama Barang:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                            value="{{ old('nama_barang', $barang->nama_barang) }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="jenis_barang" class="col-sm-4 col-form-label">Jenis Barang:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="jenis_barang" name="jenis_barang"
                            value="{{ old('jenis_barang', $barang->jenis_barang) }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="sku" class="col-sm-4 col-form-label">SKU:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="sku" name="sku"
                            value="{{ old('sku', $barang->sku) }}">
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3 row">
                    <label for="satuan" class="col-sm-4 col-form-label">Satuan:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="satuan" name="satuan"
                            value="{{ old('satuan', $barang->satuan) }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="harga_beli" class="col-sm-4 col-form-label">Harga Beli:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="harga_beli" name="harga_beli"
                            value="{{ old('harga_beli', $barang->harga_beli) }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="jumlah_stok" class="col-sm-4 col-form-label">Jumlah Stok:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="jumlah_stok" name="jumlah_stok"
                            value="{{ old('jumlah_stok', $barang->jumlah_stok) }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="foto" class="col-sm-4 col-form-label">Foto:</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" id="foto" name="photo" accept="image/*"
                            onchange="previewPhoto()">
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview Foto Saat Ini dan Foto Baru -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Foto Saat Ini:</label><br>
                @if ($barang->foto)
                    <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto Barang" style="max-height: 200px;">
                @else
                    <p>Tidak ada foto yang diunggah.</p>
                @endif
            </div>
            <div class="col-md-6">
                <label for="preview" class="form-label">Preview Foto Baru:</label>
                <img id="preview" src="#" alt="Preview Foto" style="display: none; max-height: 200px;">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </form>

    <script>
        function previewPhoto() {
            const input = document.getElementById('foto');
            const preview = document.getElementById('preview');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
