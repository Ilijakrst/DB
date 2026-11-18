<x-app-layout title="Склад">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white font-mono">🏭 Склад комплектующих</h1>
            <a href="{{ route('storage.create') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-sm font-semibold transition">
                + Добавить запись
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-950/50 text-emerald-400 font-mono text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Комплектующее</th>
                        <th class="px-6 py-3 text-left">Количество</th>
                        <th class="px-6 py-3 text-left">Место хранения</th>
                        <th class="px-6 py-3 text-right">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($storages as $item)
                        <tr class="hover:bg-slate-800/50">
                            <td class="px-6 py-4 text-slate-400 font-mono">#{{ $item->IDstorage }}</td>
                            <td class="px-6 py-4 font-semibold text-white">{{ $item->product->pcName ?? '—' }}</td>
                            <td class="px-6 py-4 text-emerald-400 font-mono">{{ $item->sCount }} шт.</td>
                            <td class="px-6 py-4 text-slate-300">{{ $item->lsName }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('storage.edit', $item->IDstorage) }}" class="text-amber-400 hover:text-amber-300">✏️</a>
                                <form action="{{ route('storage.destroy', $item->IDstorage) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Удалить?')" class="text-red-400 hover:text-red-300">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">Склад пуст</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $storages->links() }}</div>
    </div>
</x-app-layout>