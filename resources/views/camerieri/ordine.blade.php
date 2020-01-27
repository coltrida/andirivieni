@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between">
                    <div>Coperti {{ $ordine->nrPersone }}</div>
                    <div>Tavolo nr. {{ $ordine->nrTavolo }}</div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-3" style="display: flex; flex-direction: column">
                            @foreach($menu as $item)
                                <a href="#" class="btn btn-success" style="margin-bottom: 5px">{{ $item->name }}</a>
                            @endforeach
                        </div>

                        <div class="col-3">
                            @foreach($menu as $item)
                                <div id="{{ $item->id }}" style="display: flex; flex-direction: column">
                                    @foreach($item->foods as $food)
                                        <a href="#" class="btn btn-primary" style="margin-bottom: 5px">{{ $food->name }}</a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <div class="col-3">

                        </div>

                        <div class="col-3">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
