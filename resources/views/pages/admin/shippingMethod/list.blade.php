@extends('/layout/layout-admin')

@section('/content')
    <div class="container">

        <div id="content">
            <div class="row">
                <div class="col-md-12 p-3">
                    <a href="{{ route('admin.country.create') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Ország hozzáadása</a>
                </div>
            </div>
            @if ($errors->any())
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            @if(\Session::has('success'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Név
                                </th>
                                <th>
                                    Szerkesztés
                                </th>
                                <th>
                                    Törlés
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($shippingMethods && !$shippingMethods->isEmpty())
                                @foreach($shippingMethods as $shippingMethod)
                                <tr>
                                    <td>{{ $shippingMethod->id }}</td>
                                    <td>{{ $shippingMethod->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.shippingMethod.edit', ['id' => $shippingMethod->id]) }}" class="btn btn-primary">Szerkesztés</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.shippingMethod.delete', ['id' => $shippingMethod->id]) }}" class="btn btn-danger">Törlés</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center">Nem áll rendelkezésre adat!</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@stop
