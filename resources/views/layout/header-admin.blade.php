<div class="container header">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-collapse collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Frontend</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">Admin oldal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.products') }}">Termékek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.countries') }}">Országok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.shippingMethods') }}">Szállítási módok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders') }}">Megrendelések listája</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
