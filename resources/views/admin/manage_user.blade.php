@extends('template.master')
<title>Manage User</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <li class="breadcrumb-item active">Manage User</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <table id="user" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            No WA
                        </th>
                        <th>
                            Role
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($user as $us)
                    <tr>
                        <td scope="row">{{ $no++ + ($user->currentPage() - 1) * $user->perPage() }}</td>
                        <td>{{$us->name}}</td>
                        <td>{{$us->email}}</td>
                        <td>{{$us->nowa}}</td>
                        <td>{{$us->role}}</td>
                        <td>
                            <form action="{{ route('updaterole.admin', ['id' => $us->id]) }}" method="post">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <select class="custom-select" id="roleSelect_{{ $us->id }}" name="role" style="width: 170px;">
                                        <option selected>Choose...</option>
                                        <option value="Customer" @if($us->role == 'Customer') selected @endif>Customer</option>
                                        <option value="Customer_member" @if($us->role == 'Customer_member') selected @endif>Customer Member</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
    $(function() {
        $('#user').DataTable({
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
<script>
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    // Handle select change event
    $(document).on('change', '#roleSelect_{{ $us->id }}', function() {
        var userId = {{ $us->id }};
        var selectedRole = $(this).val();

        // Send AJAX request to update user's role
        $.ajax({
            url: '/updateUserRole/admin/' + userId, // Ganti dengan URL yang sesuai di server
            method: 'POST',
            data: {
            userId: userId,
            role: selectedRole,
            _token: csrfToken, // Kirim token CSRF dalam data
            },
            success: function(response) {
                console.log('success');
            },
            error: function(xhr, status, error) {
                console.log('error');
            }
        });
    });
</script>
@endsection