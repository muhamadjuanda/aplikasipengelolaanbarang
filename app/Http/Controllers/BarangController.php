<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // PDF
use Yajra\DataTables\DataTables; // DataTables
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    // // Menampilkan daftar barang (Read) secara langsung
    // public function index()
    // {
    //     $barang = Barang::all();
    //     return view('barang.index', compact('barang')); // views/barang/index.blade.php
    // }

    // Menampilkan daftar barang (Read) secara ajax
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Mengambil data barang dari database
            $data = Barang::select('id', 'kode_barang', 'nama_barang', 'jenis_barang', 'sku', 'satuan', 'harga_beli', 'jumlah_stok')
                ->orderBy('id', 'ASC') // Optional: Atur urutan default
                ->get(); // Mengambil datanya

            // Menambahkan nomor urut secara manual
            $data = $data->map(function ($item, $key) {
                $item->nomor_urut = $key + 1; // Menambahkan nomor urut
                return $item;
            });

            // Menggunakan DataTables untuk memproses data
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    // Mengatur tombol aksi (lihat, edit, hapus)
                    $btn = '<a href="' . route('barang.show', $row->kode_barang) . '" class="btn btn-sm btn-outline-info">
                        <i class="bi bi-eye lg" aria-hidden="true"></i><span class="visually-hidden">Lihat</span>
                    </a>';
                    $btn .= ' <a href="' . route('barang.edit', $row->id) . '" class="btn btn-sm btn-outline-warning">
                        <i class="bi bi-pencil g"></i><span class="visually-hidden">Edit</span>
                    </a>';
                    $btn .= ' <form action="' . route('barang.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash3 lg"></i><span class="visually-hidden">Hapus</span>
                        </button>
                      </form>';
                    return $btn;
                })
                ->addColumn('nomor_urut', function ($row) {
                    return $row->nomor_urut; // Tambahkan nomor urut ke DataTables
                })
                ->rawColumns(['action'])
                ->make(true); // Menghasilkan respons JSON untuk DataTables
        }

        return view('barang.index');
    }



    // Menampilkan form untuk menambahkan barang baru (Create)
    public function create()
    {
        return view('barang.create'); // views/barang/create.blade.php
    }

    // Menyimpan data barang yang baru ditambahkan (Create)
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang|max:50',
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'sku' => 'required',
            'satuan' => 'required|max:20',
            'harga_beli' => 'required|numeric',
            'jumlah_stok' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk foto
        ]);

        // Membuat instance model barang baru
        $barang = Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'sku' => $request->sku,
            'satuan' => $request->satuan,
            'harga_beli' => $request->harga_beli,
            'jumlah_stok' => $request->jumlah_stok,
        ]);

        // Proses upload foto jika ada
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('photos', $filename, 'public');
            $barang->foto = $path; // Simpan path ke dalam database
            $barang->save(); // Simpan perubahan
        }

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan data barang berdasarkan kode_barang (Read)
    public function show($kode_barang)
    {
        // Menggunakan kode_barang untuk mencari barang
        $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();
        return view('barang.show', compact('barang')); // views/barang/show.blade.php
    }

    // Menampilkan form untuk mengedit data barang (Update)
    public function edit($id)
    {
        // Cek apakah referrer berasal dari halaman daftar barang
        $referrer = request()->headers->get('referer');
        if (!$referrer || !str_contains($referrer, route('barang.index'))) {
            return redirect()->route('barang.index')->with('error', 'Akses tidak diizinkan.');
        }

        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang')); // views/barang/edit.blade.php
    }

    // Menyimpan perubahan data barang (Update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|max:50|unique:barang,kode_barang,' . $id,
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'sku' => 'required',
            'satuan' => 'required|max:20',
            'harga_beli' => 'required|numeric',
            'jumlah_stok' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk foto
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'sku' => $request->sku,
            'satuan' => $request->satuan,
            'harga_beli' => $request->harga_beli,
            'jumlah_stok' => $request->jumlah_stok,
        ]);

        // Proses upload foto jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($barang->foto) {
                Storage::delete('public/' . $barang->foto);
            }

            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('photos', $filename, 'public');
            $barang->foto = $path; // Simpan path foto ke dalam database
            $barang->save(); // Simpan perubahan
        }

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    // Menghapus data barang (Delete)
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus foto jika ada
        if ($barang->foto) {
            Storage::delete('public/' . $barang->foto);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }

    // Fungsi untuk cetak data barang ke PDF
    public function cetakPDF($kode_barang)
    {
        // Cari barang berdasarkan kode_barang
        $barang = Barang::where('kode_barang', $kode_barang)->firstOrFail();

        // Siapkan data untuk dikirim ke view
        $data = [
            'title' => 'Detail Barang - ' . $barang->nama_barang,
            'barang' => $barang,
        ];

        // Muat tampilan PDF dan kirim data ke tampilan
        $pdf = Pdf::loadView('barang.pdf', $data);

        // Menghasilkan file PDF
        return $pdf->download('detail-barang-' . $barang->kode_barang . '.pdf');
    }

    public function cetaksemua()
    {
        $barang = Barang::all(); // Ambil semua data barang dari database

        // Siapkan data untuk dikirim ke view
        $data = [
            'title' => 'Daftar Semua Barang',
            'barang' => $barang,
        ];

        // Muat tampilan PDF dan kirim data ke tampilan
        $pdf = Pdf::loadView('barang.cetaksemua', $data);

        // Menghasilkan file PDF
        return $pdf->download('daftar-barang.pdf');
    }
}
