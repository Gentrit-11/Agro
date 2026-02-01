@extends('layouts.app')

@section('title', 'Detajet e Blerjes #' . $purchase->id)

@section('content')

    <div class="mb-3">
        <a href="{{ route('purchases.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kthehu te Blerjet
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">Informacione te Blerjes</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="text-muted small">Furnitori</div>
                    <div class="fw-semibold">{{ $purchase->supplier->company_name ?? '-' }}</div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="text-muted small">Data e Blerjes</div>
                    <div class="fw-semibold">{{ $purchase->purchase_date->format('d/m/Y') }}</div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="text-muted small">Nr. Fatures</div>
                    <div class="fw-semibold">{{ $purchase->invoice_number ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">Produktet e Blera</div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Produkti</th>
                    <th class="text-end">Kg</th>
                    <th class="text-end">Kuti</th>
                    <th class="text-end">Kg/Kuti</th>
                    <th class="text-end">&euro;/Kg</th>
                    <th class="text-end">Totali</th>
                </tr>
                </thead>
                <tbody>
                @forelse($purchase->items as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->product->name ?? '-' }}</td>
                        <td class="text-end">{{ rtrim(rtrim(number_format($item->quantity_base, 3), '0'), '.') }}</td>
                        <td class="text-end">{{ $item->package_quantity > 0 ? $item->package_quantity : '-' }}</td>
                        <td class="text-end">{{ $item->package_quantity > 0 && $item->quantity_base > 0 ? rtrim(rtrim(number_format($item->quantity_base / $item->package_quantity, 3), '0'), '.') : '-' }}</td>
                        <td class="text-end">{{ number_format($item->price_per_base_unit, 2) }} &euro;</td>
                        <td class="text-end">{{ number_format($item->total, 2) }} &euro;</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Nuk ka artikuj</td>
                    </tr>
                @endforelse
                </tbody>
                @if($purchase->items->isNotEmpty())
                    <tfoot class="table-light">
                    <tr>
                        <td colspan="6" class="text-end fw-bold">Totali i Blerjes</td>
                        <td class="text-end fw-bold">{{ number_format($purchase->total_amount, 2) }} &euro;</td>
                    </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

@endsection
