@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        @if ($organizer->exists)
            <h1>Modifica appuntamento</h1>
            <form action="{{ route('home.organizer.update', $organizer) }}" method="post">
                @method('PUT')
            @else
                <h1>Aggiungi appuntamento</h1>
                <form action="{{ route('home.organizer.store') }}" method="post">
        @endif


        @csrf
        <div class="form-group">
            <label for="expire">Data e ora</label>
            <input type="datetime-local" step="300" class="form-control @error('expire') is-invalid @enderror"
                id="expire" name="expire" value="{{ old('expire', $organizer->expire) }}">
            @error('expire')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                rows="3">{{ old('description', $organizer->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- Reminder notification --}}
        <div class="custom-control custom-switch mb-3">
            <input type="checkbox" class="custom-control-input" id="notification" name="notification">
            <label class="custom-control-label" for="notification">Ricevi notifica 1 ora prima dell'evento</label>
        </div>


        {{-- <div class="row">
            <div class="col-12">
                <div class="@error('tags') is-invalid @enderror">
                    <h4>Tipologia cliente</h4>
                    @foreach ($tags as $tag)
                        <div class="custom-control custom-switch d-inline-block mb-5 mt-4">
                            <input type="checkbox" class="custom-control-input" id="tag-input-{{ $tag->id }}"
                                value="{{ $tag->id }}" name="tags[]" @if (in_array($tag->id, old('tags', $current_tags ?? []))) checked @endif>
                            <label class="custom-control-label mr-5 h5" for="tag-input-{{ $tag->id }}"><span
                                    class="badge badge-{{ $tag->color }}">{{ $tag->label }}</span></label>
                        </div>
                    @endforeach
                </div>
                @error('tags')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div> --}}

        <button type="submit" class="btn btn-success">Conferma</button>
        <a class="btn btn-primary" href="{{ url()->previous() }}">Torna indietro</a>
        </form>
    </div>
@endsection
