<div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">
    <div>
        <h2 class="text-base font-semibold text-neutral-900 dark:text-white">
            Estudos
        </h2>

        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
            Resumo operacional dos estudos por etapa.
        </p>
    </div>

    <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-neutral-200 p-4 dark:border-neutral-800">
            <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">
                Draft
            </p>

            <p class="mt-3 text-2xl font-semibold text-neutral-900 dark:text-white">
                {{ $studies['draft'] }}
            </p>
        </div>

        <div class="rounded-2xl border border-neutral-200 p-4 dark:border-neutral-800">
            <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">
                Recrutando
            </p>

            <p class="mt-3 text-2xl font-semibold text-neutral-900 dark:text-white">
                {{ $studies['recruiting'] }}
            </p>
        </div>

        <div class="rounded-2xl border border-neutral-200 p-4 dark:border-neutral-800">
            <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">
                Em campo
            </p>

            <p class="mt-3 text-2xl font-semibold text-neutral-900 dark:text-white">
                {{ $studies['fieldwork'] }}
            </p>
        </div>

        <div class="rounded-2xl border border-neutral-200 p-4 dark:border-neutral-800">
            <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">
                Encerrados
            </p>

            <p class="mt-3 text-2xl font-semibold text-neutral-900 dark:text-white">
                {{ $studies['completed'] }}
            </p>
        </div>
    </div>
</div>
