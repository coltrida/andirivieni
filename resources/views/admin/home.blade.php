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
                </div>

                <div class="card-body">
                    @include('partials._nuoviOrdini')
                    @include('partials._tavoli')
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
    setInterval( function () {
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
                        tabella.append("<tr><td>"+piatto.nrTavolo+"</td>" +
                            "<td>"+piatto.nrPersone+"</td>" +
                            "<td>"+piatto.user_id+"</td>" +
                            "<td><a target='_blank' href='"+linkOrdine+"' class='btn btn-success'>vedi</a></td></tr>");
                    }
                }
            });
    }, 5000 );
</script>
@endsection