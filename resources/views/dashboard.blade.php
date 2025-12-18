@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    <!-- STOKU -->
    <div class="bg-white p-5 rounded shadow border-l-4 border-green-600">
        <p class="text-sm text-gray-500">Stoku total</p>
        <h2 class="text-2xl font-bold">{{ $stok }} kg</h2>
    </div>

    <!-- BORXH FURNITORË -->
    <div class="bg-white p-5 rounded shadow border-l-4 border-red-600">
        <p class="text-sm text-gray-500">Borxh furnitorë</p>
        <h2 class="text-2xl font-bold text-red-600">
            {{ $borxhFurnitore }} €
        </h2>
    </div>

    <!-- BORXH KLIENTË -->
    <div class="bg-white p-5 rounded shadow border-l-4 border-yellow-500">
        <p class="text-sm text-gray-500">Borxh klientë</p>
        <h2 class="text-2xl font-bold text-yellow-600">
            {{ $borxhKliente }} €
        </h2>
    </div>

    <!-- SHITJE SOT -->
    <div class="bg-white p-5 rounded shadow border-l-4 border-blue-600">
        <p class="text-sm text-gray-500">Shitje sot</p>
        <h2 class="text-2xl font-bold text-blue-600">
            {{ $shitjeSot }} €
        </h2>
    </div>

</div>

@endsection
