<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $barang = Barang::where('qty', '>=', 0)->get();
        $kategori = Kategori::all();

        return view('customer.dashboard', compact('barang', 'kategori'));
    }

    public function detailproduk($id)
    {
        $barangd = Barang::find($id);

        return view('customer.data-barang', compact('barangd'));
    }

    public function simpantransaksi(Request $request, $id)
    {
        $barangd = Barang::find($id);

        if (!$barangd) {
            return redirect()->back()->with([
                'message' => 'Barang tidak ditemukan.',
                'alert-type' => 'error'
            ]);
        }

        $jumlah = $request->input('jumlah');

        if ($jumlah > $barangd->qty) {
            return redirect()->back()->with([
                'message' => 'Anda gagal melakukan transaksi karena jumlah tidak sesuai.',
                'alert-type' => 'error'
            ]);
        }

        // Hitung total bayar
        $totalBayar = $jumlah * $barangd->harga_sewa;

        $transaksi = new Transaksi();
        $transaksi->user_id = auth()->user()->id;
        $transaksi->id_barang = $barangd->id; // Pastikan id_barang disimpan dengan benar
        $transaksi->jumlah = $jumlah;
        $transaksi->tgl_pesan = $request->tgl_pesan;
        $transaksi->tgl_kembali = $request->tgl_kembali;
        $transaksi->total_bayar = $totalBayar; // Simpan total bayar yang sudah dihitung
        $transaksi->jenis_jaminan = $request->jenis_jaminan;

        if ($request->hasFile('foto_jaminan')) {
            $gambar = $request->file('foto_jaminan');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('jaminan'), $namaGambar);
            $transaksi->foto_jaminan = $namaGambar;
        }

        $transaksi->save();

        $barangd->qty =  $barangd->qty - $jumlah;
        $barangd->save();

        return redirect()->back()->with([
            'message' => 'Anda berhasil melakukan transaksi',
            'alert-type' => 'success'
        ]);
    }
}
