@extends('layouts.app')

@section('title','Edit Furnitor')

@section('content')

    <h5 class="fw-bold mb-4">Edit Furnitor</h5>

    <form method="POST"
          action="{{ route('suppliers.update', $supplier) }}"
          class="bg-white p-4 rounded shadow-sm">

        @csrf
        @method('PUT')

        <div class="row g-3">

            <!-- EMRI I KOMPANISË -->
            <div class="col-md-6">
                <label class="form-label">Emri i Kompanisë *</label>
                <input type="text"
                       name="company_name"
                       class="form-control"
                       value="{{ old('company_name', $supplier->company_name) }}"
                       required>
            </div>

            <!-- NUMRI I BIZNESIT -->
            <div class="col-md-6">
                <label class="form-label">Numri i Biznesit *</label>
                <input type="text"
                       name="business_number"
                       class="form-control"
                       value="{{ old('business_number', $supplier->business_number) }}"
                       required>
            </div>

            <!-- PRONARI -->
            <div class="col-md-4">
                <label class="form-label">Pronari *</label>
                <input type="text"
                       name="owner_name"
                       class="form-control"
                       value="{{ old('owner_name', $supplier->owner_name) }}"
                       required>
            </div>

            <!-- TELEFON -->
            <div class="col-md-4">
                <label class="form-label">Telefon *</label>
                <input type="text"
                       name="phone"
                       class="form-control"
                       value="{{ old('phone', $supplier->phone) }}"
                       required>
            </div>

            <!-- STATUS -->
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           value="1"
                        {{ $supplier->is_active ? 'checked' : '' }}>
                    <label class="form-check-label">
                        Furnitor aktiv
                    </label>
                </div>
            </div>

            <!-- ADRESA -->
            <div class="col-md-6">
                <label class="form-label">Adresa *</label>
                <input type="text"
                       name="address"
                       class="form-control"
                       value="{{ old('address', $supplier->address) }}"
                       required>
            </div>

            <!-- QYTETI -->
            <div class="col-md-3">
                <label class="form-label">Qyteti *</label>
                <input type="text"
                       name="city"
                       class="form-control"
                       value="{{ old('city', $supplier->city) }}"
                       required>
            </div>

            <!-- SHTETI -->
            <div class="col-md-3">
                <label class="form-label">Shteti *</label>
                <select name="country" class="form-select" required>
                    <option value="MK" {{ $supplier->country === 'MK' ? 'selected' : '' }}>Maqedoni</option>
                    <option value="KS" {{ $supplier->country === 'KS' ? 'selected' : '' }}>Kosovë</option>
                    <option value="AL" {{ $supplier->country === 'AL' ? 'selected' : '' }}>Shqipëri</option>
                </select>
            </div>

            <!-- AFATI I PAGESËS -->
            <div class="col-md-4">
                <label class="form-label">Afati i Pagesës (ditë)</label>
                <input type="number"
                       name="payment_term_days"
                       class="form-control"
                       value="{{ old('payment_term_days', $supplier->payment_term_days) }}">
            </div>

            <!-- LIMITI I KREDITIT -->
            <div class="col-md-4">
                <label class="form-label">Limiti i Kreditit (€)</label>
                <input type="number"
                       step="0.01"
                       name="credit_limit"
                       class="form-control"
                       value="{{ old('credit_limit', $supplier->credit_limit) }}">
            </div>

            <!-- SHËNIME -->
            <div class="col-12">
                <label class="form-label">Shënime</label>
                <textarea name="note"
                          class="form-control"
                          rows="3">{{ old('note', $supplier->note) }}</textarea>
            </div>

        </div>

        <!-- BUTTONS -->
        <div class="mt-4 d-flex justify-content-between">

            <a href="{{ route('suppliers.index') }}"
               class="btn btn-outline-secondary">
                Kthehu
            </a>

            <button class="btn btn-success">
                Ruaj Ndryshimet
            </button>
        </div>

    </form>

@endsection
