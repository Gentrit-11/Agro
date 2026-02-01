@extends('layouts.app')

@section('title', 'Shto Blerje')

@section('content')

    <div class="container">
        <h5 class="fw-bold mb-4">Shto Blerje të Re</h5>

        {{-- LIVEWIRE FORM --}}
        @livewire('purchase-form')
    </div>

@endsection
