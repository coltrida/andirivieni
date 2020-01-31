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

                                <form action="{{route('riepilogo')}}" method="post" id="formriepilogo">
                                    @csrf
                                    <input type="hidden" name="tavolo" value="{{ $ordine->nrTavolo }}">
                                    <input type="hidden" name="persone" value="{{ $ordine->nrPersone }}">
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
        var ll = '';
        if (document.getElementById('radio1').checked) {
            lista = 'listamandata1';
            ll = 1;
        }else if(document.getElementById('radio2').checked) {
            lista = 'listamandata2';
            ll = 2;
        }else if(document.getElementById('radio3').checked) {
            lista = 'listaaltro';
            ll = 3;
        }
        document.getElementById(lista).style.border = "1px solid black";
        document.getElementById(lista).style.padding = "10px";
        document.getElementById(lista).style.boxShadow = "1px 1px 3px black";
        var divtest = document.createElement("div");
        divtest.style.cssText = 'background-color: #59A772; padding: 7px; border-radius: 10px; margin-bottom: 7px';
        divtest.innerHTML =
            "<div style='display:flex;justify-content:space-between'><div>"
            + nome +
            "</div> <div> <i class='fas fa-plus' onclick='aggiungi("+id+','+ll+")'></i> <input style='width:40px' type='number' min='0' name='qta' id='qta"+id+ll+"' value='1'><i class='fas fa-minus' onclick='diminuisci("+id+','+ll+")'></i> </div></div> "
            ;
        document.getElementById(lista).appendChild(divtest);

        var piatto = [nome, 1, lista];
        //console.log(piatto);
        var aggiungipiatto = document.createElement("INPUT");
        aggiungipiatto.setAttribute("type", "hidden");
        aggiungipiatto.setAttribute("name", "dati["+id+ll+"][0]");
        aggiungipiatto.setAttribute("id", 'passa'+id);
        aggiungipiatto.setAttribute("value", piatto[0]);
        document.getElementById('formriepilogo').appendChild(aggiungipiatto);

        var aggiungipiatto2 = document.createElement("INPUT");
        aggiungipiatto2.setAttribute("type", "hidden");
        aggiungipiatto2.setAttribute("name", "dati["+id+ll+"][1]");
        aggiungipiatto2.setAttribute("id", "qta"+id+ll+"1");
        aggiungipiatto2.setAttribute("value", piatto[1]);
        document.getElementById('formriepilogo').appendChild(aggiungipiatto2);

        var aggiungipiatto3 = document.createElement("INPUT");
        aggiungipiatto3.setAttribute("type", "hidden");
        aggiungipiatto3.setAttribute("name", "dati["+id+ll+"][2]");
        aggiungipiatto3.setAttribute("value", piatto[2]);
        document.getElementById('formriepilogo').appendChild(aggiungipiatto3);

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

    function aggiungi(idpassato, dest) {
        var idqta = "qta"+idpassato+dest;
        valore = document.getElementById(idqta).value;
        valore ++;
        document.getElementById(idqta).value = valore;
        var destinazione = '';
        if (dest == 1) {
            destinazione = 'listamandata1';
        }else if(dest == 2) {
            destinazione = 'listamandata2';
        }else if(dest == 3) {
            destinazione = 'listaaltro';
        }

        document.getElementById('qta'+idpassato+dest+'1').value = valore;


    }

    function diminuisci(idpassato, dest) {
        var idqta = "qta"+idpassato+dest;
        valore = document.getElementById(idqta).value;
        if (valore > 0 ){
            valore --;
        }
        document.getElementById(idqta).value = valore;
        var destinazione = '';
        if (dest == 1) {
            destinazione = 'listamandata1';
        }else if(dest == 2) {
            destinazione = 'listamandata2';
        }else if(dest == 3) {
            destinazione = 'listaaltro';
        }

        document.getElementById('qta'+idpassato+dest+'1').value = valore;
    }
</script>
