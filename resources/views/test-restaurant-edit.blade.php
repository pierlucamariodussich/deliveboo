@extends('layouts.main')


@section('content')
    <section id="restaurant-edit">
        <form action="{{ route('restaurant.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="container p-5">
                <div class="row mt-3 mb-3">
                    <h3>Modifica il tuo ristorante</h3>
                </div>
                <div class="row">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="col-lg-6 mb-3">
                        <input name="name" type="text" class="custom-input" id="name" aria-describedby="emailHelp"
                            placeholder="Nome Ristorante" value="{{ $restaurant->name }}">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <input name="p_iva" type="text" class="custom-input" id="p_iva" aria-describedby="emailHelp"
                            placeholder="Partita IVA" value="{{ $restaurant->p_iva }}">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <input name="address" type="text" class="custom-input" id="address" aria-describedby="emailHelp"
                            placeholder="Indirizzo Ristorante" value="{{ $restaurant->address }}">
                    </div>
                    <div class=" col-lg-12 mb-3">
                        <label for="image" class="form-label">Seleziona l'immagine del ristorante</label>
                        <input name="image" type="file" class="custom-input" id="image">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <p>Modifica la tipologia di ristorante</p>
                        @foreach ($types as $type)
                            <input class="checkbox-tools" name="types[]" type="checkbox" value="{{ $type['id'] }}"
                                id="{{ $type['id'] }}" @foreach ($restaurant->getTypes as $item)  @if ($item->id==$type['id'])
                            checked @endif
                        @endforeach
                        >
                        <label class="for-checkbox-tools" for="{{ $type['id'] }}">
                            {{ $type['name'] }}
                        </label>
                        @endforeach
                    </div>
                    <div class="col-lg-12">
                        <button class="primary-button" type="submit">APPLICA LE MODIFICHE</button>
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
{{-- <div class="container">
        <div class="row ">
            <div class="col-10  mt-5 d-flex flex-wrap justify-content-center ">
                <form action="{{ route('restaurant.update', $restaurant->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="_method" value="PUT">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Ristorante</label>
                        <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Indirizzo</label>
                        <input name="address" type="text" class="form-control" id="address" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="p_iva" class="form-label">Partita IVA</label>
                        <input name="p_iva" type="text" class="form-control" id="p_iva" aria-describedby="emailHelp">
                    </div>



                    <div class="mb-3">
                        <label for="image" class="form-label">image</label>
                        <input name="image" type="file" class="form-control" id="image">

                    </div>


                    <div class="mb-3 form-check">
                        @foreach ($types as $type)


                            <div class="form-check ">
                                <input class="form-check-input" name="types[]" type="checkbox" value="{{ $type['id'] }}"
                                    id="type">
                                <label class="form-check-label" for="type">
                                    {{ $type['name'] }}
                                </label>
                            </div>

                        @endforeach

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-5">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div> --}}
