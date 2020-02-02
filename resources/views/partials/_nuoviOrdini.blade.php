<table class="table table-striped table-dark" >
        <thead>
        <tr>
                <th scope="col">Nr. Tavolo</th>
                <th scope="col">Coperti</th>
                <th scope="col">Cameriere</th>
                <th scope="col">Azioni</th>
        </tr>
        </thead>
        <tbody id="tabellaNuoviOrdini">
        @foreach ($ordini as $ordine)
        <tr>
                <td>{{$ordine->nrTavolo}}</td>
                <td>{{$ordine->nrPersone}}</td>
                <td>{{$ordine->user_id}}</td>
                <td><a href="" class="btn btn-success">Vedi</a></td>
        </tr>
        @endforeach
        </tbody>
</table>

