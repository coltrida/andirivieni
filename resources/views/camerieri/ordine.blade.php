@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between">
                    <div>
                        Coperti <input type="number" name="coperti" id="coperti" value="{{ $ordine->nrPersone }}">
                        <i class="fas fa-plus" onclick="aggiungicoperti()" ></i>
                        &nbsp;
                        <i class="fas fa-minus" onclick="diminuiscicoperti()" ></i>
                    </div>
                    <div>Tavolo nr. {{ $ordine->nrTavolo }}</div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-3" style="display: flex; flex-direction: column">
                            @foreach($menu as $item)
                                <a href="#" class="btn btn-success"
                                   onclick="vis( '{{ $item->id }}', {{ count($menu) }} )"
                                   style="margin-bottom: 5px">
                                    {{ $item->name }}
                                </a>
                            @endforeach
                        </div>

                        <div class="col-3">
                            @foreach($menu as $item)
                                <div id="{{ $item->id }}" style="display: none">
                                    <div style="display: flex; flex-direction: column">
                                        @foreach($item->foods as $food)
                                            <a href="#" class="btn btn-primary"
                                               onclick="inseriscicomanda('{{ $food->name }}', {{ $food->id }})"
                                               style="margin-bottom: 5px">
                                                {{ $food->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-3"  style="display: flex; flex-direction: column">
                            <ul id="comanda"></ul>
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

<script>
    function vis(idselezionato, tot) {
        for (i = 1; i <= tot; i++) {
            document.getElementById(i).style.display = "none";
        }
        document.getElementById(idselezionato).style.display = "block";
    }

    function aggiungicoperti() {
        cop = parseInt(document.getElementById('coperti').value);
        cop ++;
        document.getElementById('coperti').value = cop;
    }

    function diminuiscicoperti() {
        cop = parseInt(document.getElementById('coperti').value);
        cop --;
        document.getElementById('coperti').value = cop;
    }

    function inseriscicomanda(nome, id) {
        var node = document.createElement("LI");
        var textnode = document.createTextNode(nome);
        node.appendChild(textnode);
        document.getElementById('comanda').appendChild(node);
    }
</script>
