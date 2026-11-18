<x-app-layout title="Редактировать">
    <div class="max-w-xl mx-auto px-4 py-8">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h1 class="text-xl font-bold text-white mb-6">✏️ Редактировать</h1>
            <form action="{{ route('products.update', $product->IDpc) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Название *</label>
                    <input type="text" name="pcName" value="{{ $product->pcName }}" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white" autofocus>
                    @error('pcName') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm text-slate-300 mb-2">Категория *</label>
                    <select name="IDtp" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">
                        @foreach($types as $t)
                            <option value="{{ $t->IDtp }}" {{ $product->IDtp == $t->IDtp ? 'selected' : '' }}>{{ $t->tpName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <label class="block text-sm text-slate-300 mb-2">Описание</label>
                    <textarea name="pcDescription" rows="3" class="w-full px-4 py-2 bg-slate-950 border border-slate-800 rounded-lg text-white">{{ $product->pcDescription }}</textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Обновить</button>
                <a href="{{ route('products.index') }}" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-lg ml-2">Отмена</a>
            </form>
        </div>
    </div>
</x-app-layout>