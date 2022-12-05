<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('product.index') }}"
        class="nav-link {{ Request::is('product.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>Product</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('cart') }}"
        class="nav-link {{ Request::is('cart') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cart-shopping"></i>
        <p>Cart</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('print') }}"
        class="nav-link {{ Request::is('print') ? 'active' : '' }}"
        target="_blank">
        <i class="nav-icon fas fa-print"></i>
        <p>Report</p>
    </a>
</li>
