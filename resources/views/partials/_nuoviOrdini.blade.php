<table class="table table-striped table-dark" >
        <thead>
        <tr>
                <th scope="col">Nr. Tavolo</th>
                <th scope="col">Coperti</th>
                <th scope="col">Cameriere</th>
                <th scope="col">Orario Comanda</th>
                <th scope="col">Azioni</th>
        </tr>
        </thead>
        <tbody id="tabellaNuoviOrdini">
        @foreach ($ordini as $ordine)
        <tr>
                <td>{{$ordine->nrTavolo}}</td>
                <td>{{$ordine->nrPersone}}</td>
                <td>{{$ordine->user->name}}</td>
                <td>{{$ordine->orario}}</td>
                <td>
                        <a href="{{route('infoOrdine', $ordine->id)}}" class="btn btn-success">Vedi</a>
                        <a href="{{route('chiudiOrdine', $ordine->id)}}" class="btn btn-danger">chiudi</a>
                </td>
        </tr>
        @endforeach
        </tbody>
</table>

