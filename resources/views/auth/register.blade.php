@extends('layouts.main')

@section('content')
<section id="register">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="container p-5">
            <div class="row">
                <h3>Registrati</h3>
            </div>
            <div class="row">
                <div class="col-lg-6 mt-3 mb-3">
                    <input type="text" name="name" id="name" class="custom-input @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-lg-6 mt-3 mb-3">
                    <input id="surname" type="text" class="custom-input @error('surname') is-invalid @enderror"
                        name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus
                        placeholder="Cognome">

                    @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-12 mb-3">
                    <input id="email" type="email" class="custom-input @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" placeholder="Indirizzo E-Mail">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-6 mb-3">
                    <input id="password" type="password" class="custom-input @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-6 mb-3">
                    <input id="password-confirm" type="password" class="custom-input" name="password_confirmation" required
                        autocomplete="new-password" placeholder="Conferma Password">
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="primary-button">
                        REGISTRATI
                    </button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection
