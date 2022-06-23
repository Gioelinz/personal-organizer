@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <h2>Benvenuto/a {{ auth()->user()->name ?? auth()->user()->email }}</h2>
                        <p class="h5">Da qui puoi gestire i tuoi appuntamenti</p>
                        <div class="controls mt-3">
                            <a href="{{ route('home.organizer.index') }}" class="btn btn-lg btn-outline-secondary"
                                title="Visualizza i tuoi appuntamenti">
                                <i class="fa-solid fa-book-bookmark fa-lg"></i>
                            </a>
                            <a href="{{ route('home.organizer.create') }}" class="btn btn-lg btn-outline-success"
                                title="Aggiungi appuntamento">
                                <i class="fa-solid fa-calendar-plus fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
