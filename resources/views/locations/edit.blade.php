<x-app-layout title="Редактировать локацию">
    <div class="max-w-xl mx-auto px-4 py-8">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h1 class="text-xl font-bold text-white mb-6">✏️ Редактировать локацию</h1>
            <form action="{{ route('locations.update', $location->lsName) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Название (Код) *</label>
                    <input type="text" name="lsName" value="{{ $location->lsName }}" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white" autofocus>
                    @error('lsName') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Тип комплектующих *</label>
                    <select name="IDtp" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                        @foreach($types as $t)
                            <option value="{{ $t->IDtp }}" {{ $location->IDtp == $t->IDtp ? 'selected' : '' }}>{{ $t->tpName }}</option>
                        @endforeach
                    </select>
                    @error('IDtp') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Адрес</label>
                    <input type="text" name="slAddres" value="{{ $location->slAddres }}" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                </div>
                <div class="mb-6">
                    <label class="block text-sm text-slate-300 mb-2">Телефон</label>
                    <input type="text" name="slPhone" value="{{ $location->slPhone }}" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                </div>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Обновить</button>
                <a href="{{ route('locations.index') }}" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-lg ml-2">Отмена</a>
            </form>
        </div>
    </div>
</x-app-layout>