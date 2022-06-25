@component('mail::message')
    # Ciao {{ $organizer->user->name ?? $organizer->user->email }}

    Il tuo appuntamento è tra un ora!
    fissato il {{ date('d M Y H:i', strtotime($organizer->expire)) }}.

    @if (isset($organizer->description))
        Descrizione: {{ $organizer->description }}
    @endif

    Grazie,
    {{ config('app.name') }}
@endcomponent
