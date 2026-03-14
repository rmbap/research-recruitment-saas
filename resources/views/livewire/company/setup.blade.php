<div class="flex min-h-[60vh] items-center justify-center">
    <div class="w-full max-w-xl rounded-2xl border border-neutral-200 bg-white p-8 shadow-sm dark:border-neutral-700 dark:bg-neutral-900">

        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white">
                Configurar empresa
            </h1>

            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
                Antes de começar, precisamos criar a empresa que irá usar o sistema.
            </p>
        </div>

        @if (session()->has('success'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-900 dark:bg-green-950 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="save" class="flex flex-col gap-4">

            <div class="flex flex-col gap-1">
                <label class="text-sm font-medium text-neutral-700 dark:text-neutral-300">
                    Nome da empresa
                </label>

                <input
                    type="text"
                    wire:model="name"
                    placeholder="Ex: Instituto Pesquisa Brasil"
                    class="rounded-lg border border-neutral-300 px-3 py-2 text-sm focus:border-neutral-900 focus:outline-none dark:border-neutral-700 dark:bg-neutral-800 dark:text-white"
                >

                @error('name')
                    <span class="text-sm text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <button
                type="submit"
                class="mt-4 inline-flex items-center justify-center rounded-lg bg-neutral-900 px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800 dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-200"
            >
                Criar empresa
            </button>

        </form>

    </div>
</div>
