@extends('layouts.app')

@section('title','Edit Produkt')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Produkt</h1>

<form method="POST"
      action="{{ route('products.update',$product) }}"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow max-w-lg">

@csrf
@method('PUT')

<div class="mb-4">
    <label>Emri</label>
    <input name="name" value="{{ $product->name }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Njësia</label>
    <select name="unit" class="w-full border p-2 rounded">
        @foreach(['kg','copë','litër'] as $u)
            <option value="{{ $u }}" @selected($product->unit==$u)>
                {{ $u }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label>Përshkrimi</label>
    <textarea name="description" class="w-full border p-2 rounded">
{{ $product->description }}</textarea>
</div>

@if($product->image)
<img src="{{ asset('storage/'.$product->image) }}"
     class="w-32 mb-3 rounded">
@endif

<div class="mb-4">
    <label>Ndrysho foto</label>
    <input type="file" name="image">
</div>

<div class="mb-4 flex gap-2">
    <input type="checkbox" name="is_active" value="1"
           @checked($product->is_active)>
    <label>Produkt aktiv</label>
</div>

<button class="bg-green-600 text-white px-4 py-2 rounded">
    Ruaj Ndryshimet
</button>

</form>
@endsection
