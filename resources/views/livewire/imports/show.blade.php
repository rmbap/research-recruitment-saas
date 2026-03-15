<div class="space-y-6">

    @if (session()->has('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-900 dark:bg-green-950 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-semibold">
                Revisão da importação
            </h1>

            <p class="text-sm text-neutral-500">
                {{ $import->original_filename }}
            </p>
        </div>

        <button
            wire:click="importValidRows"
            class="rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700"
        >
            Importar válidos
        </button>

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
                    <th class="p-2 text-left">Ações</th>
                </tr>
            </thead>

            <tbody>

            @foreach($rows as $row)

                <tr class="border-t">

                    <td class="p-2 align-top">
                        {{ $row->row_number }}
                    </td>

                    <td class="p-2 text-xs align-top">

                        @foreach($row->raw_data as $key => $value)

                            <div>
                                <strong>{{ $key }}</strong>:
                                {{ $value }}
                            </div>

                        @endforeach

                    </td>

                    <td class="p-2 align-top">

                        @if($row->status === 'valid')
                            <span class="text-green-600">✓ válido</span>
                        @endif

                        @if($row->status === 'suspicious')
                            <span class="text-yellow-600">⚠ suspeito</span>
                        @endif

                        @if($row->status === 'invalid')
                            <span class="text-red-600">✖ inválido</span>
                        @endif

                        @if($row->status === 'pending')
                            <span class="text-neutral-500">• pendente</span>
                        @endif

                    </td>

                    <td class="p-2 align-top">
                        <a
                            href="#"
                            wire:click.prevent="editRow({{ $row->id }})"
                            class="text-sm text-blue-600 underline cursor-pointer"
                        >
                            Editar
                        </a>
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    @if($editingRow)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
            <div class="max-h-[90vh] w-full max-w-4xl overflow-y-auto rounded-2xl bg-white p-6 shadow-2xl">
                <div class="mb-4 flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold">
                            Editar linha {{ $editingRow->row_number }}
                        </h2>
                        <p class="text-sm text-neutral-500">
                            Ajuste os campos abaixo e salve para marcar a linha como válida.
                        </p>
                    </div>

                    <button
                        type="button"
                        wire:click="cancelEdit"
                        class="rounded-lg px-3 py-1 text-sm text-neutral-500 hover:bg-neutral-100 hover:text-neutral-700"
                    >
                        Fechar
                    </button>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    @foreach($editingData as $key => $value)
                        <div>
                            <label class="mb-1 block text-sm font-medium text-neutral-700">
                                {{ $key }}
                            </label>

                            <input
                                type="text"
                                wire:model="editingData.{{ $key }}"
                                class="w-full rounded-lg border px-3 py-2 text-sm"
                            >
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex gap-2">
                    <button
                        type="button"
                        wire:click="saveRow"
                        class="rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700"
                    >
                        Salvar
                    </button>

                    <button
                        type="button"
                        wire:click="cancelEdit"
                        class="rounded-lg bg-neutral-200 px-4 py-2 text-sm font-medium text-neutral-800 hover:bg-neutral-300"
                    >
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div>
        {{ $rows->links() }}
    </div>

</div>
