@extends('layouts.app')

@section('title','Shto Produkt')

@section('content')
<h1 class="text-2xl font-bold mb-6">Shto Produkt</h1>

<form method="POST" action="{{ route('products.store') }}"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow max-w-lg">

@csrf

<div class="mb-4">
    <label>Emri</label>
    <input name="name" class="w-full border p-2 rounded" required>
</div>

<div class="mb-4">
    <label>Njësia</label>
    <select name="unit" class="w-full border p-2 rounded">
        <option value="kg">kg</option>
        <option value="copë">copë</option>
        <option value="litër">litër</option>
    </select>
</div>

<div class="mb-4">
    <label>Përshkrimi</label>
    <textarea name="description" class="w-full border p-2 rounded"></textarea>
</div>

<div class="mb-4">
    <label>Foto (opsionale)</label>
    <input type="file" name="image" class="w-full">
</div>

<button class="bg-green-600 text-white px-4 py-2 rounded">
    Ruaj
</button>

</form>
@endsection
