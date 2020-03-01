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
                            <div class="col-2">Quantità</div>
                            <div class="col-3">Destinazione</div>
                            <div class="col-2">Prezzo Unitario</div>
                            <div class="col-2">Prezzo Totale</div>
                        </div>

                        @foreach ($foods as $food)

                            <div class="row">
                                <div class="col-3">{{$food->name}}</div>
                                <div class="col-2">{{$food->pivot->quantity}}</div>
                                <div class="col-3">{{$food->destinazione}}</div>
                                <div class="col-2">€ {{str_replace('.', ',', $food->price)}}</div>
                                <div class="col-2">€ {{str_replace('.', ',', $food->price * $food->pivot->quantity)}}</div>
                                @php $totale += ($food->price * $food->pivot->quantity) @endphp
                            </div>
                        @endforeach
                        <br>
                        <hr>
                    @endforeach
                        <div class="row">
                            <div class="col-3">Coperto</div>
                            <div class="col-2">&nbsp;</div>
                            <div class="col-3">&nbsp;</div>
                            <div class="col-2">&nbsp;</div>
                            <div class="col-2">@php echo '€ '.str_replace('.', ',', $order->nrPersone * 1.5)  @endphp</div>
                        </div>
                    <br>
                        <div class="row" style="background-color: #dfae69">
                            <div class="col-3">Totale</div>
                            <div class="col-2">&nbsp;</div>
                            <div class="col-3">&nbsp;</div>
                            <div class="col-2">&nbsp;</div>
                            <div class="col-2">@php echo '€ '.str_replace('.', ',', $totale + ($order->nrPersone * 1.5) ) @endphp</div>
                        </div>
                        <br>
                    @if($order->note)
                        <div class="row">
                            <div class="col-3">Note Prima Mandata</div>
                            <div class="col-9">{{ $order->note }}</div>
                        </div>
                    @endif
                    @if($order->note2)
                        <div class="row">
                            <div class="col-3">Note Seconda Mandata</div>
                            <div class="col-9">{{ $order->note2 }}</div>
                        </div>
                    @endif
                    @if($order->note3)
                    <div class="row">
                        <div class="col-3">Note Mandata Altro</div>
                        <div class="col-9">{{ $order->note3 }}</div>
                    </div>
                    @endif
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