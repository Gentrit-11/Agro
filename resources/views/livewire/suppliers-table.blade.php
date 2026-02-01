<div>
    <!-- SEARCH -->
    <input type="text"
           wire:model.live="search"
           class="form-control mb-3"
           placeholder="Kërko furnitor...">

    {{-- MOBILE --}}
    <div class="d-block d-lg-none">
        @foreach($suppliers as $supplier)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold">
                        {{ $supplier->company_name }}
                    </h6>

                    <p class="mb-1 text-muted">
                        {{ $supplier->phone ?? '—' }}
                    </p>

                    <span class="badge {{ $supplier->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $supplier->is_active ? 'Aktiv' : 'Jo aktiv' }}
                    </span>

                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ route('suppliers.edit', $supplier) }}"
                           class="btn btn-sm btn-outline-primary">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('suppliers.toggle', $supplier) }}">
                            @csrf
                            @method('PATCH')

                            <button
                                class="btn btn-sm {{ $supplier->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                {{ $supplier->is_active ? 'Çaktivizo' : 'Aktivizo' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- DESKTOP --}}
    <div class="d-none d-lg-block">
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-light">
            <tr>
                <th>Kompania</th>
                <th>Telefoni</th>
                <th>Statusi</th>
                <th class="text-end">Veprime</th>
            </tr>
            </thead>
            <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->company_name }}</td>
                    <td>{{ $supplier->phone ?? '—' }}</td>
                    <td>
                        <span class="badge {{ $supplier->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $supplier->is_active ? 'Aktiv' : 'Jo aktiv' }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('suppliers.edit', $supplier) }}"
                           class="btn btn-sm btn-outline-primary">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('suppliers.toggle', $supplier) }}"
                              class="d-inline">
                            @csrf
                            @method('PATCH')

                            <button
                                class="btn btn-sm {{ $supplier->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                {{ $supplier->is_active ? 'Çaktivizo' : 'Aktivizo' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
