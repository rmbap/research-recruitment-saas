<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">
                Importações
            </h1>
            <p class="text-sm text-neutral-500 dark:text-neutral-400">
                Envie bases em CSV, XLS ou XLSX para validar, revisar e importar participantes com mais segurança.
            </p>
        </div>

        <button
            type="button"
            class="inline-flex items-center justify-center rounded-lg bg-neutral-900 px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800 dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-200"
        >
            Nova importação
        </button>
    </div>

    @if (session()->has('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-900 dark:bg-green-950 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 dark:border-red-900 dark:bg-red-950 dark:text-red-200">
            <ul class="list-disc space-y-1 ps-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid gap-4 md:grid-cols-3">
        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            <div class="text-sm text-neutral-500 dark:text-neutral-400">
                Formatos aceitos
            </div>
            <div class="mt-2 text-base font-semibold text-neutral-900 dark:text-white">
                CSV, XLS e XLSX
            </div>
            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
                O sistema vai ler o cabeçalho do arquivo e sugerir o mapeamento das colunas.
            </p>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            <div class="text-sm text-neutral-500 dark:text-neutral-400">
                Fluxo do processo
            </div>
            <div class="mt-2 text-base font-semibold text-neutral-900 dark:text-white">
                Upload → sugestão → revisão
            </div>
            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
                Você confirma quais colunas correspondem a nome, telefone, e-mail e outros campos.
            </p>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            <div class="text-sm text-neutral-500 dark:text-neutral-400">
                Objetivo
            </div>
            <div class="mt-2 text-base font-semibold text-neutral-900 dark:text-white">
                Importar apenas dados confiáveis
            </div>
            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
                O processamento vai separar registros válidos, suspeitos e inválidos antes de gravar na base.
            </p>
        </div>
    </div>

    <div class="rounded-xl border border-dashed border-neutral-300 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
        <form method="POST" action="{{ route('imports.upload') }}" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf

            <div>
                <h2 class="text-base font-semibold text-neutral-900 dark:text-white">
                    Nova importação de base
                </h2>
                <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                    Selecione um arquivo para iniciar o fluxo de importação. No próximo passo, vamos ler o cabeçalho e sugerir o mapeamento das colunas.
                </p>
            </div>

            <div class="flex flex-col gap-3 md:flex-row md:items-center">
                <input
                    type="file"
                    name="upload_file"
                    accept=".csv,.xls,.xlsx"
                    class="block w-full rounded-lg border border-neutral-300 bg-white px-3 py-2 text-sm text-neutral-700 file:mr-4 file:rounded-md file:border-0 file:bg-neutral-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-neutral-800 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-200 dark:file:bg-white dark:file:text-neutral-900 dark:hover:file:bg-neutral-200"
                />

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-neutral-900 px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800 dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-200"
                >
                    Enviar arquivo
                </button>
            </div>

            <p class="text-xs text-neutral-500 dark:text-neutral-400">
                Tamanho máximo recomendado: 10 MB.
            </p>
        </form>
    </div>

    <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-neutral-900">
        <div class="border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
            <h2 class="text-base font-semibold text-neutral-900 dark:text-white">
                Histórico de importações
            </h2>
        </div>

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
