@extends('layouts.main')


@section('content')
    <section id="create-restaurant">
        <form action="{{ route('restaurant.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <div class="container p-5">
                <div class="row mt-3 mb-3">
                    <h3>Registra il tuo ristorante</h3>
                </div>
                <div class="row">
                    <input type="hidden" name="_method" value="POST">
                    <div class="col-lg-6 mb-3">
                        <input name="name" type="text" class="custom-input" id="name" aria-describedby="emailHelp"
                            placeholder="Nome Ristorante">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <input name="p_iva" type="text" class="custom-input" id="p_iva" aria-describedby="emailHelp"
                            placeholder="Partita IVA">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <input name="address" type="text" class="custom-input" id="address" aria-describedby="emailHelp"
                            placeholder="Indirizzo Ristorante">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label for="image" class="form-label">Seleziona l'immagine del ristorante</label>
                        <input name="image" type="file" class="custom-input" id="image">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <p>Seleziona la tipologia di ristorante che stai creando.</p>
                        @foreach ($types as $type)
                            <input class="checkbox-tools" name="types[]" type="checkbox" value="{{ $type['id'] }}"
                                id="{{ $type['id'] }}">
                            <label class="for-checkbox-tools" for="{{ $type['id'] }}">
                                {{ $type['name'] }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-lg-12">
                        <button class="primary-button" type="submit">REGISTRA IL RISTORANTE</button>
                    </div>
                    <div class="col-lg-12">
                        @if ($errors->any())
                            <div class="alert alert-danger mt-5">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
