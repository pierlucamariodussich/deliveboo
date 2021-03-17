@extends('layouts.main')


@section('content')
    <section id="show-dish">



        <div class="container p-5">
            <div class="row ">
                <div class=" imgContainer col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-start align-items-center ">
                    <img id="dish-show-img" src="/img/restaurant/{{ $dish->image_url }}" alt="{{ $dish->name }}">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex flex-column justify-content-center align-items-start edit-container">
                    <div class="media-margin">
                        <h3>Nome del piatto</h3>
                        <p>{{ $dish->name }}</p>
                    </div>
                    <div class="media-margin">
                        <h3>Categoria</h3>
                        <p>{{ $dish->getGenre->name }}</p>
                    </div>
                    <div class="media-margin">
                        <h3>Prezzo</h3>
                        <h5>{{ $dish->price }} €</h5>
                    </div>
                    <div class="media-margin">
                        <h3>Descrizione</h3>
                        <p id="desc">{{ $dish->description }}</p>
                    </div>
                    <div>
                        <h3>Disponibilità</h3>
                        @if ($dish->visibility == '0')
                            <p>Il piatto non è disponibile per l'acquisto.</p>
                        @else
                            <p>Il piatto è disponibile per l'acquisto.</p>
                        @endif
                    </div>
                </div>
                <div class=" col-xs-6 col-sm-6 col-md-6 col-lg-6  col-xl-6  d-flex flex-column justify-content-end align-items-start">
                    <a class="primary-button d-flex justify-content-center align-items-center btn btns" href="{{ route('dishes.edit', $dish->id) }}">
                        <img id="icon-dish-show" src="/img/dashboard/icon/edit-little.png" alt="" />
                        MODIFICA PIATTO
                    </a>
                    <form class="d-flex justify-content-center align-items-center" method="POST" action="{{ route('dishes.destroy', $dish->id) }}">
                        @csrf
                        @method("DELETE")
                        <button class=" btns black-button"type="submit">ELIMINA PIATTO</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection



<style lang="scss">
#desc {
    word-break: break-all;
}

.btns {
    margin: 10px 0;
    width: 300px;
}




@media screen and (max-width:1100px){
.media-margin {
        margin-bottom: 20px;
    }
}

@media screen and (max-width:700px){
    .edit-container {
        margin-top: 50px;
    }
    #dish-show-img{
        border-radius: 100% !important;
        /* max-width: 100% !important; */
    }

    
}
</style>