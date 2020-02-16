@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-3">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between">
                    <div>Coperti</div>
                    <div>Tavolo nr. {{ $tavolo->id }}</div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div style="display: flex; justify-content: space-around; align-items: center;">
                            <div>
                                <i class="fas fa-user" style="font-size: 180px"></i>
                            </div>
                            <div>
                                <i class="fas fa-user" style="font-size: 180px"></i>
                            </div>
                            <div>
                                <input class="form-control border border-secondary" onchange="invia()" style="box-shadow: 1px 1px 2px black"
                                       type="number" id="coperti" value="0">
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-around; align-items: center;">
                            <div>
                                <i class="fas fa-plus" onclick="aggiungi()" style="font-size: 180px"></i>
                            </div>
                            <div>
                                <i class="fas fa-minus" onclick="diminuisci()" style="font-size: 180px"></i>
                            </div>
                            <div>
                                <form action="{{ route('prenotaTavolo') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="tavolo" value="{{ $tavolo->id }}">
                                    <input type="hidden" name="coperti" id="prendicoperti" value="">
                                    <div style="display: flex; justify-content: space-between;">
                                        <input type="submit" id="buttonok" value="Ok" class="btn btn-primary mr-5 not-active">
                                        <a href="#" class="btn btn-danger">Annulla</a>
                                    </div>

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
    function invia(){
        valore = parseInt(document.getElementById('coperti').value);
        document.getElementById('prendicoperti').value = valore;
    }

    
    function aggiungi() {
        var button = document.getElementById('buttonok');
        button.classList.remove('not-active');
        cop = parseInt(document.getElementById('coperti').value);
        cop ++;
        document.getElementById('coperti').value = cop;
        document.getElementById('prendicoperti').value = cop;
    }

    function diminuisci() {
        cop = parseInt(document.getElementById('coperti').value);
        if (cop <= 1){
            var button = document.getElementById('buttonok');
            button.classList.add('not-active');
            cop = 0;
        } else {
            cop --;
        }
        document.getElementById('coperti').value = cop;
        document.getElementById('prendicoperti').value = cop;
    }

</script>
