<div>
    <form wire:submit.prevent="save" class="card p-3 bg-light">
        <h6 class="fw-bold mb-3">Regjistro Pagese</h6>
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small">Shuma</label>
                <input type="number" step="0.01" min="0.01" max="{{ $max_amount }}"
                       wire:model="amount"
                       class="form-control"
                       placeholder="0.00">
                @error('amount') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-3">
                <label class="form-label small">Data</label>
                <input type="date" wire:model="payment_date" class="form-control">
                @error('payment_date') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label small">Shenime</label>
                <input type="text" wire:model="note" class="form-control" placeholder="Opsionale">
            </div>
            <div class="col-md-2">
                <button class="btn btn-success w-100">Paguaj</button>
            </div>
        </div>
    </form>
</div>
