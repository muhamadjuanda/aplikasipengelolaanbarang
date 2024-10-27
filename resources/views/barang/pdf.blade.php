<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Detail Barang</h1>
    <table class="table">
        <tr>
            <th>Kode Barang</th>
            <td>{{ $barang->kode_barang }}</td>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <td>{{ $barang->nama_barang }}</td>
        </tr>
        <tr>
            <th>Jenis Barang</th>
            <td>{{ $barang->jenis_barang }}</td>
        </tr>
        <tr>
            <th>SKU</th>
            <td>{{ $barang->sku }}</td>
        </tr>
        <tr>
            <th>Satuan</th>
            <td>{{ $barang->satuan }}</td>
        </tr>
        <tr>
            <th>Harga Beli</th>
            <td>{{ $barang->harga_beli }}</td>
        </tr>
        <tr>
            <th>Jumlah Stok</th>
            <td>{{ $barang->jumlah_stok }}</td>
        </tr>
    </table>
</body>

</html>
