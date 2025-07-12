<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">MAKMOOR APPS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">M</a>
        </div>
        <ul class="sidebar-menu">



            <li class='nav-item'>
                <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-columns"></i>Dashboard</a>
            </li>



            <li class='nav-item'>
                <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-house-user"></i>Users</a>
            </li>

            <li class='nav-item'>
                <a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-product-hunt"></i>Products</a>
            </li>

            <li class='nav-item'>
                <a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-sitemap"></i>Categories</a>
            </li>

            <li class='nav-item'>
                <a class="nav-link" href="{{ route('suppliers.index') }}"><i class="fas fa-users"></i>Suppliers</a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-box"></i><span>Manage Stock</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('products-stocks.create') }}">Tambah/Kurang</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('products-stocks.index') }}">History Stockk</a>
                    </li>
                     <li>
                        <a class="nav-link" href="{{ route('products-stocks-opname.index') }}">Stock OpName</a>
                    </li>
                </ul>
            </li>

</div>
