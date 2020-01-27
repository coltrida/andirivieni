@foreach ($tavoli as $tavolo)
        <a href="{{ route('selezioneTavolo', $tavolo->id) }}" class="btn btn-outline-primary btn-lg tavoloBtn
                {{ $tavolo->stato == 'occupato' ? 'tavoloOccupato' : ''}}">
                {{ $tavolo->id }}
        </a>
@endforeach