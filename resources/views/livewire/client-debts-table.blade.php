<div>
    <div class="card p-4">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text"
                       wire:model.live="search"
                       class="form-control"
                       placeholder="Kerko sipas klientit">
            </div>
        </div>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th>Klienti</th>
                <th class="text-end">Totali Shitjeve</th>
                <th class="text-end">Totali Paguar</th>
                <th class="text-end">Borxhi</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @forelse($clients as $c)
                <tr>
                    <td>{{ $c->client_name }}</td>
                    <td class="text-end">{{ number_format($c->total_sales, 2) }} &euro;</td>
                    <td class="text-end">{{ number_format($c->total_paid, 2) }} &euro;</td>
                    <td class="text-end fw-bold text-danger">{{ number_format($c->outstanding_debt, 2) }} &euro;</td>
                    <td class="text-center">
                        <a href="{{ route('client-debts.show', urlencode($c->client_name)) }}" class="btn btn-sm btn-outline-primary">
                            Detaje
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Nuk ka borxhe te papaguara
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $clients->links() }}
        </div>
    </div>
</div>
