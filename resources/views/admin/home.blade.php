@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header">Admin</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <a href="{{route('caricatavoli')}}" class="btn btn-primary">Carica Tavoli</a>
                        <a href="{{route('caricamenu')}}" class="btn btn-primary">Carica Menu</a>
                        <a href="{{route('caricacamerieri')}}" class="btn btn-primary">Carica Camerieri</a>
                        <a href="{{route('caricacategorie')}}" class="btn btn-primary">Carica Categorie</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
