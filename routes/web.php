<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
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
    Route::get('documents', \App\Livewire\Documents\DocumentIndex::class)->name('documents.index');
    Route::get('documents/create', \App\Livewire\Documents\DocumentCreate::class)->name('documents.create');
    Route::get('documents/{document}/edit', \App\Livewire\Documents\DocumentEdit::class)->name('documents.edit');


    Route::get('/documents/{document}/download', function (Document $document) {
    $filePath = storage_path('app/public/' . $document->file_path);
    
    if (!file_exists($filePath)) {
        abort(404, 'File tidak ditemukan');
    }
    
    return response()->download($filePath, $document->file_name);
})->name('documents.download');
});

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