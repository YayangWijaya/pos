<ul class="sidebar-links pt-5" id="simple-bar">
    <li class="back-btn"></li>
    <li class="sidebar-list">
      <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard') }}">
        <i class="ri-home-line"></i>
        <span>Dashboard</span>
      </a>
    </li>
    @if (auth()->user()->role === 0)
    <li class="sidebar-list">
      <a class="sidebar-link sidebar-title link-nav" href="{{ route('product.index') }}">
        <i class="ri-store-3-line"></i>
        <span>Data Produk</span>
      </a>
    </li>
    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title link-nav" href="{{ route('inventory.index') }}">
          <i class="ri-archive-line"></i>
          <span>Stok Barang</span>
        </a>
      </li>
    <li class="sidebar-list d-none">
      <a class="sidebar-link sidebar-title link-nav" href="{{ route('user.index') }}">
      <i class="ri-user-3-line"></i>
      <span>Users</span>
      </a>
    </li>
    <li class="sidebar-list">
      <a class="sidebar-link sidebar-title link-nav" href="{{ route('transaction.index') }}">
      <i class="ri-exchange-dollar-line"></i>
      <span>Data Transaksi</span>
      </a>
    </li>
    <li class="sidebar-list d-none">
      <a class="sidebar-link sidebar-title link-nav" href="javascript:void(0)">
      <i class="ri-settings-line"></i>
      <span>Settings</span>
      </a>
    </li>
    @endif
  </ul>
