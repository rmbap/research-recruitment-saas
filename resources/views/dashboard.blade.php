<x-layouts.app :title="__('Dashboard')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <div>
            <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">
                Dashboard
            </h1>

            <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                Visão geral da base, estudos e importações.
            </p>
        </div>

        <x-dashboard.stats-cards />

        <div class="grid gap-4 xl:grid-cols-3">

            <div class="xl:col-span-2">
                <x-dashboard.studies-overview />
            </div>

            <x-dashboard.alerts-panel />

        </div>

        <x-dashboard.imports-table />

    </div>

</x-layouts.app>
