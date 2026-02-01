<div>

    <div class="card p-4">

        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text"
                       wire:model.live="search"
                       class="form-control"
                       placeholder="🔍 Kërko sipas furnitorit">
            </div>

            <div class="col-md-8 text-end">
                <a href="{{ route('purchases.create') }}" class="btn btn-success">
                    + Shto Blerje
                </a>
            </div>
        </div>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Furnitori</th>
                <th>Data</th>
                <th>Totali (€)</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @forelse($purchases as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->supplier->company_name ?? '-' }}</td>
                    <td>{{ $p->purchase_date }}</td>
                    <td>{{ number_format($p->total_amount, 2) }} €</td>
                    <td class="text-center">
                        <a href="{{ route('purchases.show', $p) }}" class="btn btn-sm btn-outline-secondary">
                            Shiko
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Nuk ka blerje
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $purchases->links() }}
        </div>

    </div>

</div>
