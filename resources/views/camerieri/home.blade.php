@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header">Cameriere</div>

                <div class="card-body">
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
        var tavoli = $('#listatavoli');
        setInterval( function () {
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