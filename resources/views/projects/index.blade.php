<x-app-layout title="Проекты">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white font-mono">📁 Разработки КБ</h1>
            <a href="{{ route('projects.create') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-sm font-semibold transition">
                + Новый проект
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-950/50 text-emerald-400 font-mono text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Название проекта</th>
                            <th class="px-6 py-3 text-left">Статус</th>
                            <th class="px-6 py-3 text-left">Дата начала</th>
                            <th class="px-6 py-3 text-center">Позиций</th>
                            <th class="px-6 py-3 text-right">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($projects as $project)
                            <tr class="hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4 text-slate-400 font-mono">
                                    #{{ $project->IDproject }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-white">{{ $project->Project_name }}</div>
                                    <div class="text-xs text-slate-500">{{ Str::limit($project->description, 40) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($project->status === 'Завершен')
                                        <span class="px-2 py-1 bg-slate-800 text-slate-400 rounded text-xs">{{ $project->status }}</span>
                                    @elseif($project->status === 'На тестировании')
                                        <span class="px-2 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/20 rounded text-xs">{{ $project->status }}</span>
                                    @else
                                        <span class="px-2 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded text-xs">{{ $project->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-400">
                                    {{ $project->start_date ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-block px-2 py-1 bg-slate-800 text-slate-300 rounded-full text-xs font-bold">
                                        {{ $project->items_count }} шт.
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('projects.show', $project->IDproject) }}" 
                                       class="inline-block px-3 py-1 bg-blue-600/20 text-blue-400 hover:bg-blue-600/30 rounded text-xs transition">
                                        Спецификация
                                    </a>
                                    <a href="{{ route('projects.edit', $project->IDproject) }}" 
                                       class="inline-block text-amber-400 hover:text-amber-300 px-1">✏️</a>
                                    <form action="{{ route('projects.destroy', $project->IDproject) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Удалить проект? Все комплектующие вернутся на склад.')" 
                                                class="text-red-400 hover:text-red-300 px-1">🗑️</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <div class="text-4xl mb-2">📂</div>
                                    <p>Проектов пока нет. Создайте первый!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    </div>
</x-app-layout>