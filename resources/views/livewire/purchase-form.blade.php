<div>
    <form wire:submit.prevent="save" class="card p-4">

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Furnitori</label>
                <select wire:model="supplier_id" class="form-select">
                    <option value="">-- zgjedh --</option>
                    @foreach($this->suppliers as $s)
                        <option value="{{ $s->id }}">{{ $s->company_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Data</label>
                <input type="date" wire:model="purchase_date" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Fatura</label>
                <input type="text" wire:model="invoice_number" class="form-control">
            </div>
        </div>

        <hr>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th>Produkt</th>
                <th>Kg</th>
                <th>Kuti</th>
                <th>Kg/Kuti</th>
                <th>€/Kg</th>
                <th>Total</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($items as $i => $row)
                <tr>
                    <td>
                        <select wire:model="items.{{ $i }}.product_id" class="form-select">
                            <option value="">--</option>
                            @foreach($this->products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <input type="number" step="0.01"
                               wire:model.live="items.{{ $i }}.quantity_base"
                               class="form-control">
                    </td>

                    <td>
                        <input type="number"
                               wire:model.live="items.{{ $i }}.package_quantity"
                               class="form-control">
                    </td>

                    <td>
                        <input type="number" step="0.01"
                               wire:model.live="items.{{ $i }}.base_per_package"
                               class="form-control">
                    </td>

                    <td>
                        <input type="number" step="0.01"
                               wire:model.live="items.{{ $i }}.price_per_base_unit"
                               class="form-control">
                    </td>

                    <td>
                        {{ number_format(
                            (
                                (
                                    ((float) $row['package_quantity'] > 0 && (float) $row['base_per_package'] > 0)
                                        ? (float) $row['package_quantity'] * (float) $row['base_per_package']
                                        : (float) $row['quantity_base']
                                )
                                * (float) $row['price_per_base_unit']
                            ),
                            2
                        ) }} €
                    </td>


                    <td>
                        <button type="button"
                                class="btn btn-danger btn-sm"
                                wire:click="removeRow({{ $i }})">✖</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <button type="button" class="btn btn-outline-secondary mb-3"
                wire:click="addRow">
            + Shto rresht
        </button>

        <div class="text-end">
            <button class="btn btn-success">
                Ruaj Blerjen
            </button>
        </div>
    </form>
</div>
