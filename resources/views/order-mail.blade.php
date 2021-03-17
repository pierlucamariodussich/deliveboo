<div class="container">
    <div class="row">
        <div id="email-box" class="col-6 offset-3">
            <h1>Ciao {{ $client_name }}</h1>
            <h3>Grazie per aver usato il nostro servizio di DeliverBoo!</h3>
            <h4>Il tuo ordine è stato effettuato con successo.</h4>
            <h4>Ecco un riepilogo del tuo ordine:</h4>
            <ul>
                <li>Id Ordine: {{ $order_id }}</li>
                <li>Totale: {{ $total }} euro.</li>
                
            </ul>
            
            <h3>Scontrino</h3>
            <ul>
            @foreach ($dishes as $dish)
                <li>{{ $dish->name }} - {{ $dish->price }}euro</li>
            @endforeach
            </ul>

        </div>
    </div>
</div>


<style>
#email-box {
    text-align: center;
    width: 50vw;
    margin: auto;
    height: 50vh;
    border: 1px solid black;
    box-shadow: 3px 2px 2px rgba(0,0,0,0.7)
}

ul li {
    list-style-type: none;
}

</style>

