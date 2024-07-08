@extends('/layout/layout-admin')

@section('/content')
    <div class="container">

        <div id="content">
            <div class="row">
                <div class="col-md-12 p-3">
                    <a href="{{ route('admin.orders.export') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Export</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table dataTable" id="orders-table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Név
                                </th>
                                <th>
                                    E-mail
                                </th>
                                <th>
                                    Kor
                                </th>
                                <th>
                                    Nem
                                </th>
                                <th>
                                    Szállítási mód
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders && !$orders->isEmpty())
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->age }}</td>
                                        <td>{{ $order->sex == 1 ? 'Férfi' : 'Nő' }}</td>
                                        <td>{{ $order->shippingMethod->name }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Nem áll rendelkezésre adat!</td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Név
                                </th>
                                <th>
                                    E-mail
                                </th>
                                <th>
                                    Kor
                                </th>
                                <th>
                                    Nem
                                </th>
                                <th>
                                    Szállítási mód
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>

@stop
