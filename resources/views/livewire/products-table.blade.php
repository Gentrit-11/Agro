<div> {{-- ROOT ELEMENT – I DETYRUESHËM, MOS E HEK --}}

    <!-- SEARCH -->
    <input type="text"
        wire:model.live="search"
        placeholder="Kërko produkt..."
        class="border rounded px-3 py-2 w-full max-w-sm mb-6"/>
            {{-- ================= MOBILE ================= --}}
    <div class="grid gap-4 sm:hidden">
        @foreach ($products as $product)
            <div class="bg-white p-4 rounded shadow flex gap-3">
                <img
                    src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/80' }}"
                    class="w-20 h-20 object-cover rounded"
                >

                <div class="flex-1">
                    <h3 class="font-bold">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $product->unit }}</p>

                    <p class="text-sm text-gray-600 line-clamp-3">
                        {{ $product->description ?? '—' }}
                    </p>

                    <span
                        class="inline-block mt-2 px-2 py-1 text-xs rounded
                        {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $product->is_active ? 'Aktiv' : 'Jo aktiv' }}
                    </span>

                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('products.edit',$product) }}"
                           class="px-3 py-1 bg-blue-600 text-white rounded text-sm">
                           Edit
                        </a>

                        @if($product->is_active)
                        <form method="POST" action="{{ route('products.destroy',$product) }}">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded text-sm">
                                Çaktivizo
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ================= DESKTOP ================= --}}
    <div class="hidden sm:block">
        <table class="w-full bg-white rounded shadow table-fixed">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 w-24 text-left">Foto</th>
                    <th class="p-3 w-48 text-left">Emri</th>
                    <th class="p-3 w-24 text-left">Njësia</th>
                    <th class="p-3 text-left">Përshkrimi</th>
                    <th class="p-3 w-24 text-left">Statusi</th>
                    <th class="p-3 w-40 text-right">Veprime</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                    <tr class="border-t align-top">
                        <td class="p-3">
                            <img
                                src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/50' }}"
                                class="w-12 h-12 object-cover rounded"
                            >
                        </td>

                        <td class="p-3 font-medium">{{ $product->name }}</td>
                        <td class="p-3">{{ $product->unit }}</td>

                        <td class="p-3 text-gray-600 max-w-xl">
                            <div class="line-clamp-3 break-words">
                                {{ $product->description ?? '—' }}
                            </div>
                        </td>

                        <td class="p-3">
                            <span
                                class="px-2 py-1 text-xs rounded
                                {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $product->is_active ? 'Aktiv' : 'Jo aktiv' }}
                            </span>
                        </td>

                        <td class="p-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('products.edit',$product) }}"
                                   class="px-3 py-1 bg-blue-600 text-white rounded text-sm">
                                   Edit
                                </a>

                                @if($product->is_active)
                                <form method="POST" action="{{ route('products.destroy',$product) }}">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded text-sm">
                                        Çaktivizo
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
