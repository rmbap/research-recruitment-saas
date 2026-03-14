<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">
                Importações
            </h1>
            <p class="text-sm text-neutral-500 dark:text-neutral-400">
                Envie bases em CSV, XLS ou XLSX para validar, revisar e importar participantes.
            </p>
        </div>

        <button
            type="button"
            class="inline-flex items-center rounded-lg bg-neutral-900 px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800 dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-200"
        >
            Nova importação
        </button>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            <div class="text-sm text-neutral-500 dark:text-neutral-400">Formatos aceitos</div>
            <div class="mt-2 text-base font-semibold text-neutral-900 dark:text-white">CSV, XLS e XLSX</div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            <div class="text-sm text-neutral-500 dark:text-neutral-400">Fluxo</div>
            <div class="mt-2 text-base font-semibold text-neutral-900 dark:text-white">Upload → validação → preview</div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            <div class="text-sm text-neutral-500 dark:text-neutral-400">Objetivo</div>
            <div class="mt-2 text-base font-semibold text-neutral-900 dark:text-white">Importar apenas dados confiáveis</div>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
        <table class="w-full text-sm">
            <thead class="border-b border-neutral-200 dark:border-neutral-700">
                <tr class="text-left text-neutral-500 dark:text-neutral-400">
                    <th class="p-4 font-medium">Arquivo</th>
                    <th class="p-4 font-medium">Status</th>
                    <th class="p-4 font-medium">Linhas</th>
                    <th class="p-4 font-medium">Válidas</th>
                    <th class="p-4 font-medium">Inválidas</th>
                    <th class="p-4 font-medium">Processada em</th>
                </tr>
            </thead>

            <tbody>
                @forelse($imports as $import)
                    <tr class="border-b border-neutral-100 dark:border-neutral-800">
                        <td class="p-4 font-medium text-neutral-900 dark:text-white">
                            {{ $import->original_filename }}
                        </td>
                        <td class="p-4 text-neutral-600 dark:text-neutral-300">
                            {{ ucfirst($import->status) }}
                        </td>
                        <td class="p-4 text-neutral-600 dark:text-neutral-300">
                            {{ $import->total_rows }}
                        </td>
                        <td class="p-4 text-neutral-600 dark:text-neutral-300">
                            {{ $import->valid_rows }}
                        </td>
                        <td class="p-4 text-neutral-600 dark:text-neutral-300">
                            {{ $import->invalid_rows }}
                        </td>
                        <td class="p-4 text-neutral-600 dark:text-neutral-300">
                            {{ $import->processed_at ? $import->processed_at->format('d/m/Y H:i') : '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-neutral-500 dark:text-neutral-400">
                            Nenhuma importação realizada ainda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
