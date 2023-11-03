@extends('template.master')
<title>Dashboard</title>
<style>
    .card-footer {
        padding: 25px 0 5px;
        border-top: 1px solid #ddd;
    }

    .card-footer:after,
    .card-footer:before {
        content: '';
        display: table;
    }

    .card-footer:after {
        clear: both;
    }

    .card-footer .wcf-left {
        float: left;

    }

    .card-footer .wcf-right {
        float: right;
    }

    .price {
        font-size: 18px;
        font-weight: bold;
    }

    a.buy-btn {
        display: block;
        color: #fff;
        text-align: center;
        transition: all 0.2s ease-in-out;
    }

    a.buy-btn:hover,
    a.buy-btn:active,
    a.buy-btn:focus {
        border-color: #FF9800;
        background: #FF9800;
        color: #fff;
        text-decoration: none;
    }
    .price-container {
    position: relative;
}

</style>
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
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="d-flex align-items-start justify-content-between">
        <div class="form-inline my-2 my-lg-0">
            <h3>Barang Tersedia</h3>
        </div>
        <div class="form-inline">
            <form action="{{route('home')}}" method="get" class="form-inline my-2 my-lg-0">
                <div class="form-group d-flex align-items-start justify-content-between">
                    <select class="form-control mr-sm-2" name="id_kategori">
                        <option value="" selected>Pilih Kategori</option>
                        @foreach($kategori as $kt)
                        <option value="{{$kt->id}}">{{$kt->nama_kategori}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filter</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row ">
        @foreach($barang as $b)
        <div class="col-lg-3 col-md-6 text-center" id="barangCard">
            <div class="mt-4">
                <div class="card" style="width:250px">
                    <img class="card-img-top" src="{{ asset('gambarproduk/'.$b->img)}}" alt="Card image">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold;" data-toggle="tooltip" data-placement="top" title="">{{$b->nama_barang}}</h5>
                    </div>
                    <div class="card-footer">
                        <div class="wcf-left">
                            @if (auth()->check() && auth()->user()->role == 'Customer_member')
                            <span class="discounted-price">Rp.{{ number_format($b->harga_sewa * 0.9, 2, ',', '.') }}</span>
                            @elseif(auth()->check() && auth()->user()->role == 'Customer')
                            <span class="price">Rp.{{ number_format($b->harga_sewa, 2, ',', '.') }}</span>
                            @endif
                            </div>
                        <div class="wcf-right"><a href="{{ route('detailproduk.customer', ['id' => $b->id]) }}" class="buy-btn btn btn-primary btn-md"><i class="fa-solid fa-cart-shopping"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection