@extends('layouts.app')

@section('title','Edit Produkt')

@section('content')

    <h1 class="fw-bold mb-4">Edit Produkt</h1>

    <div class="row">
        <div class="col-12 col-lg-6">

            <form method="POST"
                  action="{{ route('products.update',$product) }}"
                  enctype="multipart/form-data"
                  class="card shadow-sm">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Emri</label>
                        <input
                            name="name"
                            value="{{ $product->name }}"
                            class="form-control"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Njësia</label>
                        <select name="unit" class="form-select">
                            @foreach(['kg','copë','litër'] as $u)
                                <option value="{{ $u }}" @selected($product->unit==$u)>
                                    {{ $u }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Përshkrimi</label>
                        <textarea
                            name="description"
                            rows="4"
                            class="form-control"
                        >{{ $product->description }}</textarea>
                    </div>

                    @if($product->image)
                        <div class="mb-3">
                            <label class="form-label d-block">Foto aktuale</label>
                            <img
                                src="{{ asset('storage/'.$product->image) }}"
                                class="img-thumbnail"
                                style="max-width: 180px;"
                            >
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Ndrysho foto</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="form-check mb-4">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="is_active"
                            value="1"
                            id="isActive"
                            @checked($product->is_active)
                        >
                        <label class="form-check-label" for="isActive">
                            Produkt aktiv
                        </label>
                    </div>

                    <button class="btn btn-success">
                        Ruaj Ndryshimet
                    </button>

                </div>
            </form>

        </div>
    </div>

@endsection
