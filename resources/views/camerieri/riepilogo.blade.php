@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-3">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between">
                        <div>Riepilogo</div>
                        <div>Tavolo nr. {{ $tavolo }}</div>
                        <div>Coperti {{ $coperti }}</div>
                    </div>

                    <div class="card-body">

                        <div class="row">
                        <div class="col-md-4">
                            <h2>Prima Mandata</h2>
                            <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">Piatto</th>
                                    <th scope="col">Quantità</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mandata1 as $lista)
                                    <tr>
                                        <td>{{ $lista[0] }}</td>
                                        <td>{{ $lista[1] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-4">
                                <h2>Seconda Mandata</h2>
                                <table class="table table-striped table-dark">
                                    <thead>
                                    <tr>
                                        <th scope="col">Piatto</th>
                                        <th scope="col">Quantità</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mandata2 as $lista)
                                        <tr>
                                            <td>{{ $lista[0] }}</td>
                                            <td>{{ $lista[1] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-4">
                                <h2>Altro</h2>
                                <table class="table table-striped table-dark">
                                    <thead>
                                    <tr>
                                        <th scope="col">Piatto</th>
                                        <th scope="col">Quantità</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mandata3 as $lista)
                                        <tr>
                                            <td>{{ $lista[0] }}</td>
                                            <td>{{ $lista[1] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <form action="{{ route('inviaPrenotazione') }}" method="post">
                            @csrf
                            <div style="display: flex; justify-content: space-between;">
                                <input type="hidden" name="ordine" value="{{ $ordine }}">
                                <input type="submit" value="Ok" class="btn btn-primary mr-5">
                            </div>
                        </form>
                        <a href="{{ route('selezioneTavolo', $tavolo) }}" class="btn btn-danger">Annulla</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

<script>

</script>
