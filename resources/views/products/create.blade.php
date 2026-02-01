@extends('layouts.app')

@section('title','Shto Produkt')

@section('content')

    <h1 class="fw-bold mb-4">Shto Produkt</h1>

    <div class="row">
        <div class="col-12 col-lg-6">

            <form method="POST"
                  action="{{ route('products.store') }}"
                  enctype="multipart/form-data"
                  class="card shadow-sm">

                <div class="card-body">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Emri</label>
                        <input name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Njësia</label>
                        <select name="unit" class="form-select">
                            <option value="kg">kg</option>
                            <option value="copë">copë</option>
                            <option value="litër">litër</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Përshkrimi</label>
                        <textarea name="description"
                                  rows="4"
                                  class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto (opsionale)</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <button class="btn btn-success">
                        Ruaj
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
