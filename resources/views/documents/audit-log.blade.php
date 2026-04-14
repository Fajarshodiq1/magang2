<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Logs - {{ $document->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 dark:bg-zinc-900">
    <div class="min-h-screen py-8">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Header -->
            <div class="bg-white dark:bg-zinc-800 rounded-2xl p-6 mb-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                            <i class="fas fa-history mr-2 text-blue-500"></i>
                            Audit Logs
                        </h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            Riwayat akses untuk: <span class="font-semibold">{{ $document->title }}</span>
                        </p>
                    </div>
                    <a href="{{ route('documents.verify', $document) }}"
                        class="px-4 py-2 bg-gray-100 dark:bg-zinc-700 hover:bg-gray-200 dark:hover:bg-zinc-600 rounded-lg transition font-semibold text-gray-700 dark:text-gray-300">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white dark:bg-zinc-800 rounded-xl p-4 shadow">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <i class="fas fa-eye text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $logs->where('action', 'view')->count() }}
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Views</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl p-4 shadow">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg">
                            <i class="fas fa-download text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $logs->where('action', 'download')->count() }}
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Downloads</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl p-4 shadow">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                            <i class="fas fa-edit text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $logs->where('action', 'edit')->count() }}
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Edits</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl p-4 shadow">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                            <i class="fas fa-shield-check text-orange-600 dark:text-orange-400"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $logs->where('action', 'verify')->count() }}
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Verifications</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logs Table -->
            <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-zinc-700">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                        <i class="fas fa-list mr-2 text-indigo-500"></i>
                        Riwayat Aktivitas
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-zinc-900 border-b border-gray-200 dark:border-zinc-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Waktu
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    User
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Deskripsi
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    IP Address
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                            @forelse($logs as $log)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-900/50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm">
                                            <p class="font-semibold text-gray-900 dark:text-white">
                                                {{ $log->created_at->format('d M Y') }}
                                            </p>
                                            <p class="text-gray-500 dark:text-gray-400">
                                                {{ $log->created_at->format('H:i:s') }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            @if ($log->user)
                                                <img src="{{ \Storage::url($log->user->profile_photo) }}"
                                                    alt="{{ $log->user->name }}" class="w-8 h-8 rounded-full">
                                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $log->user->name }}
                                                </span>
                                            @else
                                                <span class="text-sm text-gray-500 dark:text-gray-400 italic">
                                                    System
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex px-3 py-1 rounded-full text-xs font-bold
                                            @if ($log->action === 'create') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                                            @elseif($log->action === 'view') bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                                            @elseif($log->action === 'edit') bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400
                                            @elseif($log->action === 'delete') bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400
                                            @elseif($log->action === 'download') bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400
                                            @else bg-gray-100 text-gray-700 dark:bg-gray-900/30 dark:text-gray-400 @endif">
                                            {{ $log->action_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $log->description ?: '-' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-sm font-mono text-gray-600 dark:text-gray-400">
                                            {{ $log->ip_address ?: '-' }}
                                        </p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div
                                            class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                            <i class="fas fa-history text-4xl mb-4"></i>
                                            <p class="text-lg font-bold mb-2">Belum ada riwayat aktivitas</p>
                                            <p class="text-sm">Aktivitas akan muncul di sini setelah ada interaksi
                                                dengan dokumen</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($logs->hasPages())
                    <div class="p-6 border-t border-gray-200 dark:border-zinc-700">
                        {{ $logs->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
