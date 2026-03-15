<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-semibold">
            Revisão da importação
        </h1>

        <p class="text-sm text-neutral-500">
            {{ $import->original_filename }}
        </p>
    </div>

    <div class="flex gap-2">

        <button wire:click="setFilter('all')" class="px-3 py-1 border rounded">
            Todos
        </button>

        <button wire:click="setFilter('valid')" class="px-3 py-1 border rounded bg-green-50">
            Válidos
        </button>

        <button wire:click="setFilter('suspicious')" class="px-3 py-1 border rounded bg-yellow-50">
            Suspeitos
        </button>

        <button wire:click="setFilter('invalid')" class="px-3 py-1 border rounded bg-red-50">
            Inválidos
        </button>

    </div>

    <div class="border rounded-xl overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-neutral-100">
                <tr>
                    <th class="p-2 text-left">Linha</th>
                    <th class="p-2 text-left">Dados</th>
                    <th class="p-2 text-left">Status</th>
                </tr>
            </thead>

            <tbody>

            @foreach($rows as $row)

                <tr class="border-t">

                    <td class="p-2">
                        {{ $row->row_number }}
                    </td>

                    <td class="p-2 text-xs">

                        @foreach($row->raw_data as $key => $value)

                            <div>
                                <strong>{{ $key }}</strong>:
                                {{ $value }}
                            </div>

                        @endforeach

                    </td>

                    <td class="p-2">

                        @if($row->status === 'valid')
                            <span class="text-green-600">✓ válido</span>
                        @endif

                        @if($row->status === 'suspicious')
                            <span class="text-yellow-600">⚠ suspeito</span>
                        @endif

                        @if($row->status === 'invalid')
                            <span class="text-red-600">✖ inválido</span>
                        @endif

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    <div>
        {{ $rows->links() }}
    </div>

</div>
