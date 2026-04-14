<?php

use App\Http\Controllers\Api\QRScannerController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentVerificationController;
use App\Livewire\Category\CategoryCreate;
use App\Livewire\Category\CategoryEdit;
use App\Livewire\Category\CategoryIndex;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserEdit;
use App\Livewire\Users\UserIndex;
use App\Models\Document;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Document CRUD Routes
    Route::get('documents', \App\Livewire\Documents\DocumentIndex::class)->name('documents.index');
    Route::get('documents/create', \App\Livewire\Documents\DocumentCreate::class)->name('documents.create');
    Route::get('documents/{document}/edit', \App\Livewire\Documents\DocumentEdit::class)->name('documents.edit');
    Route::get('documents/{document}', \App\Livewire\Documents\DocumentShow::class)->name('documents.show');

    // Document Download Routes
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])
        ->name('documents.download');

    // BARU: Download dengan QR Code Embedded
    Route::get('/documents/{document}/download-embedded', [DocumentController::class, 'downloadEmbedded'])
        ->name('documents.download-embedded');

    // ==========================================
    // ENHANCED DOCUMENT SECURITY & VERIFICATION
    // ==========================================
    Route::prefix('documents/{id}')->name('documents.')->group(function () {
        // Main Verification Page
        Route::get('/verify', [DocumentVerificationController::class, 'show'])
            ->name('verify');

        // Hash Verification
        Route::get('/verify-hash', [DocumentVerificationController::class, 'verifyHash'])
            ->name('verify.hash');

        Route::get('/check-integrity', [DocumentVerificationController::class, 'checkIntegrity'])
            ->name('check.integrity');

        // Hash History
        Route::get('/hash-history', [DocumentVerificationController::class, 'hashHistory'])
            ->name('hash.history');

        // QR Code Operations
        Route::post('/verify-qr', [DocumentVerificationController::class, 'verifyQR'])
            ->name('verify.qr');

        Route::get('/qr/download', [DocumentVerificationController::class, 'downloadQR'])
            ->name('qr.download');

        // BARU: Generate QR Code Embedded Manual
        Route::post('/generate-embedded-qr', [DocumentController::class, 'generateEmbeddedQR'])
            ->name('generate-embedded-qr');

        // Security Management
        Route::post('/security/regenerate', [DocumentVerificationController::class, 'regenerateSecurity'])
            ->name('security.regenerate');

        Route::post('/security/generate', [DocumentVerificationController::class, 'forceGenerateSecurity'])
            ->name('security.generate');

        // Audit & Logs
        Route::get('/audit-logs', [DocumentVerificationController::class, 'auditLogs'])
            ->name('audit.logs');
    });

    // Category Routes
    Route::get('categories', CategoryIndex::class)->name('categories.index');
    Route::get('categories/create', CategoryCreate::class)->name('categories.create');
    Route::get('categories/edit', CategoryEdit::class)->name('categories.edit');

    // Archive Classification Routes
    Route::get('archive-classifications', \App\Livewire\ArchiveClassifications\ArchiveClassificationIndex::class)
        ->name('archive-classifications.index');
    Route::get('archive-classifications/create', \App\Livewire\ArchiveClassifications\ArchiveClassificationCreate::class)
        ->name('archive-classifications.create');

    // User Management Routes
    Route::middleware(['permission:users.view'])->group(function () {
        Route::get('/users', UserIndex::class)->name('users.index');
        Route::get('/users/create', UserCreate::class)->name('users.create')
            ->middleware('permission:users.create');
        Route::get('/users/{user}/edit', UserEdit::class)->name('users.edit')
            ->middleware('permission:users.edit');
    });
});

// ==========================================
// QR SCANNER & PUBLIC VERIFICATION
// ==========================================
Route::middleware(['auth'])->group(function () {
    // QR Scanner Interface
    Route::get('/qr-scanner', function () {
        return view('qr-scanner');
    })->name('qr.scanner');
});

// Public QR Verification (No auth required for external verification)
Route::post('/verify-qr-public', [DocumentVerificationController::class, 'verifyQR'])
    ->name('documents.qr.verify.public');
Route::get('/v/{id}/{token}/download', [DocumentVerificationController::class, 'publicDownload'])
    ->name('documents.public.download');

// Tambahkan di sebelah route public.download yang sudah ada
Route::get(
    '/verify/{id}/{token}/download-embedded',
    [DocumentVerificationController::class, 'publicDownloadEmbedded']
)->name('documents.public.download-embedded');
Route::get('/v/{id}/{token}', [DocumentVerificationController::class, 'publicVerify'])
    ->name('documents.public.verify');
// ==========================================
// API ROUTES (v1)
// ==========================================
Route::prefix('api/v1')->name('api.')->group(function () {
    // QR Verification API
    Route::post('/qr/verify', [QRScannerController::class, 'verify'])
        ->name('qr.verify');

    // Document Info API
    Route::get('/documents/{documentId}', [QRScannerController::class, 'getDocumentInfo'])
        ->name('documents.info');

    // Batch Operations
    Route::post('/documents/batch-verify', [QRScannerController::class, 'batchVerify'])
        ->name('documents.batch.verify');

    // Document Hash Verification API
    Route::get('/documents/{id}/verify-hash', [DocumentVerificationController::class, 'verifyHash'])
        ->name('documents.verify.hash');

    Route::get('/documents/{id}/check-integrity', [DocumentVerificationController::class, 'checkIntegrity'])
        ->name('documents.check.integrity');

    // Document Comparison
    Route::post('/documents/compare', [DocumentVerificationController::class, 'compareDocuments'])
        ->name('documents.compare');

    // Bulk Verify
    Route::post('/documents/bulk-verify', [DocumentVerificationController::class, 'bulkVerify'])
        ->name('documents.bulk.verify');

    // BARU: Check if document has embedded QR
    Route::get('/documents/{id}/has-embedded-qr', [DocumentController::class, 'hasEmbeddedQR'])
        ->name('documents.has.embedded.qr');
});

// ==========================================
// SETTINGS ROUTES
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});