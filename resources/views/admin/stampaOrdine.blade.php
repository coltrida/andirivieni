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
                        </div>

                        @foreach ($foods as $food)

                            <div class="row" style="width: 100%">
                                <div style="display: inline-block; width: 20%; font-size: 15px; margin-top: 2px">{{$food->name}}</div>
                                <div style="display: inline-block; width: 20%; font-size: 15px; margin-top: 2px">{{$food->pivot->quantity}}</div>
                                <div style="display: inline-block; width: 20%; font-size: 15px; margin-top: 2px">{{$food->destinazione}}</div>
                            </div>
                        @endforeach
                        <br>
                        <hr>
                    @endforeach
                    <br>
                    <div class="row" style="width: 100%">
                        <div style="display: inline-block; width: 20%; font-size: 15px">Note</div>
                        <div style="display: inline-block; width: 60%; font-size: 15px">{{ $order->note }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>