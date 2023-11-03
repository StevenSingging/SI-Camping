<li class="nav-header">MAIN NAVIGATION</li>
@if(auth()->user()->role == "Admin")
<li class="nav-item">
      <a href="{{route('dashboard.admin')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('managebarang.admin')}}" class="nav-link {{ (request()->segment(1) == 'manage_barang') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-campground"></i>
        <p>
          Manage Barang

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('managekategori.admin')}}" class="nav-link {{ (request()->segment(1) == 'manage_kategori') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Manage Kategori

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('manageuser.admin')}}" class="nav-link {{ (request()->segment(1) == 'manage_user') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Manage User

        </p>
      </a>
</li>
<li class="nav-item">
      <a href="{{route('managetransaksi.admin')}}" class="nav-link {{ (request()->segment(1) == 'manage_transaksi') ? 'active' : '' }}">
        <i class="nav-icon fas fa-money-bill"></i>
        <p>
          Manage Transaksi

        </p>
      </a>
</li>
@endif
@if(auth()->user()->role == "Customer" || auth()->user()->role == "Customer_member")
<li class="nav-item">
      <a href="{{route('dashboard.customer')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard

        </p>
      </a>
</li>
@endif
<li class="nav-item">
      <a href="{{route('logout')}}" class="nav-link" onclick="return confirm('Apakah Anda yakin akan logout ?')">
        <i class="nav-icon fas fa-right-from-bracket"></i>
        <p>
          Logout

        </p>
      </a>
</li>
