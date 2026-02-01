@extends('layouts.app')

@section('title','Shto Furnitor')

@section('content')

    <h5 class="fw-bold mb-4">Shto Furnitor të Ri</h5>

    <form method="POST"
          action="{{ route('suppliers.store') }}"
          class="bg-white p-4 rounded shadow-sm">
        @csrf

        <div class="row g-3">

            <!-- EMRI I KOMPANISË -->
            <div class="col-md-6">
                <label class="form-label">Emri i Kompanisë *</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>

            <!-- NUMRI I BIZNESIT -->
            <div class="col-md-6">
                <label class="form-label">Numri i Biznesit *</label>
                <input type="text" name="business_number" class="form-control">
            </div>

            <!-- TELEFON -->
            <div class="col-md-4">
                <label class="form-label">Telefon *</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <!-- PRONARI -->
            <div class="col-md-4">
                <label class="form-label">Pronari</label>
                <input type="text" name="owner_name" class="form-control">
            </div>

            <!-- STATUS -->
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" checked>
                    <label class="form-check-label">Furnitor aktiv</label>
                </div>
            </div>

            <!-- ADRESA -->
            <div class="col-md-6">
                <label class="form-label">Adresa *</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <!-- QYTETI -->
            <div class="col-md-3">
                <label class="form-label">Qyteti *</label>
                <input type="text" name="city" class="form-control" required>
            </div>

            <!-- SHTETI -->
            <div class="col-md-3">
                <label class="form-label">Shteti *</label>
                <select name="country" class="form-select" required>
                    <option value="MK">Maqedoni</option>
                    <option value="KS">Kosovë</option>
                    <option value="AL">Shqipëri</option>
                </select>
            </div>

            <!-- AFATI -->
            <div class="col-md-4">
                <label class="form-label">Afati i Pagesës (ditë)</label>
                <input type="number" name="payment_term_days" class="form-control" value="0">
            </div>

            <!-- LIMITI -->
            <div class="col-md-4">
                <label class="form-label">Limiti i Kreditit (€)</label>
                <input type="number" step="0.01" name="credit_limit" class="form-control">
            </div>

            <!-- SHËNIME -->
            <div class="col-12">
                <label class="form-label">Shënime</label>
                <textarea name="note" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end gap-2">
            <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">
                Anulo
            </a>
            <button class="btn btn-success">
                Ruaj Furnitorin
            </button>
        </div>
    </form>

@endsection
