<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Tembakau Shop</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">TS</a>
    </div>
    <ul class="sidebar-menu">
      @role('Admin')
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
        </li>
        <li class="menu-header">Master Data</li>
        <li class="{{ Request::routeIs('admin.customer*') ? 'active' : '' }}"">
            <a class="nav-link" href="{{ route('admin.customer') }}"><i class="fas fa-users"></i> <span>Data Customer</span></a>
        </li>
        <li class="{{ Request::routeIs('admin.product*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('admin.product') }}"><i class="fas fa-shopping-bag"></i> <span>Data Produk</span></a>
        </li>
        <li class="{{ Request::routeIs('order*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('order') }}"><i class="fas fa-money-bill"></i> <span>Data Order</span></a>
        </li>
      @endrole
      @role('User')
        <li class="menu-header">Menu</li>
        <li class="{{ Request::routeIs('user.product*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.product') }}"><i class="fas fa-shopping-bag"></i> <span>Produk</span></a>
        </li>
        <li class="{{ Request::routeIs('order*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('order') }}"><i class="fas fa-list"></i> <span>History Transaksi</span></a>
        </li>
      @endrole
    </ul>
</aside>