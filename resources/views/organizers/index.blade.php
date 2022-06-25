@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            @forelse ($organizers as $organizer)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a class="h5 mb-0 text-dark" data-toggle="collapse"
                                    href="#organizer-collapse-{{ $organizer->id }}" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    Appuntamento: <b>{{ date('d M Y H:i', strtotime($organizer->expire)) }}</b>
                                </a>
                                <div class="controls">
                                    <a href="{{ route('home.organizer.edit', $organizer) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    {{-- Destroy organizer modal --}}
                                    @include('includes.modal-delete')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="organizer-collapse-{{ $organizer->id }}">
                        <div class="card card-body">
                            {{ $organizer->description ?? 'Nessuna descrizione' }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <a class="h5 mb-0 text-dark" data-toggle="collapse" href="#empty-collapse" role="button"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    Non hai appuntamenti registrati
                                </a>

                                <a href="{{ route('home.organizer.create') }}" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </div>

                            <div class="collapse mt-2" id="empty-collapse">
                                <div class="card card-body">
                                    Qui troverai i tuoi appuntamenti registrati.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
@endsection
