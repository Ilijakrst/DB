<x-app-layout title="Категории">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white font-mono">🏷️ Категории комплектующих</h1>
            <a href="{{ route('types.create') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-sm font-semibold">+ Добавить</a>
        </div>

        @if(session('success')) <div class="mb-4 p-4 rounded-xl bg-emerald-500/10 text-emerald-400">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="mb-4 p-4 rounded-xl bg-red-500/10 text-red-400">{{ session('error') }}</div> @endif

        <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-950/50 text-emerald-400 font-mono text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Название</th>
                        <th class="px-6 py-3 text-left">Комплектующих</th>
                        <th class="px-6 py-3 text-right">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @foreach($types as $type)
                        <tr class="hover:bg-slate-800/50">
                            <td class="px-6 py-4 text-slate-400 font-mono">#{{ $type->IDtp }}</td>
                            <td class="px-6 py-4 font-semibold text-white">{{ $type->tpName }}</td>
                            <td class="px-6 py-4 text-emerald-400 font-mono">{{ $type->products_count }} шт.</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('types.edit', $type->IDtp) }}" class="text-amber-400 hover:text-amber-300">✏️</a>
                                <form action="{{ route('types.destroy', $type->IDtp) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Удалить?')" class="text-red-400 hover:text-red-300">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $types->links() }}</div>
    </div>
</x-app-layout>