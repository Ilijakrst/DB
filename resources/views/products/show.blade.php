<x-app-layout title="{{ $product->pcName }}">
    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $product->pcName }}</h1>
                    <span class="text-sm text-emerald-400">{{ $product->type->tpName ?? 'Без категории' }}</span>
                </div>
                <a href="{{ route('products.index') }}" class="text-slate-400 hover:text-white">&larr; Назад</a>
            </div>
            
            <div class="border-t border-slate-800 pt-4 mt-4 space-y-3 text-sm">
                <p><span class="text-slate-500">ID:</span> <span class="font-mono text-slate-300">{{ $product->IDpc }}</span></p>
                <p><span class="text-slate-500">Описание:</span> <span class="text-slate-300">{{ $product->pcDescription ?? 'Нет описания' }}</span></p>
                <div>
                    <span class="text-slate-500 block mb-2">Наличие на складе:</span>
                    @if($product->storage)
                        <div class="bg-slate-950 p-3 rounded-lg border border-slate-800 inline-block">
                            <span class="text-emerald-400 font-bold text-lg">{{ $product->storage->sCount }} шт.</span>
                            <span class="text-slate-500 text-xs ml-2">(Локация: {{ $product->storage->lsName }})</span>
                        </div>
                    @else
                        <span class="text-red-400">Нет на складе</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>