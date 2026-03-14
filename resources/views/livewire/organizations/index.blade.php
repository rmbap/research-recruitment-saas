<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">
                Organizações
            </h1>
            <p class="text-sm text-neutral-500 dark:text-neutral-400">
                Gerencie as empresas ou projetos para os quais sua equipe recruta participantes.
            </p>
        </div>

        <button
            type="button"
            class="inline-flex items-center rounded-lg bg-neutral-900 px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800 dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-200"
        >
            Nova organização
        </button>
    </div>

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
        <table class="w-full text-sm">
            <thead class="border-b border-neutral-200 dark:border-neutral-700">
                <tr class="text-left text-neutral-500 dark:text-neutral-400">
                    <th class="p-4 font-medium">Nome</th>
                    <th class="p-4 font-medium">Status</th>
                    <th class="p-4 font-medium">Criado em</th>
                </tr>
            </thead>

            <tbody>
                @forelse($organizations as $organization)
                    <tr class="border-b border-neutral-100 dark:border-neutral-800">
                        <td class="p-4 font-medium text-neutral-900 dark:text-white">
                            {{ $organization->name }}
                        </td>
                        <td class="p-4 text-neutral-600 dark:text-neutral-300">
                            {{ ucfirst($organization->status) }}
                        </td>
                        <td class="p-4 text-neutral-600 dark:text-neutral-300">
                            {{ $organization->created_at->format('d/m/Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-8 text-center text-neutral-500 dark:text-neutral-400">
                            Nenhuma organização cadastrada ainda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
