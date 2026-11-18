<x-app-layout title="{{ $project->Project_name }}">
    <div class="max-w-5xl mx-auto px-4 py-8">
        
        @if(session('success')) <div class="mb-4 p-4 rounded-xl bg-emerald-500/10 text-emerald-400">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="mb-4 p-4 rounded-xl bg-red-500/10 text-red-400 border border-red-500/20">{{ session('error') }}</div> @endif

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-white">{{ $project->Project_name }}</h1>
                <p class="text-emerald-400 text-sm">Статус: {{ $project->status }}</p>
            </div>
            <a href="{{ route('projects.index') }}" class="text-slate-400 hover:text-white">&larr; Назад к списку</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Левая часть: Инфо о проекте -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 h-fit">
                <h2 class="text-lg font-bold text-white mb-4">О проекте</h2>
                <p class="text-sm text-slate-400 mb-4">{{ $project->description ?? 'Нет описания' }}</p>
                <div class="text-sm space-y-2 text-slate-300">
                    <p><span class="text-slate-500">Начало:</span> {{ $project->start_date ?? '—' }}</p>
                    <p><span class="text-slate-500">Конец:</span> {{ $project->end_date ?? '—' }}</p>
                </div>
                <a href="{{ route('projects.edit', $project->IDproject) }}" class="block text-center mt-6 px-4 py-2 bg-slate-800 text-white rounded-lg text-sm hover:bg-slate-700">Редактировать проект</a>
            </div>

            <!-- Правая часть: Спецификация -->
            <div class="md:col-span-2">
                <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-slate-800 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-white">Спецификация (Комплектующие)</h2>
                        <span class="text-xs bg-emerald-600/20 text-emerald-400 px-2 py-1 rounded">Всего позиций: {{ $project->items->count() }}</span>
                    </div>
                    <table class="w-full text-sm">
                        <thead class="bg-slate-950/50 text-emerald-400 font-mono text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3 text-left">Комплектующее</th>
                                <th class="px-6 py-3 text-left">Количество</th>
                                <th class="px-6 py-3 text-right">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @forelse($project->items as $item)
                                <tr class="hover:bg-slate-800/50">
                                    <td class="px-6 py-4 text-white">{{ $item->product->pcName ?? '—' }}</td>
                                    <td class="px-6 py-4 text-emerald-400 font-bold">{{ $item->piCount }} шт.</td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('projects.removeItem', [$project->IDproject, $item->IDitem]) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Удалить из проекта? Товар вернется на склад.')" class="text-red-400 hover:text-red-300 text-xs">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="px-6 py-6 text-center text-slate-500">Спецификация пуста</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Форма добавления -->
                <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                    <h3 class="text-md font-bold text-white mb-4">Добавить комплектующее в проект</h3>
                    <form action="{{ route('projects.addItem', $project->IDproject) }}" method="POST" class="flex gap-4 items-end">
                        @csrf
                        <div class="flex-1">
                            <label class="block text-xs text-slate-400 mb-1">Комплектующее</label>
                            <select name="IDpc" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white text-sm" required>
                                <option value="">Выберите...</option>
                                @foreach($products as $p)
                                    <option value="{{ $p->IDpc }}">{{ $p->pcName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-32">
                            <label class="block text-xs text-slate-400 mb-1">Кол-во</label>
                            <input type="number" name="piCount" value="1" min="1" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white text-sm" required>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-sm font-semibold whitespace-nowrap">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>