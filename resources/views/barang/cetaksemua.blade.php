<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Semua Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #888;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <h1>Daftar Semua Barang</h1>
    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>SKU</th>
                <th>Satuan</th>
                <th>Harga Beli</th>
                <th>Jumlah Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $item)
                <tr>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jenis_barang }}</td>
                    <td>{{ $item->sku }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>{{ number_format($item->harga_beli, 2, ',', '.') }}</td>
                    <td>{{ $item->jumlah_stok }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        <p>Copyright &copy; 2024 - Aplikasi Pengelolaan Barang</p>
    </footer>
</body>

</html>
