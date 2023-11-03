<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>One Page Wonder - Start Bootstrap Template</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container px-5">
            <a class="navbar-brand" href="#page-top">SI Camping</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#daftar-barang">Daftar Barang</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Daftar</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login">Log In</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="masthead text-center text-white">
        <div class="masthead-content">
            <div class="container px-5">
                <h1 class="masthead-heading mb-0">One Page Wonder</h1>
                <h2 class="masthead-subheading mb-0">Will Rock Your Socks Off</h2>
                <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">Learn More</a>
            </div>
        </div>
    </header>
    <!-- Content section 1-->
    <section id="daftar-barang">

        <h2 class="text-center mt-5">Barang Sewa</h2>


        <div class="container">
            <div class="d-flex align-items-start justify-content-between">
                <div class="form-inline my-2 my-lg-0"></div>
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
                        <div class="card" style="width:270px">
                            <img class="card-img-top" src="{{ asset('gambarproduk/'.$b->img)}}" alt="Card image">
                            <div class="card-body">
                                <h5 class="card-title" data-toggle="tooltip" data-placement="top" title="">{{$b->nama_barang}}</h5>
                                <p class="card-text"> Rp. {{number_format($b->harga_sewa, 2, ',', '.')}} / Hari</p>
                                @if($b->qty > 0 && $b->qty<=5) <span class="badge badge-warning">Hampir Habis</span>
                                    @elseif($b->qty > 5)
                                    <span class="badge badge-success">Tersedia</span>
                                    @else
                                    <span class="badge badge-secondary">Tidak Tersedia</span>
                                    @endif

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- Content section 2-->
    <!-- Footer-->
    <footer class="py-5 bg-black">
        <div class="container px-5">
            <p class="m-0 text-center text-white small">Copyright &copy; SI CAMPING 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_kategori').on('change', function() {
                var selectedKategori = $(this).val();
                // Kirim permintaan AJAX ke server untuk mendapatkan barang berdasarkan kategori
                $.ajax({
                    url: '/filterkategori', // Ganti dengan URL yang sesuai di server
                    type: 'GET',
                    data: {
                        id_kategori: selectedKategori
                    },
                    success: function(response) {
                        // Bersihkan konten di dalam #barangContainer
                        $('#barangContainer').html('');

                        // Tambahkan barang yang sesuai ke dalam #barangContainer
                        $.each(response, function(index, barang) {
                            var html = '<div class="row ">';
                            html += '<div class="col-lg-3 col-md-6 text-center">';
                            html += '<div class="mt-4">';
                            html += '<div class="card" style="width:270px">';
                            html += '<img class="card-img-top" src="{{ asset('
                            gambarproduk / ') }}/' + barang.img + '" alt="Card image">';
                            html += '<div class="card-body">';
                            html += '<h5 class="card-title" data-toggle="tooltip" data-placement="top" title="' + barang.nama_barang + '">' + barang.nama_barang + '</h5>';
                            html += '<p class="card-text">Rp. ' + parseFloat(barang.harga_sewa).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' / Hari</p>';

                            if (barang.qty > 0 && barang.qty <= 5) {
                                html += '<span class="badge badge-warning">Hampir Habis</span>';
                            } else if (barang.qty > 5) {
                                html += '<span class="badge badge-success">Tersedia</span>';
                            } else {
                                html += '<span class="badge badge-secondary">Tidak Tersedia</span>';
                            }

                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';

                            $('#barangContainer').append(html);
                        });
                        $('#barangCard').append(html);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>


</html>