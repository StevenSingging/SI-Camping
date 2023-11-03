@extends('template.master')
<title>Detail Barang</title>
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.customer')}}">Beranda</a></li>
                    <li class="breadcrumb-item active">Detail Barang</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <img class="card-img-top" src="{{ asset('gambarproduk/'.$barangd->img)}}" alt="" style="width: 100%;">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;" data-toggle="tooltip" data-placement="top" title="">{{$barangd->nama_barang}}</h3>
                </div>
                <div class="card-body">
                    @if (auth()->check() && auth()->user()->role == 'Customer_member')
                    <p>Rp.{{ number_format($barangd->harga_sewa * 0.9, 2, ',', '.') }} / hari</p>
                    @elseif(auth()->check() && auth()->user()->role == 'Customer')
                    <p>Rp.{{ number_format($barangd->harga_sewa, 2, ',', '.') }} / hari</p>
                    @endif
                    <h3>Stok Tersisa: {{$barangd->qty}}</h3>
                    <form action="{{route('simpantransaksi.customer',$barangd->id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal Pesan</label>
                            <input type="date" class="form-control" name="tgl_pesan">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal Kembali</label>
                            <input type="date" class="form-control" name="tgl_kembali">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Total Bayar</label>
                            <input type="integer" class="form-control" id="total_bayar" name="total_bayar" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jaminan</label>
                            <select class="form-control" name="jenis_jaminan">
                                <option value="" selected>Pilih Jaminan</option>
                                <option value="KTP">KTP</option>
                                <option value="SIM">SIM</option>
                                <option value="KTM">KTM</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Foto Jaminan</label>
                            <input type="file" class="form-control-file" name="foto_jaminan">
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
<script>
    // Ambil elemen input jumlah dan total bayar
    var inputJumlah = document.getElementById('jumlah');
    var inputTotalBayar = document.getElementById('total_bayar');

    var hargaSewa; // Definisikan variabel hargaSewa di luar blok if

    @if (auth()->check() && auth()->user()->role == 'Customer_member')
        hargaSewa = @json($barangd->harga_sewa * 0.9);
    @elseif(auth()->check() && auth()->user()->role == 'Customer')
        hargaSewa = @json($barangd->harga_sewa);
    @endif

    // Tambahkan event listener saat nilai input jumlah berubah
    inputJumlah.addEventListener('input', function() {
        // Ambil nilai jumlah dan konversi ke angka (integer)
        var jumlah = parseInt(inputJumlah.value);

        // Hitung total bayar
        var totalBayar = hargaSewa * jumlah; // Gunakan hargaSewa yang sudah ditentukan

        // Setel nilai total bayar pada input total bayar
        inputTotalBayar.value = totalBayar;
    });
</script>
@endsection