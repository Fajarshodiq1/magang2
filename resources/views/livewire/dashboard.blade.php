<div>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Documents -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Documents</dt>
                            <dd class="text-2xl font-semibold text-gray-900">{{ number_format($totalDocuments) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Storage Used -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Storage Used</dt>
                            <dd class="text-2xl font-semibold text-gray-900">{{ $formattedStorage }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                            <dd class="text-2xl font-semibold text-gray-900">{{ number_format($totalUsers) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average per User -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Avg Docs/User</dt>
                            <dd class="text-2xl font-semibold text-gray-900">{{ $avgDocumentsPerUser }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Documents by File Type Chart -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Documents by File Type</h3>
                <div class="relative" style="height: 300px;">
                    <canvas id="fileTypeChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Upload Trend Chart -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Upload Trend (Last 6 Months)</h3>
                <div class="relative" style="height: 300px;">
                    <canvas id="uploadTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Documents and Top Contributors Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Documents -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Documents</h3>
                <div class="space-y-4">
                    @forelse($recentDocuments as $document)
                        <div class="flex items-center justify-between border-b border-gray-200 pb-3">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $document->title }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $document->user->name ?? 'Unknown' }} • {{ $document->formatted_file_size }} •
                                    {{ $document->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ strtoupper($document->file_type) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">No documents found</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Top Contributors -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Contributors</h3>
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
                                    <p class="text-sm font-medium text-gray-900">{{ $contributor->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $contributor->document_count }} documents</p>
                                </div>
                            </div>
                            <div class="text-2xl font-bold text-gray-400">
                                #{{ $index + 1 }}
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">No contributors found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File Type Chart (Pie)
            const fileTypeCtx = document.getElementById('fileTypeChart');
            if (fileTypeCtx) {
                const fileTypeData = @json($documentsByType);

                new Chart(fileTypeCtx, {
                    type: 'pie',
                    data: {
                        labels: fileTypeData.map(item => item.type.toUpperCase()),
                        datasets: [{
                            data: fileTypeData.map(item => item.count),
                            backgroundColor: [
                                '#3B82F6', // blue
                                '#10B981', // green
                                '#F59E0B', // yellow
                                '#EF4444', // red
                                '#8B5CF6', // purple
                                '#EC4899', // pink
                                '#06B6D4', // cyan
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
                                position: 'bottom',
                            },
                            tooltip: {
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

            // Upload Trend Chart (Line)
            const uploadTrendCtx = document.getElementById('uploadTrendChart');
            if (uploadTrendCtx) {
                const uploadTrendData = @json($uploadTrend);

                new Chart(uploadTrendCtx, {
                    type: 'line',
                    data: {
                        labels: uploadTrendData.map(item => item.month),
                        datasets: [{
                            label: 'Documents Uploaded',
                            data: uploadTrendData.map(item => item.count),
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: '#3B82F6',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
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
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.y + ' documents';
                                    }
                                }
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
        });
    </script>
</div>
