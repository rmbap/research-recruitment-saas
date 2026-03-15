@props([
    'alerts' => [],
])

<div class="rounded-2xl border border-neutral-200 bg-white p-5 shadow-sm dark:border-neutral-800 dark:bg-neutral-900">

    <div>
        <h2 class="text-base font-semibold text-neutral-900 dark:text-white">
            Alertas
        </h2>

        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
            Sinais operacionais que merecem atenção.
        </p>
    </div>

    <div class="mt-5 space-y-3">

        @forelse ($alerts as $alert)

            <div class="rounded-xl border border-yellow-200 bg-yellow-50 p-4 dark:border-yellow-900/40 dark:bg-yellow-900/10">

                <div class="text-sm font-semibold text-yellow-800 dark:text-yellow-300">
                    {{ $alert['title'] }}
                </div>

                <div class="mt-1 text-sm text-yellow-700 dark:text-yellow-400">
                    {{ $alert['message'] }}
                </div>

            </div>

        @empty

            <div class="rounded-xl border border-dashed border-neutral-300 p-4 text-sm text-neutral-500 dark:border-neutral-700 dark:text-neutral-400">
                Nenhum alerta crítico no momento.
                <div class="mt-1 text-xs">
                    Conforme o sistema ganhar dados reais, esta área exibirá inconsistências,
                    duplicidades e estudos que exigem ação.
                </div>
            </div>

        @endforelse

    </div>

</div>
