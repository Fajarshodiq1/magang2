<div class="flex h-full w-full flex-1 flex-col gap-6 container mx-auto lg:px-8 lg:py-8">
    <!-- Statistics Cards -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Documents Card -->
        <div
            class="relative overflow-hidden rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Total Documents</p>
                    <h3 class="mt-2 text-3xl font-bold text-zinc-900 dark:text-white">
                        {{ number_format($totalDocuments) }}</h3>
                    <div class="mt-4">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-blue-600 dark:bg-blue-400"></span>
                            All Files
                        </span>
                    </div>
                </div>
                <div class="rounded-full bg-blue-100 p-3 dark:bg-blue-900/30">
                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Storage Used Card -->
        <div
            class="relative overflow-hidden rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Storage Used</p>
                    <h3 class="mt-2 text-3xl font-bold text-zinc-900 dark:text-white">{{ $formattedStorage }}</h3>
                    <div class="mt-4">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800 dark:bg-green-900/30 dark:text-green-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-600 dark:bg-green-400"></span>
                            Total Space
                        </span>
                    </div>
                </div>
                <div class="rounded-full bg-green-100 p-3 dark:bg-green-900/30">
                    <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div
            class="relative overflow-hidden rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Total Users</p>
                    <h3 class="mt-2 text-3xl font-bold text-zinc-900 dark:text-white">
                        {{ number_format($totalUsers) }}</h3>
                    <div class="mt-4">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-purple-600 dark:bg-purple-400"></span>
                            Active Users
                        </span>
                    </div>
                </div>
                <div class="rounded-full bg-purple-100 p-3 dark:bg-purple-900/30">
                    <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Average per User Card -->
        <div
            class="relative overflow-hidden rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Avg Docs/User</p>
                    <h3 class="mt-2 text-3xl font-bold text-zinc-900 dark:text-white">{{ $avgDocumentsPerUser }}</h3>
                    <div class="mt-4">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-600 dark:bg-amber-400"></span>
                            Per User
                        </span>
                    </div>
                </div>
                <div class="rounded-full bg-amber-100 p-3 dark:bg-amber-900/30">
                    <svg class="h-6 w-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Documents by File Type Chart -->
        <div
            class="relative overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 p-6 dark:border-zinc-800">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Documents by File Type</h2>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Distribution of file types</p>
            </div>
            <div class="p-6">
                <canvas id="fileTypeChart" class="w-full" style="max-height: 300px;"></canvas>

                <div class="mt-6 flex flex-wrap gap-4 border-t border-zinc-200 pt-4 dark:border-zinc-800">
                    @foreach ($documentsByType as $index => $type)
                        <div class="flex items-center gap-2">
                            <span class="h-3 w-3 rounded-full"
                                style="background-color: {{ ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899', '#06B6D4'][$index % 7] }}"></span>
                            <span
                                class="text-sm text-zinc-600 dark:text-zinc-400">{{ strtoupper($type['type']) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Upload Trend Chart -->
        <div
            class="relative overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 p-6 dark:border-zinc-800">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Upload Trend</h2>
                        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Monthly upload statistics</p>
                    </div>
                    <div>
                        <select id="uploadTrendYear"
                            class="rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm font-medium text-zinc-900 transition-colors hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                            @for ($year = date('Y'); $year >= date('Y') - 5; $year--)
                                <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <canvas id="uploadTrendChart" class="w-full" style="max-height: 300px;"></canvas>

                <div class="mt-6 flex flex-wrap gap-4 border-t border-zinc-200 pt-4 dark:border-zinc-800">
                    <div class="flex items-center gap-2">
                        <span class="h-3 w-3 rounded-full bg-blue-500"></span>
                        <span class="text-sm text-zinc-600 dark:text-zinc-400">Documents Uploaded</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Documents & Top Contributors Row -->
    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Recent Documents (Spanning 2 columns) -->
        <div
            class="relative overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900 lg:col-span-2">
            <div class="border-b border-zinc-200 p-6 dark:border-zinc-800">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Recent Documents</h2>
                        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Latest uploaded files</p>
                    </div>
                    <a href="{{ route('documents.index') }}"
                        class="inline-flex items-center gap-2 rounded-full bg-zinc-100 px-4 py-2 text-sm font-medium text-zinc-900 transition-colors hover:bg-zinc-200 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                        View All
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @forelse($recentDocuments as $document)
                    <div
                        class="flex items-center gap-4 p-4 transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                        <div
                            class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-purple-600 text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="truncate font-medium text-zinc-900 dark:text-white">{{ $document->title }}</p>
                            <div class="mt-1 flex flex-wrap items-center gap-2">
                                <span
                                    class="rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    {{ $document->user->name ?? 'Unknown' }}
                                </span>
                                <span class="text-xs text-zinc-500 dark:text-zinc-500">
                                    {{ $document->formatted_file_size }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-shrink-0 text-right">
                            <span
                                class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                {{ strtoupper($document->file_type) }}
                            </span>
                            <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-500">
                                {{ $document->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div
                            class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800">
                            <svg class="h-8 w-8 text-zinc-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-zinc-500 dark:text-zinc-400">No documents found</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Top Contributors -->
        <div class="space-y-6">
            <div
                class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <h3 class="mb-4 text-lg font-semibold text-zinc-900 dark:text-white">Top Contributors</h3>
                <div class="space-y-4">
                    @forelse($topContributors as $index => $contributor)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div
                                        class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                                        {{ substr($contributor->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-zinc-900 dark:text-white">
                                        {{ $contributor->name }}</p>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                        {{ $contributor->document_count }} documents</p>
                                </div>
                            </div>
                            <div class="text-2xl font-bold text-zinc-400">
                                #{{ $index + 1 }}
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-zinc-500 text-center py-4 dark:text-zinc-400">No contributors found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart instances
        let fileTypeChart = null;
        let uploadTrendChart = null;

        // Data
        const fileTypeData = @json($documentsByType);
        const uploadTrendDataByYear = @json($uploadTrendByYear ?? []);

        // Function to get current theme colors
        function getThemeColors() {
            const isDarkMode = document.documentElement.classList.contains('dark');
            return {
                text: isDarkMode ? '#e4e4e7' : '#18181b',
                grid: isDarkMode ? '#27272a' : '#e4e4e7',
                blue: isDarkMode ? '#60a5fa' : '#3b82f6',
            };
        }

        // Function to create file type chart
        function createFileTypeChart() {
            const colors = getThemeColors();
            const ctx = document.getElementById('fileTypeChart');
            if (!ctx) return;

            if (fileTypeChart) {
                fileTypeChart.destroy();
            }

            fileTypeChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: fileTypeData.map(item => item.type.toUpperCase()),
                    datasets: [{
                        data: fileTypeData.map(item => item.count),
                        backgroundColor: [
                            '#3B82F6',
                            '#10B981',
                            '#F59E0B',
                            '#EF4444',
                            '#8B5CF6',
                            '#EC4899',
                            '#06B6D4',
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: colors.text === '#e4e4e7' ? '#18181b' : '#ffffff',
                            titleColor: colors.text,
                            bodyColor: colors.text,
                            borderColor: colors.grid,
                            borderWidth: 1,
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed + ' documents';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Function to create upload trend chart
        function createUploadTrendChart(year) {
            const colors = getThemeColors();
            const ctx = document.getElementById('uploadTrendChart');
            if (!ctx) return;

            if (uploadTrendChart) {
                uploadTrendChart.destroy();
            }

            // Get data for selected year
            const yearData = uploadTrendDataByYear[year] || [];

            // Month labels
            const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                'Dec'
            ];

            // Create data array with all 12 months
            const monthData = Array(12).fill(0);
            yearData.forEach(item => {
                const monthIndex = item.month - 1; // month is 1-12, array is 0-11
                monthData[monthIndex] = item.count;
            });

            uploadTrendChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: 'Documents Uploaded',
                        data: monthData,
                        backgroundColor: colors.blue + '80',
                        borderColor: colors.blue,
                        borderWidth: 2,
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: colors.text === '#e4e4e7' ? '#18181b' : '#ffffff',
                            titleColor: colors.text,
                            bodyColor: colors.text,
                            borderColor: colors.grid,
                            borderWidth: 1,
                            padding: 12,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y +
                                        ' documents';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: colors.text
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: colors.grid,
                                drawBorder: false
                            },
                            ticks: {
                                color: colors.text,
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }

        // Initial chart creation
        createFileTypeChart();
        const currentYear = new Date().getFullYear();
        createUploadTrendChart(currentYear);

        // Year selector change event
        const yearSelector = document.getElementById('uploadTrendYear');
        if (yearSelector) {
            yearSelector.addEventListener('change', function() {
                createUploadTrendChart(this.value);
            });
        }

        // Optional: Listen for theme changes and update charts
        // If you have a dark mode toggle, add its event listener here
    });
</script>
