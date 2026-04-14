<div>
    @if ($document->is_confidential)
        <div class="inline-flex items-center gap-2">
            <!-- Security Status Badge -->
            <button wire:click="toggleDetails"
                class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-xs font-semibold transition
                {{ $document->security_status === 'secured'
                    ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 hover:bg-green-200'
                    : ($document->security_status === 'partial'
                        ? 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 hover:bg-yellow-200'
                        : 'bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400 hover:bg-gray-200') }}">
                <i class="fas fa-shield-alt"></i>
                @if ($document->security_status === 'secured')
                    Secured
                @elseif($document->security_status === 'partial')
                    Partial
                @else
                    Basic
                @endif
            </button>

            <!-- Quick Actions -->
            @if ($document->qr_code_path)
                <button wire:click="downloadQR"
                    class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 text-gray-600 dark:text-gray-400 transition"
                    title="Download QR Code">
                    <i class="fas fa-qrcode text-sm"></i>
                </button>
            @endif

            <button wire:click="verifyDocument"
                class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 text-gray-600 dark:text-gray-400 transition"
                title="Verify Document">
                <i class="fas fa-check-circle text-sm"></i>
            </button>
        </div>

        <!-- Details Dropdown -->
        @if ($showDetails)
            <div
                class="mt-2 p-3 bg-gray-50 dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700 text-xs">
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Document Hash:</span>
                        <span class="font-mono text-gray-900 dark:text-white">
                            {{ $document->document_hash ? '✓' : '✗' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">File Checksum:</span>
                        <span class="font-mono text-gray-900 dark:text-white">
                            {{ $document->file_checksum ? '✓' : '✗' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">QR Code:</span>
                        <span class="font-mono text-gray-900 dark:text-white">
                            {{ $document->qr_code_path ? '✓' : '✗' }}
                        </span>
                    </div>
                    @if ($document->last_verified_at)
                        <div
                            class="flex items-center justify-between pt-2 border-t border-gray-200 dark:border-zinc-700">
                            <span class="text-gray-600 dark:text-gray-400">Last Verified:</span>
                            <span class="text-gray-900 dark:text-white">
                                {{ $document->last_verified_at->diffForHumans() }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @else
        <span
            class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 dark:bg-gray-900/30 text-gray-600 dark:text-gray-400 rounded-lg text-xs font-semibold">
            <i class="fas fa-file"></i>
            Normal
        </span>
    @endif
</div>
