@extends('layouts.app')

@section('title', 'Borxhi - ' . $supplier->company_name)

@section('content')

    <div class="mb-3">
        <a href="{{ route('debts.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kthehu te Borxhet
        </a>
    </div>

    {{-- Supplier info --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">{{ $supplier->company_name }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="text-muted small">Totali Blerjeve</div>
                    <div class="fs-5 fw-bold">{{ number_format($totalPurchases, 2) }} &euro;</div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="text-muted small">Totali Paguar</div>
                    <div class="fs-5 fw-bold text-success">{{ number_format($totalPaid, 2) }} &euro;</div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="text-muted small">Borxhi i Mbetur</div>
                    <div class="fs-5 fw-bold text-danger">{{ number_format($totalDebt, 2) }} &euro;</div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="text-muted small">Telefoni</div>
                    <div class="fw-semibold">{{ $supplier->phone ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Unpaid purchases --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">Blerje te Papaguara</div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>Fatura</th>
                    <th class="text-end">Totali</th>
                    <th class="text-end">Paguar</th>
                    <th class="text-end">Borxhi</th>
                    <th>Statusi</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($supplier->purchases as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->purchase_date->format('d/m/Y') }}</td>
                        <td>{{ $p->invoice_number ?? '-' }}</td>
                        <td class="text-end">{{ number_format($p->total_amount, 2) }} &euro;</td>
                        <td class="text-end">{{ number_format($p->paid_amount, 2) }} &euro;</td>
                        <td class="text-end fw-bold text-danger">{{ number_format($p->debt_amount, 2) }} &euro;</td>
                        <td>
                            @if($p->payment_status === 'partial')
                                <span class="badge bg-warning text-dark">Pjeserisht</span>
                            @else
                                <span class="badge bg-danger">Pa paguar</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('purchases.show', $p) }}" class="btn btn-sm btn-outline-secondary">Shiko</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Nuk ka blerje te papaguara</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Payment forms for each unpaid purchase --}}
    @foreach($supplier->purchases as $p)
        @if($p->debt_amount > 0)
            <div class="mb-3">
                <div class="small text-muted mb-1">Pagese per Blerjen #{{ $p->id }} (Borxhi: {{ number_format($p->debt_amount, 2) }} &euro;)</div>
                @livewire('payment-form', ['purchaseId' => $p->id, 'maxAmount' => $p->debt_amount], key('payment-'.$p->id))
            </div>
        @endif
    @endforeach

    {{-- Payment history --}}
    @php
        $allPayments = collect();
        foreach ($supplier->purchases as $p) {
            foreach ($p->payments as $payment) {
                $allPayments->push((object)[
                    'purchase_id' => $p->id,
                    'amount' => $payment->amount,
                    'payment_date' => $payment->payment_date,
                    'note' => $payment->note,
                ]);
            }
        }
        $allPayments = $allPayments->sortByDesc('payment_date');
    @endphp

    @if($allPayments->isNotEmpty())
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">Historiku i Pagesave</div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Data</th>
                        <th>Blerja #</th>
                        <th class="text-end">Shuma</th>
                        <th>Shenime</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allPayments as $pay)
                        <tr>
                            <td>{{ $pay->payment_date->format('d/m/Y') }}</td>
                            <td>{{ $pay->purchase_id }}</td>
                            <td class="text-end">{{ number_format($pay->amount, 2) }} &euro;</td>
                            <td>{{ $pay->note ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection
