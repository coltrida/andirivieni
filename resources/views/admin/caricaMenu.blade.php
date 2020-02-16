@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content:space-between">
                    <div>Carica Tavoli</div>

                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('caricamenusave') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                Nome
                                <input type="text" class="form-control" name="food">
                            </div>
                            <div class="col">
                                Categoria
                                <select class="form-control" name="categoria">
                                    <option selected> </option>
                                    @foreach($categorie as $categoria)
                                        <option value="{{ $categoria->id }}"> {{ $categoria->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                Destinazione
                                <select class="form-control" name="destinazione">
                                    <option selected> </option>
                                        <option value="ristorante"> Ristorante </option>
                                        <option value="pizzeria"> Pizzeria </option>
                                </select>
                            </div>
                            <div class="col">
                                Prezzo al pubblico
                                <input type="number" class="form-control" name="prezzo">
                            </div>
                            <div class="col">
                                Costo
                                <input type="number" class="form-control" name="costo">
                            </div>
                        </div>
                        <br>
                        <div style="display: flex; justify-content: space-between">
                            <button type="submit" class="btn btn-primary">Salva</button>
                            <a href="{{ route('home') }}" class="btn btn-danger">Indietro</a>
                        </div>

                    </form>
                    <br>


                    <table class="table table-striped table-dark" >
                        <thead>
                        <tr>
                            <th scope="col">Piatto</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Destinazione</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col">Costo</th>
                            <th scope="col">In menu</th>
                            <th scope="col">Azioni</th>
                        </tr>
                        </thead>
                        <tbody id="tabellaNuoviOrdini">
                        @foreach( $foods as $food )
                            <tr>

                                <td>{{ $food->name }}</td>
                                <td>{{ $food->categoria->name }}</td>
                                <td>{{ $food->destinazione }}</td>
                                <td>{{ $food->price }}</td>
                                <td>{{ $food->cost }}</td>
                                <td>
                                    @if($food->inmenu == 1)
                                        <span class="badge badge-success" style="padding: 10px">si</span>
                                    @else
                                        <span class="badge badge-danger" style="padding: 10px">no</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('eliminaPiatto', $food->id) }}" class="btn btn-danger">Elimina dal menu</a>
                                    <a href="{{ route('rimettiPiatto', $food->id) }}" class="btn btn-success">Rimetti nel menu</a>
                                    <a href="{{ route('modificaPiatto', $food->id) }}" class="btn btn-primary">Modifica</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection