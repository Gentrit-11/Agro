@extends('layouts.app')

@section('title', 'Detajet e Shitjes #' . $sale->id)

@section('content')

    <div class="mb-3">
        <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kthehu te Shitjet
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">Informacione te Shitjes</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="text-muted small">Klienti</div>
                    <div class="fw-semibold">{{ $sale->client_name ?? '-' }}</div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="text-muted small">Lloji</div>
                    <div class="fw-semibold">
                        @if($sale->sale_type === 'wholesale')
                            Shumice
                        @else
                            Pakice
                        @endif
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="text-muted small">Data e Shitjes</div>
                    <div class="fw-semibold">{{ $sale->sale_date->format('d/m/Y') }}</div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="text-muted small">Statusi</div>
                    <div>
                        @if($sale->payment_status === 'paid')
                            <span class="badge bg-success">Paguar</span>
                        @elseif($sale->payment_status === 'partial')
                            <span class="badge bg-warning text-dark">Pjeserisht</span>
                        @else
                            <span class="badge bg-danger">Pa paguar</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Payment summary --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">Pagesa</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="text-muted small">Totali</div>
                    <div class="fs-5 fw-bold">{{ number_format($sale->total_amount, 2) }} &euro;</div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="text-muted small">Paguar</div>
                    <div class="fs-5 fw-bold text-success">{{ number_format($sale->paid_amount, 2) }} &euro;</div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="text-muted small">Borxhi i Mbetur</div>
                    <div class="fs-5 fw-bold text-danger">{{ number_format($sale->remaining_amount, 2) }} &euro;</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">Produktet e Shitura</div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Produkti</th>
                    <th class="text-end">Sasia</th>
                    <th class="text-end">Kuti</th>
                    <th class="text-end">Sasia/Kuti</th>
                    <th class="text-end">Cmimi/Njesi</th>
                    <th class="text-end">Totali</th>
                </tr>
                </thead>
                <tbody>
                @forelse($sale->items as $i => $item)
                    @php
                        $unit = $item->product->unit ?? 'kg';
                        $isCope = str_starts_with(mb_strtolower($unit), 'cop');
                    @endphp
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->product->name ?? '-' }}</td>
                        <td class="text-end">
                            @if($isCope)
                                {{ (int) $item->quantity }} {{ $unit }}
                            @else
                                {{ rtrim(rtrim(number_format($item->quantity, 3), '0'), '.') }} {{ $unit }}
                            @endif
                        </td>
                        <td class="text-end">
                            @if(!$isCope && $item->package_quantity > 0)
                                {{ $item->package_quantity }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-end">
                            @if(!$isCope && $item->package_quantity > 0 && $item->quantity > 0)
                                {{ rtrim(rtrim(number_format($item->quantity / $item->package_quantity, 3), '0'), '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-end">{{ number_format($item->price, 2) }} &euro;/{{ $unit }}</td>
                        <td class="text-end">{{ number_format($item->total, 2) }} &euro;</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Nuk ka artikuj</td>
                    </tr>
                @endforelse
                </tbody>
                @if($sale->items->isNotEmpty())
                    <tfoot class="table-light">
                    <tr>
                        <td colspan="6" class="text-end fw-bold">Totali i Shitjes</td>
                        <td class="text-end fw-bold">{{ number_format($sale->total_amount, 2) }} &euro;</td>
                    </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

@endsection
