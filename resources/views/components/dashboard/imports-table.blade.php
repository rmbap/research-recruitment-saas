@props([
    'recentImports' => collect(),
])

<div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
    <div>
        <h2 class="text-base font-semibold text-neutral-900 dark:text-white">
            Importações recentes
        </h2>

        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
            Histórico das últimas bases enviadas para validação e limpeza.
        </p>
    </div>

    <div class="mt-5 overflow-hidden rounded-2xl border border-neutral-200 dark:border-neutral-800">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-800">
                <thead class="bg-neutral-50 dark:bg-neutral-950/40">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500 dark:text-neutral-400">
                            Arquivo
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500 dark:text-neutral-400">
                            Linhas
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500 dark:text-neutral-400">
                            Válidas
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500 dark:text-neutral-400">
                            Inconsistentes
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500 dark:text-neutral-400">
                            Status
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500 dark:text-neutral-400">
                            Data
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-neutral-200 bg-white dark:divide-neutral-800 dark:bg-neutral-900">
                    @forelse ($recentImports as $import)
                        <tr>
                            <td class="px-4 py-4 text-sm text-neutral-900 dark:text-white">
                                {{ $import->original_filename ?? $import->file_name ?? 'Arquivo sem nome' }}
                            </td>

                            <td class="px-4 py-4 text-sm text-neutral-600 dark:text-neutral-300">
                                {{ $import->total_rows ?? 0 }}
                            </td>

                            <td class="px-4 py-4 text-sm text-neutral-600 dark:text-neutral-300">
                                {{ $import->valid_rows ?? 0 }}
                            </td>

                            <td class="px-4 py-4 text-sm text-neutral-600 dark:text-neutral-300">
                                {{ $import->suspicious_rows ?? 0 }}
                            </td>

                            <td class="px-4 py-4 text-sm text-neutral-600 dark:text-neutral-300">
                                {{ $import->status ?? '-' }}
                            </td>

                            <td class="px-4 py-4 text-sm text-neutral-600 dark:text-neutral-300">
                                {{ optional($import->created_at)->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-sm text-neutral-500 dark:text-neutral-400">
                                Nenhuma importação processada ainda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
