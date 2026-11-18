<x-app-layout title="Новая локация">
    <div class="max-w-xl mx-auto px-4 py-8">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h1 class="text-xl font-bold text-white mb-6">➕ Новая локация</h1>
            <form action="{{ route('locations.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Название (Код) *</label>
                    <input type="text" name="lsName" value="{{ old('lsName') }}" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white" placeholder="Например: А-ЭЛ" autofocus>
                    @error('lsName') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Тип комплектующих *</label>
                    <select name="IDtp" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                        <option value="">Выберите...</option>
                        @foreach($types as $t)
                            <option value="{{ $t->IDtp }}" {{ old('IDtp') == $t->IDtp ? 'selected' : '' }}>{{ $t->tpName }}</option>
                        @endforeach
                    </select>
                    @error('IDtp') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Адрес</label>
                    <input type="text" name="slAddres" value="{{ old('slAddres') }}" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                    @error('slAddres') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-sm text-slate-300 mb-2">Телефон</label>
                    <input type="text" name="slPhone" value="{{ old('slPhone') }}" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                    @error('slPhone') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Сохранить</button>
                <a href="{{ route('locations.index') }}" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-lg ml-2">Отмена</a>
            </form>
        </div>
    </div>
</x-app-layout>