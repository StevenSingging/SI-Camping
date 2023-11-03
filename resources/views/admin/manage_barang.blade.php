@extends('template.master')
<title>Manage Barang</title>
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Beranda</a></li>
                    <li class="breadcrumb-item active">Manage Barang</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambah"><span class="fa-solid fa-plus" aria-hidden="true"></span> Tambah Data</button>
            <table id="barang" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Nama Barang
                        </th>
                        <th>
                            Harga Barang
                        </th>
                        <th>
                            Harga Sewa/Hari
                        </th>
                        <th>
                            Qty
                        </th>
                        <th>
                            Gambar
                        </th>
                        <th>
                            Kategori
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($barang as $brg)
                    <tr>
                        <td scope="row">{{ $no++ + ($barang->currentPage() - 1) * $barang->perPage() }}</td>
                        <td>{{$brg->nama_barang}}</td>
                        <td>{{$brg->harga_barang}}</td>
                        <td>{{$brg->harga_sewa}}</td>
                        <td>{{$brg->qty}}</td>
                        <td><img src="{{asset('gambarproduk/'.$brg->img)}}" alt="" style="width: 100px;"></td>
                        <td>{{$brg->id_kategori}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$brg->id}}"><span class="fa-solid fa-pen-to-square" aria-hidden="true"></span></button>
                            <a class="btn btn-danger btn-sm" role="button" href="{{route('deletebarang.admin', $brg->id)}}"><span class="fa-solid fa-trash" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="edit{{$brg->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('updatebarang.admin',$brg->id)}}" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nama Barang</label>
                                            <input type="text" class="form-control" name="nama_barang" value="{{$brg->nama_barang}}" placeholder="Nama Barang" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Harga Barang</label>
                                            <input type="number" class="form-control" name="harga_barang" value="{{$brg->harga_barang}}" placeholder="Harga Barang" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Harga Sewa</label>
                                            <input type="number" class="form-control" name="harga_sewa" value="{{$brg->harga_sewa}}" placeholder="Harga Sewa" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Qty</label>
                                            <input type="number" class="form-control" name="qty" value="{{$brg->qty}}" placeholder="Qty" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Gambar</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="img">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputGroupSelect04">Kategori</label>
                                            <select class="custom-select" name="id_kategori">
                                                <option selected>Choose...</option>
                                                @foreach($kat as $kt)
                                                <option value="{{$kt->id}}" @if($kt->id == $brg->id_kategori) selected @endif>{{$kt->nama_kategori}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade " id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('tambahbarang.admin')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Harga Barang</label>
                            <input type="number" class="form-control" name="harga_barang" placeholder="Harga Barang" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Harga Sewa</label>
                            <input type="number" class="form-control" name="harga_sewa" placeholder="Harga Sewa" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Qty</label>
                            <input type="number" class="form-control" name="qty" placeholder="Qty" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="img">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputGroupSelect04">Kategori</label>
                            <select class="custom-select" name="id_kategori">
                                <option selected>Choose...</option>
                                @foreach($kat as $kt)
                                <option value="{{$kt->id}}">{{$kt->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
    $(function() {
        $('#barang').DataTable({
            "dom": '<"top"i>rt<"bottom"p><"clear">',
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 10,
        });
    });
</script>
@endsection