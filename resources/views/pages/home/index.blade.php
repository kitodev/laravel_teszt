@extends('/layout/layout')

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
                    <form action="" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Termék választás</label>
                            <select class="form-control" name="products[]" multiple required>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Teljes név</label>
                            <input type="text" class="alphabetical-only form-control" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-check">
                            <label>
                                <input type="radio" class="form-check-input" name="sex" value="1" @if(old('sex') && old('sex') == 1) checked @endif required> Férfi
                            </label>
                        </div>
                        <div class="form-check">
                            <label>
                                <input type="radio" class="form-check-input" name="sex" value="2" @if(old('sex') && old('sex') == 2) checked @endif required> Nő
                            </label>
                        </div>
                        <div class="form-group">
                            <label>E-mail cím</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Telefonszám</label>
                            <input type="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Életkor</label>
                            <input type="number" name="age" class="number-only form-control" value="{{ old('age') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Ország</label>
                            <select name="country" class="form-control" id="countryAjax" autocomplete="none" required>
                                <option value="" selected disabled>Kérem válasszon...</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h5>Szállítási mód</h5>
                        <div id="country-selector">
                            <p>Kérem válasszon először országot</p>
                        </div>
                        <div class="form-group">
                            <img src="{{ captcha_src() }}" alt="captcha">
                            <div class="mt-2"></div>
                            <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror"
                                placeholder="Kérem gépelje be a fenti karaktereket!">
                            @error('captcha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" disabled>Regisztráció</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop
