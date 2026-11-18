<x-app-layout title="Редактировать">
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h1 class="text-xl font-bold text-white mb-6 font-mono">✏️ Редактировать #{{ $storage->IDstorage }}</h1>
            
            <form action="{{ route('storage.update', $storage->IDstorage) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Комплектующее</label>
                    <select name="IDpc" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                        @foreach($products as $p)
                            <option value="{{ $p->IDpc }}" {{ $storage->IDpc == $p->IDpc ? 'selected' : '' }}>{{ $p->pcName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Количество</label>
                    <input type="number" name="sCount" value="{{ $storage->sCount }}" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                </div>

                <div class="mb-6">
                    <label class="block text-sm text-slate-300 mb-2">Место хранения</label>
                    <select name="lsName" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                        @foreach($locations as $l)
                            <option value="{{ $l->lsName }}" {{ $storage->lsName == $l->lsName ? 'selected' : '' }}>{{ $l->lsName }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-semibold">Обновить</button>
                <a href="{{ route('storage.index') }}" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-lg text-sm ml-2">Отмена</a>
            </form>
        </div>
    </div>
</x-app-layout>