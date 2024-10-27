@extends('layout')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h3>Daftar Barang</h3>
        <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
        <a href="{{ route('cetaksemua') }}" class="btn btn-dark">Cetak Semua Barang</a>

        @if (session('success'))
            <div class="alert alert-success my-2" role="alert">{{ session('success') }}</div>
        @endif

        <table id="barangTable" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>SKU</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                    <th>Jumlah Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>

    <!-- Script DataTables -->
    <script>
        $(document).ready(function() {
            $("#barangTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('barang.index') }}",
                columns: [{
                        data: "nomor_urut", // Kolom nomor urut yang sudah disiapkan di controller
                        name: "nomor_urut",
                    },
                    {
                        data: "kode_barang",
                        name: "kode_barang",
                    },
                    {
                        data: "nama_barang",
                        name: "nama_barang",
                    },
                    {
                        data: "jenis_barang",
                        name: "jenis_barang",
                    },
                    {
                        data: "sku",
                        name: "sku",
                    },
                    {
                        data: "satuan",
                        name: "satuan",
                    },
                    {
                        data: "harga_beli",
                        name: "harga_beli",
                    },
                    {
                        data: "jumlah_stok",
                        name: "jumlah_stok",
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                    },
                ],

                // "rowCallback": function(row, data) {
                //     // Membuat setiap sel di kolom yang diinginkan menjadi link
                //     $(row).find('td').each(function(index) {
                //         // Misalkan kita ingin menjadikan semua sel kecuali kolom aksi sebagai link
                //         if (index <
                //             8) { // Ganti 8 dengan jumlah kolom yang ingin Anda jadikan link
                //             $(this).on('click', function() {
                //                 window.location.href = "{{ url('barang') }}/" + data
                //                     .kode_barang; // Ganti URL sesuai kebutuhan
                //             });
                //         }
                //     });
                // },

                language: {
                    lengthMenu: "Tampilkan _MENU_ entri",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(disaring dari _MAX_ total entri)",
                    search: "Cari:",
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹",
                    },
                },
                columnDefs: [{
                        orderable: true,
                        targets: [0, 1, 2, 3, 4, 5, 6, 7],
                    }, // Kolom yang dapat diurutkan
                    {
                        orderable: false,
                        targets: 8,
                    }, // Kolom aksi tidak dapat diurutkan
                ],
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                searching: true,
                lengthChange: true,
                responsive: true,
            });
        });
    </script>
@endsection
