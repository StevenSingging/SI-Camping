<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\User;


class AdminController extends Controller
{
    public function index()
    {

        return view('admin.dashboard');
    }

    public function home(Request $request)
    {
        $kategori = Kategori::all();
        $barang = Barang::all();
        $selectedKategori = $request->input('id_kategori');
        $query = Barang::query();

        if ($selectedKategori) {
            $query->where('id_kategori', $selectedKategori);
        }

        $barang = $query->get();

        return view('welcome', compact('barang', 'kategori'));
    }

    public function filterkategori(Request $request)
    {
        $kategori = Kategori::all();
        $selectedKategori = $request->input('id_kategori');
        // Query untuk mendapatkan barang berdasarkan kategori yang dipilih
        $barang = Barang::where('id_kategori', $selectedKategori)->get();
        return $barang;
    }

    public function managetransaksi()
    {
        return view('admin.manage_transaksi');
    }

    public function managekategori()
    {
        $kat = Kategori::paginate();
        return view('admin.manage_kategori', compact('kat'));
    }

    public function tambahkategori(Request $request)
    {
        $kat = new Kategori();
        $kat->nama_kategori = $request->nama_kategori;
        $kat->save();

        $sucess = array(
            'message' => 'Anda berhasil menambah kategori',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($sucess);
    }

    public function updatekategori(Request $request, $id)
    {
        $kat = Kategori::find($id);
        $kat->nama_kategori = $request->nama_kategori;
        $kat->save();

        $sucess = array(
            'message' => 'Anda berhasil mengupdate kategori',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($sucess);
    }

    public function deletekategori(Request $request, $id)
    {
        $kat = Kategori::find($id);
        $kat->delete();

        $sucess = array(
            'message' => 'Anda berhasil menghapus kategori',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($sucess);
    }


    public function managebarang()
    {
        $kat = Kategori::all();
        $barang = Barang::paginate();
        return view('admin.manage_barang', compact('kat', 'barang'));
    }

    public function tambahbarang(Request $request)
    {
        $kat = new Barang();
        $kat->nama_barang = $request->nama_barang;
        $kat->harga_barang = $request->harga_barang;
        $kat->harga_sewa = $request->harga_sewa;
        $kat->qty = $request->qty;
        if ($request->hasFile('img')) {
            $gambar = $request->file('img');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('gambarproduk'), $namaGambar);
            $kat->img = $namaGambar;
        }
        $kat->id_kategori = $request->id_kategori;
        $kat->save();

        $sucess = array(
            'message' => 'Anda berhasil menambah barang',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($sucess);
    }

    public function updatebarang(Request $request, $id)
    {
        $brg = Barang::find($id);
        $brg->nama_barang = $request->nama_barang;
        $brg->harga_barang = $request->harga_barang;
        $brg->harga_sewa = $request->harga_sewa;
        $brg->qty = $request->qty;
        if ($request->hasFile('img')) {
            $gambar = $request->file('img');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('gambarproduk'), $namaGambar);
            $brg->img = $namaGambar;
        }
        $brg->id_kategori = $request->id_kategori;
        $brg->save();

        $sucess = array(
            'message' => 'Anda berhasil mengupdate barang',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($sucess);
    }

    public function deletebarang($id)
    {
        $brg = Barang::find($id);
        $brg->delete();

        $sucess = array(
            'message' => 'Anda berhasil menghapus barang',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($sucess);
    }

    public function manageuser()
    {
        $user = User::where('role', 'Customer')->orWhere('role', 'Customer_member')->paginate();
        return view('admin.manage_user', compact('user'));
    }

    public function updateUserRole(Request $request, $id)
    {

        // Dapatkan data pengguna
        $user = User::find($id);

        if ($user) {
            // Perbarui peran (role) pengguna
            $user->role = $request->role;
            $user->save();

            return response()->json(['message' => 'Peran pengguna diperbarui dengan sukses']);
        } else {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }
    }
}
