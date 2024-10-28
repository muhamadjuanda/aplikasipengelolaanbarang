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

    <!-- Static Modal for Error Notification -->
    <div class="modal fade" id="errorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="errorModalLabel">Error</h1>
                </div>
                <div class="modal-body">
                    <p>Sesi Anda telah berakhir. Silahkan login terlebih dahulu.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="redirectLoginButton">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#barangTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('barang.index') }}",
                    error: function(xhr) {
                        if (xhr.status === 401) { // Status 401 menunjukkan Unauthorized (sesi berakhir)
                            // Show modal on unauthorized access
                            $("#errorModal").modal('show');
                        } else {
                            alert("Terjadi kesalahan saat mengambil data. Silakan coba lagi nanti.");
                        }
                    }
                },
                columns: [{
                        data: "nomor_urut",
                        name: "nomor_urut"
                    },
                    {
                        data: "kode_barang",
                        name: "kode_barang"
                    },
                    {
                        data: "nama_barang",
                        name: "nama_barang"
                    },
                    {
                        data: "jenis_barang",
                        name: "jenis_barang"
                    },
                    {
                        data: "sku",
                        name: "sku"
                    },
                    {
                        data: "satuan",
                        name: "satuan"
                    },
                    {
                        data: "harga_beli",
                        name: "harga_beli"
                    },
                    {
                        data: "jumlah_stok",
                        name: "jumlah_stok"
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                    }
                ],
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
                        targets: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    {
                        orderable: false,
                        targets: 8
                    },
                ],
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                searching: true,
                lengthChange: true,
                responsive: true,
            });

            // Redirect to login page when the close button is clicked
            $("#redirectLoginButton").on("click", function() {
                window.location.href = "{{ route('login') }}"; // Redirect to login page
            });
        });
    </script>
@endsection
