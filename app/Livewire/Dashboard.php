<?php

namespace App\Livewire;

use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        // Total Documents
        $totalDocuments = Document::count();

        // Total Storage Used (in bytes)
        $totalStorage = Document::sum('file_size');
        $formattedStorage = $this->formatBytes($totalStorage);

        // Recent Documents (5 latest)
        $recentDocuments = Document::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Documents by File Type
        $documentsByType = Document::select('file_type', DB::raw('count(*) as count'))
            ->groupBy('file_type')
            ->get()
            ->map(function ($item) {
                return [
                    'type' => $item->file_type,
                    'count' => $item->count
                ];
            });

        // Documents Upload Trend by Year (all months Jan-Dec)
        // Get data for last 6 years
        $currentYear = date('Y');
        $uploadTrendByYear = [];

        for ($year = $currentYear; $year >= $currentYear - 5; $year--) {
            $yearData = Document::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('count(*) as count')
            )
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->map(function ($item) {
                    return [
                        'month' => $item->month,
                        'count' => $item->count
                    ];
                })
                ->toArray();

            $uploadTrendByYear[$year] = $yearData;
        }

        // Top Contributors (users with most documents)
        $topContributors = User::select('users.id', 'users.name', DB::raw('count(documents.id) as document_count'))
            ->join('documents', 'users.id', '=', 'documents.user_id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('document_count')
            ->take(5)
            ->get();

        // Total Users
        $totalUsers = User::count();

        // Average documents per user
        $avgDocumentsPerUser = $totalUsers > 0 ? round($totalDocuments / $totalUsers, 1) : 0;

        return view('livewire.dashboard', [
            'totalDocuments' => $totalDocuments,
            'totalStorage' => $totalStorage,
            'formattedStorage' => $formattedStorage,
            'recentDocuments' => $recentDocuments,
            'documentsByType' => $documentsByType,
            'uploadTrendByYear' => $uploadTrendByYear,
            'topContributors' => $topContributors,
            'totalUsers' => $totalUsers,
            'avgDocumentsPerUser' => $avgDocumentsPerUser,
        ]);
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
