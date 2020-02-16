@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content:space-between">
                    <div>Statistiche di vendita</div>

                </div>
                <div class="card-body">
                <table class="table table-striped table-dark" >
                    <thead>
                    <tr>
                        <th scope="col">Piatto</th>
                        <th scope="col">Nr. Venduti</th>
                        <th scope="col">Prezzo unitario</th>
                        <th scope="col">Ricavo Totale</th>
                        <th scope="col">Costo Totale</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($conteggio as $key => $item)

                        <tr>
                            <td>{{$foods[$key-1]->name}}</td>
                            <td>{{$item}}</td>
                            <td>{{$foods[$key-1]->price}}</td>
                            <td>{{$foods[$key-1]->price * $item}}</td>
                            <td>{{$foods[$key-1]->cost * $item}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


        {{--            @foreach($conteggio as $key => $item)
                        {{$foods[$key-1]->name}} => {{$item}} => {{$foods[$key-1]->price}} => {{ $foods[$key-1]->cost }} <br>
                    @endforeach--}}
                </div>

                <div style="display: flex; justify-content: space-between">
                    <div><a href="{{ route('home') }}" class="btn btn-danger">Indietro</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection