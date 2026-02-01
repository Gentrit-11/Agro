<div>

    <!-- SEARCH -->
    <div class="mb-3">
        <input
            type="text"
            wire:model.live="search"
            class="form-control w-100 w-md-50"
            placeholder="Kërko produkt..."
        >
    </div>

    <!-- ================= MOBILE (CARDS) ================= -->
    <div class="d-block d-md-none">
        @foreach($products as $product)
            <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex gap-3">

                    <img
                        src="{{ $product->image ? asset('storage/'.$product->image) : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2780%27 height=%2780%27%3E%3Crect width=%2780%27 height=%2780%27 fill=%27%23e9ecef%27/%3E%3Ctext x=%2750%%25%27 y=%2750%%25%27 dominant-baseline=%27middle%27 text-anchor=%27middle%27 fill=%27%236c757d%27 font-size=%2712%27%3EFoto%3C/text%3E%3C/svg%3E' }}"
                        class="rounded"
                        style="width:80px;height:80px;object-fit:cover"
                    >

                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                        <div class="text-muted small">{{ $product->unit }}</div>

                        <div class="small text-secondary mb-2">
                            {{ Str::limit($product->description, 80) }}
                        </div>

                        <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $product->is_active ? 'Aktiv' : 'Jo aktiv' }}
                        </span>

                        <div class="mt-2 d-flex gap-2">
                            <a href="{{ route('products.edit',$product) }}"
                               class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('products.toggle', $product) }}">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-outline-{{ $product->is_active ? 'danger' : 'success' }}">
                                    {{ $product->is_active ? 'Çaktivizo' : 'Aktivizo' }}
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    <!-- ================= DESKTOP (TABLE) ================= -->
    <div class="d-none d-md-block">
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Foto</th>
                        <th>Emri</th>
                        <th>Njësia</th>
                        <th>Përshkrimi</th>
                        <th>Statusi</th>
                        <th class="text-end">Veprime</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <img
                                    src="{{ $product->image ? asset('storage/'.$product->image) : 'data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2750%27 height=%2750%27%3E%3Crect width=%2750%27 height=%2750%27 fill=%27%23e9ecef%27/%3E%3Ctext x=%2750%%25%27 y=%2750%%25%27 dominant-baseline=%27middle%27 text-anchor=%27middle%27 fill=%27%236c757d%27 font-size=%2710%27%3EFoto%3C/text%3E%3C/svg%3E' }}"
                                    class="rounded"
                                    style="width:50px;height:50px;object-fit:cover"
                                >
                            </td>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td>{{ $product->unit }}</td>
                            <td class="text-muted">
                                {{ Str::limit($product->description, 120) }}
                            </td>
                            <td>
                                    <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $product->is_active ? 'Aktiv' : 'Jo aktiv' }}
                                    </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('products.edit',$product) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('products.toggle', $product) }}"
                                      class="d-inline">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-outline-{{ $product->is_active ? 'danger' : 'success' }}">
                                        {{ $product->is_active ? 'Çaktivizo' : 'Aktivizo' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
