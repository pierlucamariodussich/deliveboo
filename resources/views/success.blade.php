@extends('layouts.main')


@section('content')
    <section id="success">
        <div class="container-fluid p-5">
            <div class="row">
                <div class="offset-lg-3 col-lg-6 justify-content-center align-items-center">
                    <h1 class="mb-5">{{ $item }}</h1>
                    @if (($item == 'Hai creato con successo il tuo ristorante.') || ($item == 'Le modifiche sono state effettuate con successo.'))
                        <a href="{{ route('restaurant.show', Auth::User()->getRestaurant->id) }}" class="primary-button">VAI ALLA DASHBOARD</a>
                    @endif
                </div>
            </div>
        </div>

    </section>
@endsection
