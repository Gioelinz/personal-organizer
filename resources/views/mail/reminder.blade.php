@component('mail::message')
    # Ciao {{ $organizer->user->name ?? $organizer->user->email }}

    Il tuo appuntamento è fissato tra un ora!
    Ricorda Data & Ora: {{ date('d M Y H:i', strtotime($organizer->expire)) }}.

    @if (isset($organizer->description))
        Descrizione: {{ $organizer->description }}
    @endif

    Grazie,
    {{ config('app.name') }}
@endcomponent
