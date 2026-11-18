<x-app-layout title="Главная панель">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
        
        <!-- Приветствие -->
        <div class="bg-gradient-to-r from-emerald-950/60 via-slate-900 to-slate-900 border border-emerald-500/20 rounded-2xl p-6 sm:p-8 shadow-xl">
            <h1 class="text-2xl font-bold text-white font-mono">
                Добро пожаловать, {{ Auth::user()->name }}!
            </h1>
            <p class="text-sm text-emerald-400/60 mt-2">
                Система управления комплектующими и проектами Конструкторского отдела.
            </p>
        </div>

        <!-- 4 Карточки статистики -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-md">
                <div class="text-emerald-400/60 text-xs font-mono mb-1">КАТАЛОГ</div>
                <div class="text-3xl font-bold text-white">{{ $totalProducts }}</div>
                <div class="text-xs text-slate-500 mt-1">Комплектующих</div>
            </div>
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-md">
                <div class="text-emerald-400/60 text-xs font-mono mb-1">СКЛАД</div>
                <div class="text-3xl font-bold text-white">{{ $totalLocations }}</div>
                <div class="text-xs text-slate-500 mt-1">Локаций хранения</div>
            </div>
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-md">
                <div class="text-emerald-400/60 text-xs font-mono mb-1">ПРОЕКТЫ</div>
                <div class="text-3xl font-bold text-white">{{ $activeProjects }}</div>
                <div class="text-xs text-slate-500 mt-1">Активных разработок</div>
            </div>
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-md">
                <div class="text-emerald-400/60 text-xs font-mono mb-1">КАТЕГОРИИ</div>
                <div class="text-3xl font-bold text-white">{{ $totalCategories }}</div>
                <div class="text-xs text-slate-500 mt-1">Типов комплектующих</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Левая колонка: График -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-md">
                <h2 class="text-lg font-bold text-white mb-4">Распределение по категориям</h2>
                <div class="relative h-64 flex justify-center">
                    <canvas id="categoriesChart"></canvas>
                </div>
            </div>

            <!-- Правая колонка: Заканчивается на складе -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-white">Требует закупки</h2>
                    <a href="{{ route('storage.index') }}" class="text-xs text-emerald-400 hover:text-emerald-300">Весь склад &rarr;</a>
                </div>
                
                <div class="space-y-3">
                    @forelse($lowStock as $item)
                        <div class="flex justify-between items-center p-3 bg-slate-950 rounded-xl border border-red-500/20">
                            <div>
                                <div class="text-sm font-semibold text-white">{{ $item->product->pcName ?? 'Неизвестно' }}</div>
                                <div class="text-xs text-slate-500">{{ $item->lsName }}</div>
                            </div>
                            <div class="text-red-400 font-mono font-bold text-lg">{{ $item->sCount }} шт.</div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-slate-500">
                            <div class="text-3xl mb-2">✅</div>
                            <p class="text-sm">Всех комплектующих достаточно</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Последние проекты -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-white">Последние проекты</h2>
                <a href="{{ route('projects.index') }}" class="text-xs text-emerald-400 hover:text-emerald-300">Все проекты &rarr;</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($recentProjects as $project)
                    <a href="{{ route('projects.show', $project->IDproject) }}" 
                       class="block p-4 bg-slate-950 border border-slate-800 rounded-xl hover:border-emerald-500/50 transition-colors">
                        <div class="text-xs font-mono text-emerald-400/60 mb-1">#{{ $project->IDproject }}</div>
                        <div class="text-sm font-semibold text-white mb-2 truncate">{{ $project->Project_name }}</div>
                        <div class="text-xs text-slate-400">{{ $project->status }}</div>
                    </a>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Скрипт для графика Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('categoriesChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        data: {!! json_encode($chartValues) !!},
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.8)',  // Emerald
                            'rgba(59, 130, 246, 0.8)',  // Blue
                            'rgba(245, 158, 11, 0.8)',  // Amber
                            'rgba(139, 92, 246, 0.8)',  // Purple
                            'rgba(239, 68, 68, 0.8)'    // Red
                        ],
                        borderColor: '#0f172a',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: '#94a3b8', // slate-400
                                font: { size: 12, family: 'monospace' }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>