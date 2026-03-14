<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">
                Contatos
            </h1>
            <p class="text-sm text-neutral-500 dark:text-neutral-400">
                Visualize e gerencie a base global de participantes da sua operação.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button
                type="button"
                class="inline-flex items-center rounded-lg border border-neutral-300 px-4 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-100 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-800"
            >
                Importar base
            </button>

            <button
                type="button"
                class="inline-flex items-center rounded-lg bg-neutral-900 px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800 dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-200"
            >
                Novo contato
            </button>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
        <table class="w-full text-sm">
            <thead class="border-b border-neutral-200 dark:border-neutral-700">
                <tr class="text-left text-neutral-500 dark:text-neutral-400">
                    <th class="p-4 font-medium">Nome</th>
                    <th class="p-4 font-medium">E-mail</th>
                    <th class="p-4 font-medium">Telefone</th>
                    <th class="p-4 font-medium">Cidade</th>
                    <th class="p-4 font-medium">Status de validação</th>
                </tr>
            </thead>

            <tbody>
                @forelse($contacts as $contact)
                    <tr class="border-b border-neutral-100 dark:border-neutral-800">
                        <td class="p-4 font-medium text-neutral-900 dark:text-white">
                            {{ $contact->full_name }}
                        </td>
                        <td class="p-4 text-neutral-600 dark:text-neutral-300">
                            {{ $contact->email ?: '—' }}
                        </td>
                        <td class="p-4 text-neutral-600 dark:text-neutral-300">
                            {{ $contact->phone ?: '—' }}
                        </td>
                        <td class="p-4 text-neutral-600 dark:text-neutral-300">
                            {{ $contact->city ?: '—' }}
                        </td>
                        <td class="p-4 text-neutral-600 dark:text-neutral-300">
                            {{ ucfirst($contact->validation_status) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-neutral-500 dark:text-neutral-400">
                            Nenhum contato cadastrado ainda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
