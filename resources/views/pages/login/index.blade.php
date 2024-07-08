@extends('/layout/layout')

@section('/content')
    <div class="container">

        <div id="content">
            <div class="row">
                <div class="col-md-6 offset-3">
                    <form method="post" action="{{ route('login.post') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Felhasználónév</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group pb-6">
                            <label for="email">Jelszó</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Küldés</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop
