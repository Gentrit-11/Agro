<div>
    <form wire:submit.prevent="save" class="card p-4">

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Klienti</label>
                <input type="text" wire:model="client_name" class="form-control" placeholder="Emri i klientit (opsionale)">
            </div>

            <div class="col-md-4">
                <label class="form-label">Lloji i Shitjes</label>
                <select wire:model.live="sale_type" class="form-select">
                    <option value="retail">Pakice</option>
                    <option value="wholesale">Shumice</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Data</label>
                <input type="date" wire:model="sale_date" class="form-control">
            </div>
        </div>

        <hr>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th>Produkt</th>
                <th>Sasia</th>
                <th>Kuti</th>
                <th>Sasia/Kuti</th>
                <th>Cmimi/Njesi</th>
                <th>Total</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($items as $i => $row)
                @php
                    $unit = $row['unit'] ?? 'kg';
                    $isCope = str_starts_with(mb_strtolower($unit), 'cop');
                @endphp
                <tr>
                    <td>
                        <select wire:model.live="items.{{ $i }}.product_id" class="form-select">
                            <option value="">--</option>
                            @foreach($this->products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <input type="number" step="{{ $isCope ? '1' : '0.01' }}"
                               wire:model.live="items.{{ $i }}.quantity"
                               class="form-control"
                               placeholder="{{ $isCope ? $unit : 'Kg' }}">
                    </td>

                    <td>
                        @if(!$isCope)
                            <input type="number"
                                   wire:model.live="items.{{ $i }}.package_quantity"
                                   class="form-control">
                        @else
                            <input type="number" class="form-control" disabled placeholder="-">
                        @endif
                    </td>

                    <td>
                        @if(!$isCope)
                            <input type="number" step="0.01"
                                   wire:model.live="items.{{ $i }}.base_per_package"
                                   class="form-control">
                        @else
                            <input type="number" class="form-control" disabled placeholder="-">
                        @endif
                    </td>

                    <td>
                        <input type="number" step="0.01"
                               wire:model.live="items.{{ $i }}.price"
                               class="form-control"
                               placeholder="&euro;/{{ $isCope ? $unit : 'kg' }}">
                    </td>

                    <td>
                        @php
                            if ($isCope) {
                                $qty = (float) ($row['quantity'] ?? 0);
                            } else {
                                $pkgQty  = (float) ($row['package_quantity'] ?? 0);
                                $basePer = (float) ($row['base_per_package'] ?? 0);
                                $qty = ($pkgQty > 0 && $basePer > 0)
                                    ? $pkgQty * $basePer
                                    : (float) ($row['quantity'] ?? 0);
                            }
                            $rowTotal = $qty * (float) ($row['price'] ?? 0);
                        @endphp
                        {{ number_format($rowTotal, 2) }} &euro;
                    </td>

                    <td>
                        <button type="button"
                                class="btn btn-danger btn-sm"
                                wire:click="removeRow({{ $i }})">&#10006;</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <button type="button" class="btn btn-outline-secondary mb-3"
                wire:click="addRow">
            + Shto rresht
        </button>

        {{-- Payment section --}}
        <div class="card bg-light p-3 mb-3">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Totali</label>
                    <div class="fs-5 fw-bold">{{ number_format($this->grandTotal, 2) }} &euro;</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Pagesa</label>
                    <input type="number" step="0.01" min="0"
                           wire:model.live="paid_amount"
                           class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Borxhi</label>
                    <div class="fs-5 fw-bold {{ $this->debtDisplay > 0 ? 'text-danger' : 'text-success' }}">
                        {{ number_format($this->debtDisplay, 2) }} &euro;
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button class="btn btn-success">
                Ruaj Shitjen
            </button>
        </div>
    </form>
</div>
