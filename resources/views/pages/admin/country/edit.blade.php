@extends('/layout/layout-admin')

@section('/content')
    <div class="container">

        <div id="content">
            @if ($errors->any())
                <div class="row">
                    <div class="col-md-12">
                        <h4>A mentés sikertelen!</h4>
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
            <div class="row">
                <div class="col-md-6 offset-3">
                    <form method="post" action="{{ route('admin.country.edit.post', ['id' => $country->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Név</label>
                            <input type="text" class="form-control" name="name" value="{{ $country->name }}" required>
                        </div>
                        <h4>Szállítási módok</h4>
                        @foreach($shippingMethods as $shippingMethod)
                        <div class="form-check">
                            <label><input type="checkbox" name="shipping_method[]" value="{{ $shippingMethod->id }}" @if(in_array($shippingMethod->id, $countryShippingMethods)) checked @endif> {{ $shippingMethod->name }}</label>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Küldés</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop
