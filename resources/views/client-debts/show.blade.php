@extends('layouts.app')

@section('title', 'Borxhi - ' . $clientName)

@section('content')

    <div class="mb-3">
        <a href="{{ route('client-debts.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kthehu te Borxhet e Klienteve
        </a>
    </div>

    {{-- Client info --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">{{ $clientName }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="text-muted small">Totali Shitjeve</div>
                    <div class="fs-5 fw-bold">{{ number_format($totalSales, 2) }} &euro;</div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="text-muted small">Totali Paguar</div>
                    <div class="fs-5 fw-bold text-success">{{ number_format($totalPaid, 2) }} &euro;</div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="text-muted small">Borxhi i Mbetur</div>
                    <div class="fs-5 fw-bold text-danger">{{ number_format($totalDebt, 2) }} &euro;</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Unpaid sales --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">Shitje te Papaguara</div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th class="text-end">Totali</th>
                    <th class="text-end">Paguar</th>
                    <th class="text-end">Borxhi</th>
                    <th>Statusi</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($sales as $s)
                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>{{ $s->sale_date->format('d/m/Y') }}</td>
                        <td class="text-end">{{ number_format($s->total_amount, 2) }} &euro;</td>
                        <td class="text-end">{{ number_format($s->paid_amount, 2) }} &euro;</td>
                        <td class="text-end fw-bold text-danger">{{ number_format($s->remaining_amount, 2) }} &euro;</td>
                        <td>
                            @if($s->payment_status === 'partial')
                                <span class="badge bg-warning text-dark">Pjeserisht</span>
                            @else
                                <span class="badge bg-danger">Pa paguar</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('sales.show', $s) }}" class="btn btn-sm btn-outline-secondary">Shiko</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Nuk ka shitje te papaguara</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Payment forms for each unpaid sale --}}
    @foreach($sales as $s)
        @if($s->remaining_amount > 0)
            <div class="mb-3">
                <div class="small text-muted mb-1">Pagese per Shitjen #{{ $s->id }} (Borxhi: {{ number_format($s->remaining_amount, 2) }} &euro;)</div>
                @livewire('sale-payment-form', ['saleId' => $s->id, 'maxAmount' => $s->remaining_amount], key('sale-payment-'.$s->id))
            </div>
        @endif
    @endforeach

    {{-- Payment history --}}
    @php
        $allPayments = collect();
        foreach ($sales as $s) {
            foreach ($s->payments as $payment) {
                $allPayments->push((object)[
                    'sale_id' => $s->id,
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
                        <th>Shitja #</th>
                        <th class="text-end">Shuma</th>
                        <th>Shenime</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allPayments as $pay)
                        <tr>
                            <td>{{ $pay->payment_date->format('d/m/Y') }}</td>
                            <td>{{ $pay->sale_id }}</td>
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
