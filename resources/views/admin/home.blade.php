@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content:space-between">
                    <div id="titolo">Admin</div>
                    <a href="{{route('caricatavoli')}}" class="btn btn-primary">Carica Tavoli</a>
                    <a href="{{route('caricamenu')}}" class="btn btn-primary">Carica Menu</a>
                    <a href="{{route('caricacamerieri')}}" class="btn btn-primary">Carica Camerieri</a>
                    <a href="{{route('caricacategorie')}}" class="btn btn-primary">Carica Categorie</a>
                    <a href="{{route('statistiche')}}" class="btn btn-primary">Statistiche</a>
                    {{--<a href="{{route('azzera')}}" class="btn btn-primary">Azzera</a>--}}
                </div>

                <div class="card-body" >
                    @include('partials._nuoviOrdini')
                    <div id="listatavoli" style="margin-left: 40px">
                        @include('partials._tavoli')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jquery')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    var tabella = $('#tabellaNuoviOrdini');
    var tavoli = $('#listatavoli');
    setInterval( function () {
        // ---------------------------- stato ordini -----------------------------
        var url = "/getNuoviOrdini";
        $.ajax(url,
            {
                method: 'GET',
                complete : function (resp) {
                    tabella.html('');
                    //console.log(resp.responseJSON);
                    for (i=0; i<resp.responseJSON.length; i++){
                        var piatto = resp.responseJSON[i];
                        //alert(piatto);
                        var id = piatto.id;
                        var prelinkOrdine = '{{ route('infoOrdine', ":id") }}';
                        var linkOrdine = prelinkOrdine.replace(':id', id);
                        var prelinkChiudi = '{{ route('chiudiOrdine', ":id") }}';
                        var linkChiudi = prelinkChiudi.replace(':id', id);
                        tabella.append("<tr><td>"+piatto.nrTavolo+"</td>" +
                            "<td>"+piatto.nrPersone+"</td>" +
                            "<td>"+piatto.cameriere+"</td>" +
                            "<td>"+piatto.orario+"</td>" +
                            "<td><a href='"+linkOrdine+"' class='btn btn-success'>vedi</a><a href='"+linkChiudi+"' class='btn btn-danger'>chiudi</a></td></tr>");
                    }

                }
            });

        // ---------------------------- stato tavoli -----------------------------
        var urltavoli = "/getStatoTavoli";
        $.ajax(urltavoli,
            {
                method: 'GET',
                complete : function (resp) {
                    tavoli.html('');
                    //console.log(resp.responseJSON);
                    for (j=0; j<resp.responseJSON.length; j++){
                        var classeTavoloOccupato = '';
                        var tavolo = resp.responseJSON[j];
                        //console.log(tavolo);
                        var idtavolo = tavolo.id;
                        var prelinkTavolo = '{{ route('selezioneTavolo', ":id") }}';
                        if (tavolo.stato == 'occupato'){
                            classeTavoloOccupato = 'tavoloOccupato'
                        }
                        var linkTavolo = prelinkTavolo.replace(':id', idtavolo);
                        tavoli.append("<a href='"+linkTavolo+"' class='btn btn-outline-primary btn-lg tavoloBtn mr-1 "+classeTavoloOccupato+"'>"+ idtavolo +"</a>");
                    }
                }
            });

    }, 5000 );
</script>
@endsection