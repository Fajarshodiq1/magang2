<!-- Di bagian header atau action buttons -->
<div class="bg-white rounded-3xl p-6 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">{{ $document->title }}</h1>
            <p class="text-sm text-gray-600">Detail Dokumen</p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Download Original -->
            <a href="{{ route('documents.download', $document) }}"
                class="px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-full transition">
                <i class="fas fa-download mr-2"></i>
                Download Asli
            </a>

            <!-- Download dengan QR Code (BARU) -->
            @if ($document->hasEmbeddedQR())
                <a href="{{ route('documents.download-embedded', $document) }}"
                    class="px-4 py-2.5 bg-purple-600 hover:bg-purple-700 text-white rounded-full transition">
                    <i class="fas fa-qrcode mr-2"></i>
                    Download dengan QR
                </a>
            @else
                @if ($document->is_confidential)
                    <button onclick="generateEmbeddedQR({{ $document->id }})"
                        class="px-4 py-2.5 bg-gray-400 text-white rounded-full">
                        <i class="fas fa-spinner mr-2"></i>
                        Generate QR
                    </button>
                @endif
            @endif

            <!-- Back Button -->
            <a href="{{ route('documents.index') }}"
                class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>
</div>

<!-- Info Section tentang QR -->
@if ($document->is_confidential)
    <div class="bg-purple-50 border border-purple-200 rounded-3xl p-6 mb-6">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <i class="fas fa-qrcode text-3xl text-purple-600"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-purple-900 mb-2">Dokumen Terverifikasi dengan QR Code</h3>

                @if ($document->hasEmbeddedQR())
                    <p class="text-sm text-purple-700 mb-3">
                        <i class="fas fa-check-circle mr-1"></i>
                        QR Code telah tertanam di dokumen. Download versi dengan QR Code untuk mendapatkan dokumen yang
                        sudah tervalidasi.
                    </p>

                    <div class="flex gap-3">
                        <a href="{{ route('documents.download-embedded', $document) }}"
                            class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-sm font-semibold">
                            <i class="fas fa-download mr-2"></i>
                            Download Versi dengan QR
                        </a>

                        <a href="{{ route('documents.verify', $document) }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold">
                            <i class="fas fa-shield-check mr-2"></i>
                            Verifikasi Dokumen
                        </a>
                    </div>
                @else
                    <p class="text-sm text-purple-700 mb-3">
                        <i class="fas fa-info-circle mr-1"></i>
                        QR Code belum di-generate. Klik tombol di bawah untuk membuat dokumen dengan QR Code tertanam.
                    </p>

                    <form action="{{ route('documents.generate-embedded-qr', $document) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-sm font-semibold">
                            <i class="fas fa-cog mr-2"></i>
                            Generate QR Code Sekarang
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endif
