@extends('layouts.main')


@section('content')
    <section id="new-dish">


        <form action="{{ route('dishes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="container p-5">
                <div class="row ">
                    <div class="col-lg-6 mb-2">
                        <input type="hidden" name="_method" value="POST">
                        <input name="name" type="text" class="custom-input" id="name" aria-describedby="emailHelp"
                            placeholder="Nome Piatto">
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input name="price" type="text" class="custom-input" id="price" aria-describedby="emailHelp"
                            placeholder="Prezzo">
                    </div>
                    <div class="col-lg-12 mb-2">
                        <input name="description" type="text" class="custom-input" id="description"
                            aria-describedby="emailHelp" placeholder="Descrizione">
                    </div>
                    <div class="col-lg-12 mb-2">
                        <label for="image" class="form-label">Seleziona un immagine per il prodotto</label>
                        <input name="image" type="file" class="custom-input" id="image">
                    </div>
                    <div class="col-lg-12 justify-content-start align-items-center mt-4 mb-4">
                            <p>Seleziona se il prodotto è disponibile alla vendita.</p>
                            <input class="checkbox-tools" type="radio" name="visibility" value="0" id="visibility0">
                            <label class="for-checkbox-tools" for="visibility0">
                                Non Disponibile
                            </label>
                            <input class="checkbox-tools" type="radio" name="visibility" value="1" id="visibility1">
                            <label class="for-checkbox-tools" for="visibility1">
                                Disponibile
                            </label>
                    </div>
                    <div class="col-lg-12 justify-content-center align-items-center mb-4">
                        <p>Seleziona a che categoria appartiene il prodotto.</p>
                        @foreach ($genres as $genre)
                            <input class="checkbox-tools" type="radio" name="genre" value="{{ $genre['id'] }}"
                                id="{{ $genre['id'] }}">
                            <label class="for-checkbox-tools" for="{{ $genre['id'] }}">
                                {{ $genre['name'] }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-12 ">
                        <button type="submit" class="primary-button">CREA IL NUOVO PIATTO</button>
                    </div>
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
        </form>
    </section>



























    {{-- @foreach ($restaurants->getTypes as $type)
    @dd($type->getRestaurants)
    
@endforeach


 @foreach ($restaurants->getOrders as $order)
        <h4>{{ $order->client_name }}</h4>
        <h4>{{ $order->client_surname }}</h4>
        <h4>{{ $order->client_email }}</h4>
        <h4>{{ $order->client_phone }}</h4>
        <h4>{{ $order->client_address }}</h4>
        <h1>{{ $order->getRestaurant->name }}</h1>
        <br>
    @foreach ($order->getDishes as $dish) 
         <h4>{{ $dish->name }}</h4>
         <h4>{{ $dish->price }} euro</h4>
         <h4>{{ $dish->description }}</h4>
         <h4>ristorante: {{ $dish->getRestaurant->name }}</h4>
         <h4> genere: {{ $dish->getGenre->getDishes->pluck("name") }}</h4>
         
        
    @endforeach
     
 @endforeach --}}


    {{-- <h1>{{ $restaurants->name }}</h1>
@foreach ($restaurants->getTypes as $type)
    <h5>{{ $type->name }}</h5>
@endforeach
"--------------------------"
@foreach ($restaurants->getDishes as $dish)
    <h5>{{ $dish->name }}</h5>
    @foreach ($dish->getOrders as $order)
         {{ $order->id }}
         {{ $order->client_name }}
        
@endforeach

@foreach ($orders as $order){
    @foreach ($order->getDishes as $dishes)
           {{ $dishes->getRestaurant->id }}
        
    @endforeach
}
    
@endforeach


@endforeach --}}




    {{-- @foreach ($restaurants as $restaurant)
    <div class="card" style="width: 18rem;">
  <h2>immagine: {{ $restaurant->image_url }}</h2>
  <div class="card-body">
    <h5 class="card-title">{{ $restaurant->name }}</h5>
    <p class="card-text">{{ $restaurant->address }}</p>
    <p> test-getrestaurator: {{ $restaurant->getRestaurateur->getRestaurant->name }}</p>
    <h5>Test Tipi</h5>
    @foreach ($restaurant->getTypes as $type)
        <h5>{{ $type->name }}</h5>
    @endforeach
    <br>
    <h5>Test Piatti</h5>
    @foreach ($restaurant->getorders as $dish)
        <h5>{{ $dish->name }}</h5>
        <h5> test genere: {{ $dish->getGenre->name}}</h5>
        <h5>test restaurant: {{ $dish->getRestaurant->name }}</h5>
        
        
            
    @endforeach
   
    <br>

    
  </div>
</div>
@endforeach --}}


@endsection
