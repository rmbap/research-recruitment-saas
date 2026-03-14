<x-layouts.app :title="'Organizations'">

<div class="flex flex-col gap-6">

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">
            Organizations
        </h1>

        <button class="px-4 py-2 rounded-lg bg-black text-white text-sm">
            New organization
        </button>
    </div>

    <div class="bg-white rounded-xl border border-neutral-200 dark:bg-neutral-900 dark:border-neutral-700">

        <table class="w-full text-sm">

            <thead class="border-b border-neutral-200 dark:border-neutral-700">
                <tr class="text-left">
                    <th class="p-4">Name</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Created</th>
                </tr>
            </thead>

            <tbody>

                @forelse($organizations as $org)

                    <tr class="border-b border-neutral-100 dark:border-neutral-800">
                        <td class="p-4 font-medium">
                            {{ $org->name }}
                        </td>

                        <td class="p-4">
                            {{ $org->status }}
                        </td>

                        <td class="p-4">
                            {{ $org->created_at->format('d/m/Y') }}
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="p-6 text-center text-neutral-500">
                            No organizations yet
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-layouts.app>
