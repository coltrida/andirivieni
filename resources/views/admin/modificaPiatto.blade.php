@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content:space-between">
                    <div>Modifica Piatto</div>

                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('modificaPiattosave', $food->id) }}">
                        @csrf
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control"  name="nome" value="{{ $food->name }}">
                        </div>

                        <label>Categoria</label>
                        <select class="form-control" name="categoria">
                            <option selected> </option>
                            @foreach($categorie as $categoria)
                                <option {{$categoria->id==$food->id ? 'selected' : ''}} value="{{ $categoria->id }}"> {{ $categoria->name }} </option>
                            @endforeach
                        </select>

                        <label>Destinazione</label>
                        <select class="form-control" name="destinazione">
                            <option {{$food->destinazione=='ristorante' ? 'selected' : ''}} value="ristorante"> Ristorante </option>
                            <option {{$food->destinazione=='pizzeria' ? 'selected' : ''}} value="pizzeria"> Pizzeria </option>
                        </select>

                        <div class="form-group">
                            <label>Prezzo al pubblico</label>
                            <input type="number" class="form-control" name="prezzo" value="{{ $food->price }}">
                        </div>

                        <div class="form-group">
                            <label>Costo</label>
                            <input type="number" class="form-control" name="costo" value="{{ $food->cost }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Salva</button>
                    </form>
                    <br>
                    <a href="{{ route('caricamenu') }}" class="btn btn-danger">Indietro</a>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection