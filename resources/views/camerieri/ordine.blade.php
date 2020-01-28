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

                            <div class="col-4"  style="display: flex; flex-direction: column">
                                <div id="listamandata1">Mandata 1</div>
                                <div id="listamandata2" style="display: none">Mandata 2</div>
                                <div id="listaaltro" style="display: none">Altro</div>
                            </div>

                            <div class="col-2" style="display: flex; flex-direction: column">
                                <div class="switch-field">
                                    <input type="radio" id="radio1" name="switch-two" onclick="vismandata(1)" value="Mandata1" checked/>
                                    <label for="radio1">Mandata1</label>
                                    <input type="radio" id="radio2" name="switch-two" onclick="vismandata(2)" value="Mandata2" />
                                    <label for="radio2">Mandata2</label>
                                    <input type="radio" id="radio3" name="switch-two" onclick="vismandata(3)" value="Altro" />
                                    <label for="radio3">Altro</label>
                                </div>

                                <form action="" method="post" id="formriepilogo">
                                    @csrf
                                    <input type="submit" class="btn btn-success" style="height: 80px" value="Riepilogo">
                                </form>
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
        var lista = '';
        if (document.getElementById('radio1').checked) {
            lista = 'listamandata1';
        }else if(document.getElementById('radio2').checked) {
            lista = 'listamandata2';
        }else if(document.getElementById('radio3').checked) {
            lista = 'listaaltro';
        }
        document.getElementById(lista).style.border = "1px solid black";
        document.getElementById(lista).style.padding = "10px";
        document.getElementById(lista).style.boxShadow = "1px 1px 3px black";
        var divtest = document.createElement("div");
        divtest.style.cssText = 'background-color: #59A772; padding: 7px; border-radius: 10px; margin-bottom: 7px';
        divtest.innerHTML =
            "<div style='display:flex;justify-content:space-between'><div>"
            + nome +
            "<input type='hidden' name='piatto' value='"+id+"'></div> <div> <i class='fas fa-plus' onclick='aggiungi()'></i> <input style='width: 30px' type='number' name='qta' id='qta' value='1'><i class='fas fa-minus' onclick='diminuisci()'></i> </div></div> "
            ;
        document.getElementById(lista).appendChild(divtest);
    }

    function vismandata(mandata) {
        if (mandata == 1){
            document.getElementById('listamandata1').style.display = "block";
            document.getElementById('listamandata2').style.display = "none";
            document.getElementById('listaaltro').style.display = "none";
        } else if (mandata == 2){
            document.getElementById('listamandata2').style.display = "block";
            document.getElementById('listamandata1').style.display = "none";
            document.getElementById('listaaltro').style.display = "none";
        } else if (mandata == 3){
            document.getElementById('listamandata1').style.display = "none";
            document.getElementById('listamandata2').style.display = "none";
            document.getElementById('listaaltro').style.display = "block";
        }
    }

    function aggiungi() {

    }

    function diminuisci() {

    }
</script>
