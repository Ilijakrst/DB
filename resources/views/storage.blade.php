@extends('layouts.app')

@section('title', 'Склады')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-white font-mono">📦 Склады</h1>
            <p class="text-sm text-slate-400 mt-1">Список всех записей о хранении товаров</p>
        </div>
        <a href="#" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-sm font-semibold transition">
            + Добавить
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Карточка с таблицей --}}
    <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden shadow-lg">
        
        {{-- Заголовок карточки --}}
        <div class="px-6 py-4 border-b border-slate-800 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-white font-mono">Все записи</h2>
            <span class="text-xs text-slate-400 font-mono">
                Всего: {{ $storage->count() }}
            </span>
        </div>

        {{-- Таблица --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-950/50 text-emerald-400 font-mono text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">IDpc</th>
                        <th class="px-6 py-3 text-left">Количество</th>
                        <th class="px-6 py-3 text-left">Локация</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($storage as $str)
                        <tr class="hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-4 text-slate-400 font-mono">
                                #{{ $str->IDstorage }}
                            </td>
                            <td class="px-6 py-4 text-slate-200 font-mono">
                                {{ $str->IDpc }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-emerald-500/10 border border-emerald-500/30 
                                             text-emerald-400 rounded-lg text-xs font-mono font-semibold">
                                    {{ $str->sCount }} шт.
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-slate-800 text-slate-200 
                                             rounded-lg text-xs font-mono">
                                    {{ $str->lsName }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                <div class="text-4xl mb-2">📭</div>
                                <p>Нет данных о складах</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection