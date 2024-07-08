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
                    <form method="post" action="{{ route('admin.product.edit.post', ['id' => $product->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Név</label>
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                        </div>
                        <div class="form-group pb-6">
                            <label for="email">Ár (Ft)</label>
                            <input type="number" class="form-control" name="price" value="{{ $product->price }}" min="0" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Küldés</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop
