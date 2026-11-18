<x-app-layout title="Редактировать проект">
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h1 class="text-xl font-bold text-white mb-6">✏️ Редактировать проект</h1>
            
            <form action="{{ route('projects.update', $project->IDproject) }}" method="POST">
                @csrf 
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Название проекта *</label>
                    <input type="text" name="Project_name" value="{{ old('Project_name', $project->Project_name) }}" 
                           class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white" required autofocus>
                    @error('Project_name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Статус *</label>
                    <select name="status" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                        <option value="В разработке" {{ old('status', $project->status) == 'В разработке' ? 'selected' : '' }}>В разработке</option>
                        <option value="На тестировании" {{ old('status', $project->status) == 'На тестировании' ? 'selected' : '' }}>На тестировании</option>
                        <option value="Завершен" {{ old('status', $project->status) == 'Завершен' ? 'selected' : '' }}>Завершен</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm text-slate-300 mb-2">Дата начала</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $project->start_date) }}" 
                               class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                    </div>
                    <div>
                        <label class="block text-sm text-slate-300 mb-2">Дата завершения</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $project->end_date) }}" 
                               class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm text-slate-300 mb-2">Описание</label>
                    <textarea name="description" rows="4" 
                              class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-sm font-semibold transition">
                        Сохранить изменения
                    </button>
                    <a href="{{ route('projects.show', $project->IDproject) }}" 
                       class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg text-sm transition">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>