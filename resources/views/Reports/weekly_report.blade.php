<x-app-layout>
  <section class="max-w-4xl mx-auto px-6 pt-16 pb-12 text-center">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-base-content mb-4">
                Welcome to <span class="text-primary">MindMirror</span>
            </h1>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
               Track your highs, lows, and everything in between.See what drives your peace, what fuels your stress, and how your habits shape your mental rhythm.
            </p>
        </div>
    </section>
    <section class="max-w-4xl mx-auto px-6 mb-12">
        <div class="bg-base-100 text-base-content rounded-3xl p-8 shadow-xl border-2 border-primary">
            <h2 class="text-2xl font-semibold text-base-content mb-3">About MindMirror</h2>
            <p class="text-base-content/70 leading-relaxed">
                <i>Through weekly mood reports, trend graphs, and progress summaries, <b>MindMirror</b> shows you how your mental state shifts over time.
You’ll start noticing what lifts your spirit, what drains your energy, and how small habits ripple into big emotional changes.Because self-awareness isn’t guesswork — it’s data with empathy.<b>MindMirror</b> empowers you to understand your mind like never before — with clarity, color, and compassion.</i>
            </p>
        </div>
    </section>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Week Navigation -->
            <div class="card bg-base-100 shadow-lg mb-6">
                <div class="card-body p-4">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('weekly.report', ['week_offset' => $weekOffset + 1]) }}" 
                               class="btn btn-circle btn-sm btn-ghost">
                                ❮
                            </a>
                            <div class="text-center min-w-[200px]">
                                <p class="font-semibold text-lg">
                                    {{ $startDate->format('M j') }} - {{ $endDate->format('M j, Y') }}
                                </p>
                                <p class="text-xs opacity-70">
                                    @if($weekOffset == 0)
                                        Current Week
                                    @elseif($weekOffset == 1)
                                        Last Week
                                    @else
                                        {{ abs($weekOffset) }} weeks ago
                                    @endif
                                </p>
                            </div>
                            <a href="{{ route('weekly.report', ['week_offset' => max(0, $weekOffset - 1)]) }}" 
                               class="btn btn-circle btn-sm btn-ghost {{ $weekOffset == 0 ? 'btn-disabled' : '' }}">
                                ❯
                            </a>
                        </div>

                        <div class="flex items-center gap-2">
                            <select id="week-selector" class="select select-bordered select-sm w-full max-w-xs">
                                <option value="0" {{ $weekOffset == 0 ? 'selected' : '' }}>Current Week</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $weekOffset == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ $i == 1 ? 'week' : 'weeks' }} ago
                                    </option>
                                @endfor
                            </select>
                            <a href="{{ route('weekly.report', ['week_offset' => 0]) }}" 
                               class="btn btn-sm btn-primary">
                                Today
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if($weeklyMoods->isEmpty())
                <div class="card bg-base-200 shadow-xl py-16">
                    <div class="card-body items-center text-center">
                        <div class="text-7xl mb-6 animate-bounce">
                            <img src="{{ asset('images/wmood.png') }}" alt="weekly mood" class="w-12 h-12 mb-4"/>
                        </div>
                        <h3 class="text-2xl font-semibold mb-3">No Data for This Week</h3>
                        <p class="opacity-70 mb-8">
                            You haven't logged any moods between 
                            <span class="font-medium">{{ $startDate->format('M j') }}</span> and 
                            <span class="font-medium">{{ $endDate->format('M j, Y') }}</span>
                        </p>
                        <div class="flex justify-center">
                            @if($weekOffset == 0)
                                <a href="{{ route('moods.index') }}" class="btn btn-primary btn-wide">
                                    Log Your First Mood
                                </a>
                            @else
                                <a href="{{ route('weekly.report', ['week_offset' => 0]) }}" class="btn btn-primary btn-wide">
                                    View Current Week
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @else
        
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    
                    <div class="card bg-gradient-to-br from-primary/10 to-primary/5 shadow-lg border border-primary/20">
                        <div class="card-body flex flex-row items-center justify-between">
                            <div>
                                <p class="text-sm opacity-70">Total Entries</p>
                                <p class="text-3xl font-bold text-primary">{{ $weeklyMoods->count() }}</p>
                            </div>
                            <div class="text-5xl"><img src="{{ asset('images/stats.png') }}" alt="statistics" class="w-12 h-12 mb-4"/></div>
                        </div>
                    </div>

                    <div class="card bg-gradient-to-br from-secondary/10 to-secondary/5 shadow-lg border border-secondary/20">
                        <div class="card-body flex flex-row items-center justify-between">
                            <div>
                                <p class="text-sm opacity-70">Most Common Mood</p>
                                <p class="text-2xl font-bold capitalize text-secondary">
                                    {{ $mostCommonMood ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="text-5xl">
                                @if(isset($mostCommonMood))
                                    @switch($mostCommonMood)
                                        @case('happy') 😊 @break
                                        @case('excited') 🤩 @break
                                        @case('calm') 😌 @break
                                        @case('anxious') 😰 @break
                                        @case('sad') 😢 @break
                                        @case('tired') 😴 @break
                                        @case('stressed') 😰 @break
                                        @case('angry') 😠 @break
                                        @default 😊
                                    @endswitch
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card bg-gradient-to-br from-accent/10 to-accent/5 shadow-lg border border-accent/20">
                        <div class="card-body flex flex-row items-center justify-between">
                            <div>
                                <p class="text-sm opacity-70">Consistency</p>
                                <p class="text-3xl font-bold text-accent">{{ $consistencyRate ?? 0 }}%</p>
                            </div>
                            <div class="text-5xl">
                                <img src="{{ asset('images/streak.png') }}" alt="consistency" class="w-12 h-12 mb-4"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-xl border border-base-300 mb-6">
                    <div class="card-body">
                        <h3 class="card-title text-xl font-semibold mb-4 flex items-center gap-2">
                            <span><img src="{{ asset('images/dotchart.png') }}" alt="Dot chart" class="w-12 h-12 mb-4"/></span>
                            <span>Mood Trend This Week</span>
                        </h3>
                        <div class="w-full">
                            <canvas id="moodTrendChart" class="max-h-80"></canvas>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div class="card bg-base-100 shadow-xl border border-base-300">
                        <div class="card-body">
                            <h3 class="card-title text-lg font-semibold mb-4 flex items-center gap-2">
                                <span><img src="{{ asset('images/piechart.png') }}" alt="pie chart" class="w-10 h-10 mb-4"/></span>
                                <span>Mood Distribution</span>
                            </h3>
                            <div class="flex justify-center items-center">
                                <canvas id="moodPieChart" class="max-w-sm max-h-64"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-base-100 shadow-xl border border-base-300">
                        <div class="card-body">
                            <h3 class="card-title text-lg font-semibold mb-4 flex items-center gap-2">
                                <span><img src="{{ asset('images/barchart.png') }}" alt="Bar chart" class="w-12 h-12 mb-4"/></span>
                                <span>Mood Frequency</span>
                            </h3>
                            <div class="w-full">
                                <canvas id="moodBarChart" class="max-h-64"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            
                <div class="card bg-base-100 shadow-xl border border-base-300">
                    <div class="card-body">
                        <h3 class="card-title text-xl font-semibold mb-4 flex items-center gap-2">
                            <span><img src="{{ asset('images/entry.png') }}" alt="entry" class="w-12 h-12 mb-4"/></span>
                            <span>Your Mood Entries</span>
                            <span class="badge badge-primary">{{ $weeklyMoods->count() }}</span>
                        </h3>
                        <div class="divide-y divide-base-300">
                            @foreach($weeklyMoods as $mood)
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between py-4 hover:bg-base-200 px-4 -mx-4 rounded-lg transition-colors">
                                    <div class="flex items-start space-x-4">
                                        <div class="text-4xl">
                                            @switch($mood->mood)
                                                @case('happy') 😊 @break
                                                @case('excited') 🤩 @break
                                                @case('calm') 😌 @break
                                                @case('anxious') 😰 @break
                                                @case('sad') 😢 @break
                                                @case('tired') 😴 @break
                                                @case('stressed') 😰 @break
                                                @case('angry') 😠 @break
                                                @default 😊
                                            @endswitch
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold capitalize text-lg">
                                                {{ $mood->mood }}
                                            </p>
                                            <p class="text-sm opacity-70 flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $mood->created_at->format('l, F j, Y • g:i A') }}
                                            </p>
                                            @if($mood->note)
                                                <div class="mt-2 p-3 bg-base-200 rounded-lg border-l-4 border-primary">
                                                    <p class="italic text-sm opacity-90">
                                                        "{{ $mood->note }}"
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:mt-0 flex items-center gap-2">
                                        <span class="badge badge-ghost badge-sm">
                                            {{ $mood->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <div class="text-center">
                <a href="{{ route('dashboard') }}" 
                   class="btn btn-outline btn-wide rounded-xl mt-4">
                    ← Back to MindInsight
                </a>
            </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const weekSelector = document.getElementById('week-selector');
            
            if (weekSelector) {
                weekSelector.addEventListener('change', function() {
                    const weekOffset = this.value;
                    window.location.href = `{{ route('weekly.report') }}?week_offset=${weekOffset}`;
                });
            }
            const moodData = @json($weeklyMoods);
            
            if (moodData.length > 0) {
                const moodColors = {
                    'happy': '#10b981',
                    'excited': '#f59e0b',
                    'calm': '#3b82f6',
                    'anxious': '#ef4444',
                    'sad': '#6366f1',
                    'tired': '#8b5cf6',
                    'stressed': '#ec4899',
                    'angry': '#dc2626'
                };

                const moodEmojis = {
                    'happy': '😊',
                    'excited': '🤩',
                    'calm': '😌',
                    'anxious': '😰',
                    'sad': '😢',
                    'tired': '😴',
                    'stressed': '😰',
                    'angry': '😠'
                };
                const timelineData = moodData.map(mood => ({
                    date: new Date(mood.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }),
                    mood: mood.mood,
                    time: new Date(mood.created_at).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })
                })).reverse();

                const moodValues = {
                    'excited': 5,
                    'happy': 4,
                    'calm': 3,
                    'tired': 2,
                    'anxious': 1,
                    'stressed': 1,
                    'sad': 0,
                    'angry': 0
                };
                const trendCtx = document.getElementById('moodTrendChart');
                if (trendCtx) {
                    new Chart(trendCtx, {
                        type: 'line',
                        data: {
                            labels: timelineData.map(d => `${d.date} ${d.time}`),
                            datasets: [{
                                label: 'Mood Level',
                                data: timelineData.map(d => moodValues[d.mood]),
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.4,
                                fill: true,
                                pointRadius: 6,
                                pointHoverRadius: 8,
                                pointBackgroundColor: timelineData.map(d => moodColors[d.mood]),
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const mood = timelineData[context.dataIndex].mood;
                                            return `${moodEmojis[mood]} ${mood.charAt(0).toUpperCase() + mood.slice(1)}`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 5,
                                    ticks: {
                                        stepSize: 1,
                                        callback: function(value) {
                                            const labels = ['😢', '😰', '😴', '😌', '😊', '🤩'];
                                            return labels[value] || '';
                                        }
                                    }
                                },
                                x: {
                                    ticks: {
                                        maxRotation: 45,
                                        minRotation: 45
                                    }
                                }
                            }
                        }
                    });
                }
                const moodCounts = moodData.reduce((acc, mood) => {
                    acc[mood.mood] = (acc[mood.mood] || 0) + 1;
                    return acc;
                }, {});

                const pieCtx = document.getElementById('moodPieChart');
                if (pieCtx) {
                    new Chart(pieCtx, {
                        type: 'doughnut',
                        data: {
                            labels: Object.keys(moodCounts).map(m => `${moodEmojis[m]} ${m.charAt(0).toUpperCase() + m.slice(1)}`),
                            datasets: [{
                                data: Object.values(moodCounts),
                                backgroundColor: Object.keys(moodCounts).map(m => moodColors[m]),
                                borderWidth: 2,
                                borderColor: '#fff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 15,
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
                const barCtx = document.getElementById('moodBarChart');
                if (barCtx) {
                    new Chart(barCtx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(moodCounts).map(m => `${moodEmojis[m]} ${m.charAt(0).toUpperCase() + m.slice(1)}`),
                            datasets: [{
                                label: 'Count',
                                data: Object.values(moodCounts),
                                backgroundColor: Object.keys(moodCounts).map(m => moodColors[m]),
                                borderRadius: 8,
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    </script>
</x-app-layout>