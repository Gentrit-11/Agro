@extends('layouts.app')

@section('title','Produktet')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Lista e Produkteve</h1>

    <livewire:products-table />
@endsection
