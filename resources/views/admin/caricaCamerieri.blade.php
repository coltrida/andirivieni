@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content:space-between">
                    <div>Carica Camerieri</div>

                </div>
                <div class="card-body">
                    @foreach($users as $user)
                        {{ $user->name }} -
                    @endforeach

                    <form method="post" action="{{ route('caricacamerierisave') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome</label>
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