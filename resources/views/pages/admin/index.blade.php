@extends('/layout/layout-admin')

@section('/content')
    <div class="container">

        <div id="content">
            <div class="row">
                <div class="col-md-6 offset-3 text-center">
                    <div class="p-2">
                        <a class="btn btn-primary" href="{{ route('admin.products') }}">Termékek</a>
                    </div>
                    <div class="p-2">
                        <a class="btn btn-primary" href="{{ route('admin.countries') }}">Országok</a>
                    </div>
                    <div class="p-2">
                        <a class="btn btn-primary" href="{{ route('admin.shippingMethods') }}">Szállítási módok</a>
                    </div>
                    <div class="p-2">
                        <a class="btn btn-primary">Megrendelések listája</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop
