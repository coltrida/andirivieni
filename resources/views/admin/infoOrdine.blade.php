@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content:space-between">
                    <div>Admin</div>
                    <div>Tavolo nr: {{$order->nrTavolo}}</div>
                    <div>Coperti {{$order->nrPersone}}</div>

                </div>

                <div class="card-body">

                    @php $totale = 0; @endphp

                    @foreach ($grouped as $mandata => $foods)
                   <h2>{{ $mandata == 3 ? 'Altro' : 'Mandata '.$mandata }}</h2>
                        <div class="row" style="background-color: #98dfb6">
                            <div class="col-3">Piatto</div>
                            <div class="col-3">Quantità</div>
                            <div class="col-3">Destinazione</div>
                            <div class="col-3">Prezzo</div>
                        </div>

                        @foreach ($foods as $food)

                            <div class="row">
                                <div class="col-3">{{$food->name}}</div>
                                <div class="col-3">{{$food->pivot->quantity}}</div>
                                <div class="col-3">{{$food->destinazione}}</div>
                                <div class="col-3">€ {{$food->price}}</div>
                                @php $totale += $food->price @endphp
                            </div>
                        @endforeach
                        <br>
                        <hr>
                    @endforeach
                        <div class="row" style="background-color: #dfae69">
                            <div class="col-3">Totale</div>
                            <div class="col-3">&nbsp;</div>
                            <div class="col-3">&nbsp;</div>
                            <div class="col-3">@php echo '€ '.$totale @endphp</div>
                        </div>
                        <br>
                    <div class="row">
                        <div class="col-3">Note</div>
                        <div class="col-9">{{ $order->note }}</div>
                    </div>
                    <br>
                    <div style="display: flex; justify-content: space-between">
                        <div><a target="_blank" href="{{ route('stampaOrdine', $order->id) }}" class="btn btn-success">Stampa</a></div>
                        <div><a href="{{ route('home') }}" class="btn btn-danger">Indietro</a></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection