@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content:space-between">
                    <div>Carica Categorie</div>

                </div>
                <div class="card-body">
                    @foreach($categorie as $categoria)
                        {{ $categoria->name }} -
                    @endforeach

                    <form method="post" action="{{ route('caricacategoriesave') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Categoria</label>
                            <input type="text" class="form-control"  name="categoria">
                        </div>

                        <button type="submit" class="btn btn-primary">Salva</button>
                    </form>
                    <br>
                    <a href="{{ route('home') }}" class="btn btn-danger">Indietro</a>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection