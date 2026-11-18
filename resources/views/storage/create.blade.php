<x-app-layout title="Добавить на склад">
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h1 class="text-xl font-bold text-white mb-6 font-mono">➕ Добавить запись</h1>
            
            <form action="{{ route('storage.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Комплектующее</label>
                    <select name="IDpc" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                        <option value="">Выберите...</option>
                        @foreach($products as $p)
                            <option value="{{ $p->IDpc }}">{{ $p->pcName }}</option>
                        @endforeach
                    </select>
                    @error('IDpc') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Количество</label>
                    <input type="number" name="sCount" value="1" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                    @error('sCount') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm text-slate-300 mb-2">Место хранения</label>
                    <select name="lsName" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                        <option value="">Выберите...</option>
                        @foreach($locations as $l)
                            <option value="{{ $l->lsName }}">{{ $l->lsName }}</option>
                        @endforeach
                    </select>
                    @error('lsName') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-semibold">Сохранить</button>
                <a href="{{ route('storage.index') }}" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-lg text-sm ml-2">Отмена</a>
            </form>
        </div>
    </div>
</x-app-layout>