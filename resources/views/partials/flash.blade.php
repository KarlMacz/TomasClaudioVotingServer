@if(session()->has('prompt'))
    @if(session()->get('prompt.status') === 'ok')
        <div class="prompt success">{{ session()->get('prompt.message') }}</div>
    @elseif(session()->get('prompt.status') === 'error')
        <div class="prompt danger">{{ session()->get('prompt.message') }}</div>
    @else
        <div class="prompt info">{{ session()->get('prompt.message') }}</div>
    @endif
@endif
