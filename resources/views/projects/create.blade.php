<x-app-layout title="Новый проект">
    <div class="max-w-xl mx-auto px-4 py-8">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h1 class="text-xl font-bold text-white mb-6">➕ Новый проект</h1>
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Название *</label>
                    <input type="text" name="Project_name" value="{{ old('Project_name') }}" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Статус *</label>
                    <select name="status" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                        <option value="В разработке">В разработке</option>
                        <option value="На тестировании">На тестировании</option>
                        <option value="Завершен">Завершен</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Дата начала</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                </div>
                <div class="mb-6">
                    <label class="block text-sm text-slate-300 mb-2">Описание</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Создать</button>
                <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-lg ml-2">Отмена</a>
            </form>
        </div>
    </div>
</x-app-layout>