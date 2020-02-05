<html>
<head></head>
<body style="font-size: 12px">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header" style="width: 100%">
                    <div style="display: inline-block; width: 250px; font-size: 15px">Tavolo nr: {{$order->nrTavolo}}</div>
                    <div style="display: inline-block;width: 250px; font-size: 15px">Coperti {{$order->nrPersone}}</div>

                </div>

                <div class="card-body">

                    @php $totale = 0; @endphp

                    @foreach ($grouped as $mandata => $foods)
                        <h2>{{ $mandata == 3 ? 'Altro' : 'Mandata '.$mandata }}</h2>
                        <div class="row" style="background-color: #98dfb6; width: 100%">
                            <div style="display: inline-block; width: 20%; font-size: 15px">Piatto</div>
                            <div style="display: inline-block; width: 20%; font-size: 15px">Quantità</div>
                            <div style="display: inline-block; width: 20%; font-size: 15px">Destinazione</div>
                            <div style="display: inline-block; width: 20%; font-size: 15px">Prezzo</div>
                        </div>

                        @foreach ($foods as $food)

                            <div class="row" style="width: 100%">
                                <div style="display: inline-block; width: 20%; font-size: 15px">{{$food->name}}</div>
                                <div style="display: inline-block; width: 20%; font-size: 15px">{{$food->pivot->quantity}}</div>
                                <div style="display: inline-block; width: 20%; font-size: 15px">{{$food->destinazione}}</div>
                                <div style="display: inline-block; width: 20%; font-size: 15px">€ {{$food->price}}</div>
                                @php $totale += $food->price @endphp
                            </div>
                        @endforeach
                        <br>
                    @endforeach
                    <div class="row" style="background-color: #dfae69; width: 100%">
                        <div style="display: inline-block; width: 20%; font-size: 15px">Totale</div>
                        <div style="display: inline-block; width: 20%; font-size: 15px">&nbsp;</div>
                        <div style="display: inline-block; width: 20%; font-size: 15px">&nbsp;</div>
                        <div style="display: inline-block; width: 20%; font-size: 15px">@php echo '€ '.$totale @endphp</div>
                    </div>
                    <br>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>