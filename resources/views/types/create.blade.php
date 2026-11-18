<x-app-layout title="Новая категория">
    <div class="max-w-xl mx-auto px-4 py-8">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h1 class="text-xl font-bold text-white mb-6">➕ Новая категория</h1>
            <form action="{{ route('types.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Название</label>
                    <input type="text" name="tpName" value="{{ old('tpName') }}" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white" autofocus>
                    @error('tpName') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Сохранить</button>
                <a href="{{ route('types.index') }}" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-lg ml-2">Отмена</a>
            </form>
        </div>
    </div>
</x-app-layout>