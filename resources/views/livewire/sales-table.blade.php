<div>
    <div class="card p-4">

        <div class="row mb-3">
            <div class="col-md-4">
            </div>
            <div class="col-md-8 text-end">
                <a href="{{ route('sales.create') }}" class="btn btn-success">
                    + Shto Shitje
                </a>
            </div>
        </div>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Klienti</th>
                <th>Lloji</th>
                <th>Data</th>
                <th class="text-end">Totali (&euro;)</th>
                <th class="text-end">Borxhi (&euro;)</th>
                <th>Statusi</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @forelse($sales as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->client_name ?? '-' }}</td>
                    <td>
                        @if($s->sale_type === 'wholesale')
                            <span class="badge bg-info text-dark">Shumice</span>
                        @else
                            <span class="badge bg-secondary">Pakice</span>
                        @endif
                    </td>
                    <td>{{ $s->sale_date->format('d/m/Y') }}</td>
                    <td class="text-end">{{ number_format($s->total_amount, 2) }} &euro;</td>
                    <td class="text-end">{{ number_format($s->remaining_amount, 2) }} &euro;</td>
                    <td>
                        @if($s->payment_status === 'paid')
                            <span class="badge bg-success">Paguar</span>
                        @elseif($s->payment_status === 'partial')
                            <span class="badge bg-warning text-dark">Pjeserisht</span>
                        @else
                            <span class="badge bg-danger">Pa paguar</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('sales.show', $s) }}" class="btn btn-sm btn-outline-secondary">
                            Shiko
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Nuk ka shitje
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $sales->links() }}
        </div>

    </div>
</div>
