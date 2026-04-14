    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verifikasi Dokumen — {{ $document->title }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link
            href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Mono:wght@400;500&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            :root {
                --bg: #F5F4F0;
                --surface: #FFFFFF;
                --surface-2: #F9F8F5;
                --border: #E8E6DF;
                --text-primary: #1A1916;
                --text-secondary: #6B6860;
                --text-muted: #A8A59F;
                --accent-green: #1A7A4A;
                --accent-green-bg: #EAF5EF;
                --accent-green-border: #B8DFC9;
                --accent-yellow: #9A6E00;
                --accent-yellow-bg: #FEF8E8;
                --accent-yellow-border: #F0D98A;
                --accent-red: #B83232;
                --accent-red-bg: #FDEAEA;
                --accent-red-border: #F0B8B8;
                --accent-blue: #1A5FA8;
                --accent-blue-bg: #EAF0FA;
                --accent-blue-border: #B8CEF0;
                --accent-purple: #5A2DA8;
                --accent-purple-bg: #F0EAFA;
                --accent-purple-border: #CCB8F0;
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: 'DM Sans', sans-serif;
                background: var(--bg);
                color: var(--text-primary);
                min-height: 100vh;
                -webkit-font-smoothing: antialiased;
            }

            code,
            .mono {
                font-family: 'DM Mono', monospace;
            }

            /* Layout */
            .page-wrapper {
                max-width: 1200px;
                margin: 0 auto;
                padding: 32px 24px;
            }

            /* Top Nav Bar */
            .topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 32px;
            }

            .topbar-left {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .back-btn {
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 8px 16px;
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: 100px;
                font-size: 13px;
                font-weight: 500;
                color: var(--text-secondary);
                text-decoration: none;
                transition: all 0.15s;
            }

            .back-btn:hover {
                background: var(--surface-2);
                color: var(--text-primary);
            }

            .page-title {
                font-size: 15px;
                font-weight: 600;
                color: var(--text-primary);
            }

            .page-subtitle {
                font-size: 12px;
                color: var(--text-muted);
                margin-top: 1px;
            }

            .topbar-right {
                display: flex;
                gap: 8px;
            }

            .btn-print {
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 8px 16px;
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: 100px;
                font-size: 13px;
                font-weight: 500;
                color: var(--text-secondary);
                cursor: pointer;
                transition: all 0.15s;
            }

            .btn-print:hover {
                background: var(--surface-2);
                color: var(--text-primary);
            }

            /* Status Banner */
            .status-banner {
                border-radius: 16px;
                padding: 24px 28px;
                margin-bottom: 24px;
                display: flex;
                align-items: center;
                gap: 20px;
                border: 1.5px solid;
            }

            .status-banner.verified {
                background: var(--accent-green-bg);
                border-color: var(--accent-green-border);
            }

            .status-banner.partial {
                background: var(--accent-yellow-bg);
                border-color: var(--accent-yellow-border);
            }

            .status-banner.failed {
                background: var(--accent-red-bg);
                border-color: var(--accent-red-border);
            }

            .status-icon {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                font-size: 20px;
            }

            .status-icon.verified {
                background: var(--accent-green);
                color: white;
            }

            .status-icon.partial {
                background: var(--accent-yellow);
                color: white;
            }

            .status-icon.failed {
                background: var(--accent-red);
                color: white;
            }

            .status-text-title {
                font-size: 18px;
                font-weight: 700;
                line-height: 1.2;
            }

            .status-text-title.verified {
                color: var(--accent-green);
            }

            .status-text-title.partial {
                color: var(--accent-yellow);
            }

            .status-text-title.failed {
                color: var(--accent-red);
            }

            .status-text-desc {
                font-size: 13px;
                margin-top: 4px;
                color: var(--text-secondary);
            }

            .status-timestamp {
                font-size: 11px;
                color: var(--text-muted);
                margin-top: 6px;
            }

            .status-badge {
                margin-left: auto;
                padding: 6px 16px;
                border-radius: 100px;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.06em;
                text-transform: uppercase;
            }

            .status-badge.verified {
                background: var(--accent-green);
                color: white;
            }

            .status-badge.partial {
                background: var(--accent-yellow);
                color: white;
            }

            .status-badge.failed {
                background: var(--accent-red);
                color: white;
            }

            /* Grid Layout */
            .content-grid {
                display: grid;
                grid-template-columns: 1fr 320px;
                gap: 20px;
                align-items: start;
            }

            @media (max-width: 900px) {
                .content-grid {
                    grid-template-columns: 1fr;
                }
            }

            /* Card */
            .card {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: 16px;
                padding: 24px;
                margin-bottom: 16px;
            }

            .card-title {
                font-size: 13px;
                font-weight: 700;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.08em;
                margin-bottom: 18px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            /* Hash Check Items */
            .hash-section {
                border-radius: 12px;
                border: 1px solid;
                padding: 16px;
                margin-bottom: 12px;
            }

            .hash-section.blue {
                background: var(--accent-blue-bg);
                border-color: var(--accent-blue-border);
            }

            .hash-section.purple {
                background: var(--accent-purple-bg);
                border-color: var(--accent-purple-border);
            }

            .hash-section.gray {
                background: var(--surface-2);
                border-color: var(--border);
            }

            .hash-section-title {
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.07em;
                text-transform: uppercase;
                margin-bottom: 12px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .hash-section-title.blue {
                color: var(--accent-blue);
            }

            .hash-section-title.purple {
                color: var(--accent-purple);
            }

            /* Hash Item Row */
            .hash-item {
                background: var(--surface);
                border-radius: 10px;
                padding: 14px 16px;
                margin-bottom: 8px;
                border-left: 3px solid;
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .hash-item:last-child {
                margin-bottom: 0;
            }

            .hash-item.valid {
                border-left-color: #2DB875;
            }

            .hash-item.invalid {
                border-left-color: var(--accent-red);
            }

            .hash-item.pending {
                border-left-color: var(--accent-purple);
            }

            .hash-item-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .hash-item-label {
                font-size: 13px;
                font-weight: 600;
                color: var(--text-primary);
                display: flex;
                align-items: center;
                gap: 7px;
            }

            .tag {
                display: inline-flex;
                align-items: center;
                padding: 3px 10px;
                border-radius: 100px;
                font-size: 10px;
                font-weight: 700;
                letter-spacing: 0.06em;
                text-transform: uppercase;
            }

            .tag.valid {
                background: #D6F3E6;
                color: #0F6638;
            }

            .tag.invalid {
                background: var(--accent-red-bg);
                color: var(--accent-red);
            }

            .tag.pending {
                background: var(--accent-purple-bg);
                color: var(--accent-purple);
            }

            .tag.info {
                background: var(--accent-blue-bg);
                color: var(--accent-blue);
            }

            .tag.warn {
                background: var(--accent-yellow-bg);
                color: var(--accent-yellow);
            }

            .hash-item-desc {
                font-size: 11px;
                color: var(--text-muted);
                line-height: 1.5;
            }

            .hash-value {
                font-family: 'DM Mono', monospace;
                font-size: 11px;
                background: var(--surface-2);
                border: 1px solid var(--border);
                border-radius: 7px;
                padding: 8px 10px;
                color: var(--text-secondary);
                word-break: break-all;
                line-height: 1.5;
            }

            .hash-item-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            /* Note / Warning blocks */
            .note-block {
                border-radius: 10px;
                padding: 12px 16px;
                font-size: 12px;
                line-height: 1.6;
                display: flex;
                gap: 10px;
                margin-top: 16px;
            }

            .note-block.blue {
                background: var(--accent-blue-bg);
                color: var(--accent-blue);
                border: 1px solid var(--accent-blue-border);
            }

            .note-block.red {
                background: var(--accent-red-bg);
                color: var(--accent-red);
                border: 1px solid var(--accent-red-border);
            }

            .note-block ul {
                padding-left: 4px;
                margin-top: 4px;
            }

            .note-block ul li {
                margin-bottom: 3px;
            }

            /* Info grid */
            .info-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }

            .info-item {}

            .info-label {
                font-size: 11px;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.06em;
                font-weight: 600;
                margin-bottom: 3px;
            }

            .info-value {
                font-size: 13px;
                font-weight: 600;
                color: var(--text-primary);
            }

            /* History */
            .history-item {
                display: flex;
                align-items: flex-start;
                gap: 12px;
                padding: 12px 0;
                border-bottom: 1px solid var(--border);
            }

            .history-item:last-child {
                border-bottom: none;
            }

            .history-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                margin-top: 5px;
                flex-shrink: 0;
            }

            .history-dot.valid {
                background: #2DB875;
            }

            .history-dot.invalid {
                background: var(--accent-red);
            }

            .history-type {
                font-size: 13px;
                font-weight: 600;
                color: var(--text-primary);
            }

            .history-meta {
                font-size: 11px;
                color: var(--text-muted);
                margin-top: 2px;
            }

            /* Sidebar specific */
            .qr-card {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: 16px;
                padding: 24px;
                margin-bottom: 16px;
                text-align: center;
            }

            .qr-image {
                width: 160px;
                height: 160px;
                border-radius: 12px;
                border: 1px solid var(--border);
                object-fit: contain;
                margin: 0 auto 14px;
                display: block;
            }

            /* Action Buttons */
            .action-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                width: 100%;
                padding: 11px 20px;
                border-radius: 10px;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                cursor: pointer;
                transition: all 0.15s;
                border: none;
                margin-bottom: 8px;
            }

            .action-btn:last-child {
                margin-bottom: 0;
            }

            .action-btn.primary {
                background: var(--text-primary);
                color: white;
            }

            .action-btn.primary:hover {
                background: #333;
            }

            .action-btn.secondary {
                background: var(--surface-2);
                border: 1px solid var(--border);
                color: var(--text-primary);
            }

            .action-btn.secondary:hover {
                background: var(--border);
            }

            .action-btn.green {
                background: #1A7A4A;
                color: white;
            }

            .action-btn.green:hover {
                background: #155f3a;
            }

            .action-btn.purple {
                background: var(--accent-purple);
                color: white;
            }

            .action-btn.purple:hover {
                background: #4a2490;
            }

            .action-btn.danger-outline {
                background: white;
                border: 1.5px solid var(--accent-red-border);
                color: var(--accent-red);
            }

            .action-btn.danger-outline:hover {
                background: var(--accent-red-bg);
            }

            /* Security features list */
            .feature-list {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .feature-item {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                font-size: 12px;
                line-height: 1.5;
                color: var(--text-secondary);
            }

            .feature-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: var(--text-muted);
                flex-shrink: 0;
                margin-top: 5px;
            }

            .feature-item strong {
                color: var(--text-primary);
                font-weight: 600;
            }

            /* Divider */
            .divider {
                border: none;
                border-top: 1px solid var(--border);
                margin: 20px 0;
            }

            /* Scroll area */
            .scroll-area {
                max-height: 320px;
                overflow-y: auto;
            }

            .scroll-area::-webkit-scrollbar {
                width: 4px;
            }

            .scroll-area::-webkit-scrollbar-track {
                background: transparent;
            }

            .scroll-area::-webkit-scrollbar-thumb {
                background: var(--border);
                border-radius: 2px;
            }

            @media print {
                .no-print {
                    display: none !important;
                }

                body {
                    background: white;
                }

                .card {
                    border: 1px solid #ddd;
                }
            }
        </style>
    </head>

    <body>
        <div class="page-wrapper">

            <!-- Top Nav -->
            <div class="topbar no-print">
                <div class="topbar-left">
                    <a href="{{ route('documents.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left" style="font-size:11px"></i>
                        Kembali
                    </a>
                    <div>
                        <div class="page-title">Verifikasi Integritas Dokumen</div>
                        <div class="page-subtitle">{{ $document->title }}</div>
                    </div>
                </div>
                {{-- <div class="topbar-right">
                    <button onclick="window.print()" class="btn-print">
                        <i class="fas fa-print" style="font-size:12px"></i>
                        Print
                    </button>
                </div> --}}
            </div>

            <!-- Status Banner -->
            <div
                class="status-banner {{ $verification['status'] === 'verified' ? 'verified' : ($verification['status'] === 'partial' ? 'partial' : 'failed') }}">
                <div
                    class="status-icon {{ $verification['status'] === 'verified' ? 'verified' : ($verification['status'] === 'partial' ? 'partial' : 'failed') }}">
                    <i
                        class="fas {{ $verification['status'] === 'verified' ? 'fa-check' : ($verification['status'] === 'partial' ? 'fa-exclamation' : 'fa-times') }}"></i>
                </div>
                <div>
                    <div
                        class="status-text-title {{ $verification['status'] === 'verified' ? 'verified' : ($verification['status'] === 'partial' ? 'partial' : 'failed') }}">
                        @if ($verification['status'] === 'verified')
                            Dokumen Terverifikasi
                        @elseif ($verification['status'] === 'partial')
                            Verifikasi Sebagian
                        @else
                            Verifikasi Gagal
                        @endif
                    </div>
                    <div class="status-text-desc">
                        @if ($verification['status'] === 'verified')
                            Semua pemeriksaan keamanan berhasil. Dokumen asli dan tidak ada perubahan.
                        @elseif ($verification['status'] === 'partial')
                            Beberapa pemeriksaan gagal. Periksa detail di bawah untuk informasi selengkapnya.
                        @else
                            Dokumen tidak lolos verifikasi. File mungkin telah dimodifikasi.
                        @endif
                    </div>
                    @if ($document->last_verified_at)
                        <div class="status-timestamp">
                            <i class="fas fa-clock" style="margin-right:4px"></i>
                            Terakhir diverifikasi: {{ $document->last_verified_at->diffForHumans() }}
                        </div>
                    @endif
                </div>
                <div
                    class="status-badge {{ $verification['status'] === 'verified' ? 'verified' : ($verification['status'] === 'partial' ? 'partial' : 'failed') }}">
                    @if ($verification['status'] === 'verified')
                        TERSERTIFIKASI
                    @elseif ($verification['status'] === 'partial')
                        PARTIAL
                    @else
                        NOT VERIFIED
                    @endif
                </div>
            </div>

            <!-- Main Grid -->
            <div class="content-grid">

                <!-- LEFT: Main Content -->
                <div>

                    <!-- Hash Verification Card -->
                    <div class="card">
                        <div class="card-title">
                            <i class="fas fa-fingerprint" style="color: var(--accent-blue)"></i>
                            Detail Verifikasi Hash
                        </div>

                        <!-- File Original Section -->
                        <div class="hash-section blue">
                            <div class="hash-section-title blue">
                                <i class="fas fa-file"></i>
                                File Original — Sebelum Embed QR
                            </div>

                            <!-- Document Hash MD5 -->
                            <div class="hash-item {{ $verification['hash_valid'] ? 'valid' : 'invalid' }}">
                                <div class="hash-item-header">
                                    <div class="hash-item-label">
                                        <i class="fas fa-fingerprint"
                                            style="font-size:12px; color: {{ $verification['hash_valid'] ? '#2DB875' : 'var(--accent-red)' }}"></i>
                                        Document Hash (MD5)
                                    </div>
                                    <span
                                        class="tag {{ $verification['hash_valid'] ? 'valid' : 'invalid' }}">{{ $verification['hash_valid'] ? 'Valid' : 'Invalid' }}</span>
                                </div>
                                <div class="hash-item-desc">
                                    MD5 murni dari isi file original — verifikasi dengan
                                    <code
                                        style="background: var(--surface-2); padding: 1px 5px; border-radius:4px; font-size:10px">md5sum
                                        {{ $document->file_name }}</code>
                                </div>
                                <div class="hash-value">{{ $document->document_hash ?? 'Belum di-generate' }}</div>
                            </div>

                            <!-- File Checksum -->
                            <div class="hash-item {{ $verification['file_integrity'] ? 'valid' : 'invalid' }}">
                                <div class="hash-item-header">
                                    <div class="hash-item-label">
                                        <i class="fas fa-shield-halved"
                                            style="font-size:12px; color: {{ $verification['file_integrity'] ? '#2DB875' : 'var(--accent-red)' }}"></i>
                                        File Checksum (MD5)
                                    </div>
                                    <span
                                        class="tag {{ $verification['file_integrity'] ? 'valid' : 'invalid' }}">{{ $verification['file_integrity'] ? 'Valid' : 'Invalid' }}</span>
                                </div>
                                <div class="hash-item-desc">
                                    Checksum untuk deteksi perubahan cepat pada file original
                                </div>
                                <div class="hash-value">{{ $document->file_checksum ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <!-- Embedded QR Section -->
                        @if ($document->embedded_document_path && $document->embedded_document_hash)
                            <div class="hash-section purple">
                                <div class="hash-section-title purple">
                                    <i class="fas fa-qrcode"></i>
                                    File dengan QR Code — Setelah Embed
                                </div>

                                <div
                                    style="background: var(--accent-purple-bg); border: 1px solid var(--accent-purple-border); border-radius: 8px; padding: 8px 12px; font-size: 11px; color: var(--accent-purple); margin-bottom: 10px; display: flex; align-items: flex-start; gap: 8px;">
                                    <i class="fas fa-info-circle" style="margin-top:2px; flex-shrink:0"></i>
                                    Hash ini berbeda dari file original — wajar karena file berubah setelah QR di-embed.
                                </div>

                                <div
                                    class="hash-item {{ $verification['embedded_hash_valid'] === true ? 'valid' : ($verification['embedded_hash_valid'] === false ? 'invalid' : 'pending') }}">
                                    <div class="hash-item-header">
                                        <div class="hash-item-label">
                                            <i class="fas fa-file-pdf"
                                                style="font-size:12px; color: {{ $verification['embedded_hash_valid'] === true ? '#2DB875' : ($verification['embedded_hash_valid'] === false ? 'var(--accent-red)' : 'var(--accent-purple)') }}"></i>
                                            Embedded Document Hash (MD5)
                                        </div>
                                        @if ($verification['embedded_hash_valid'] !== null)
                                            <span
                                                class="tag {{ $verification['embedded_hash_valid'] ? 'valid' : 'invalid' }}">{{ $verification['embedded_hash_valid'] ? 'Valid' : 'Invalid' }}</span>
                                        @else
                                            <span class="tag pending">Belum Diverifikasi</span>
                                        @endif
                                    </div>
                                    <div class="hash-item-desc">MD5 dari file PDF hasil embed QR</div>
                                    <div class="hash-value">{{ $document->embedded_document_hash }}</div>
                                    <div class="hash-item-footer">
                                        <div
                                            style="font-size:11px; color:var(--text-muted); font-family:'DM Mono',monospace;">
                                            {{ $document->embedded_document_path }}
                                        </div>
                                        <a href="{{ route('documents.download-embedded', $document) }}"
                                            class="tag info" style="text-decoration:none; cursor:pointer;">
                                            <i class="fas fa-download" style="margin-right:4px"></i>Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="hash-section gray"
                                style="display:flex; align-items:center; gap:14px; padding: 18px;">
                                <i class="fas fa-qrcode"
                                    style="font-size:24px; color:var(--text-muted); opacity:0.5"></i>
                                <div>
                                    <div style="font-size:13px; font-weight:600; color:var(--text-secondary)">File
                                        dengan QR
                                        belum tersedia</div>
                                    <div style="font-size:11px; color:var(--text-muted); margin-top:2px">QR Code belum
                                        di-embed. Hash file original tetap valid.</div>
                                </div>
                            </div>
                        @endif

                        <!-- QR Status -->
                        <div class="hash-section gray"
                            style="display:flex; align-items:center; justify-content:space-between; padding: 14px 16px; margin-top: 12px;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <i class="fas fa-qrcode"
                                    style="color: {{ $verification['qr_exists'] ? '#2DB875' : 'var(--accent-yellow)' }}; font-size:14px"></i>
                                <span style="font-size:13px; font-weight:600; color:var(--text-primary)">QR Code
                                    Kepemilikan</span>
                            </div>
                            <span
                                class="tag {{ $verification['qr_exists'] ? 'valid' : 'warn' }}">{{ $verification['qr_exists'] ? 'Tersedia' : 'Tidak Ada' }}</span>
                        </div>

                        <!-- Verification Notes -->
                        @if (!empty($verification['messages']))
                            <div class="note-block blue" style="margin-top: 16px;">
                                <i class="fas fa-circle-info" style="flex-shrink:0; margin-top:2px"></i>
                                <div>
                                    <strong style="display:block; margin-bottom:4px">Catatan Verifikasi</strong>
                                    <ul style="padding-left: 14px;">
                                        @foreach ($verification['messages'] as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if (!empty($verification['changes_detected']))
                            <div class="note-block red" style="margin-top: 12px;">
                                <i class="fas fa-triangle-exclamation" style="flex-shrink:0; margin-top:2px"></i>
                                <div>
                                    <strong style="display:block; margin-bottom:4px">Perubahan Terdeteksi</strong>
                                    <ul style="padding-left: 14px;">
                                        @foreach ($verification['changes_detected'] as $change)
                                            <li>{{ $change }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <!-- Regenerate -->
                        @can('update', $document)
                            <hr class="divider">
                            <form action="{{ route('documents.security.regenerate', $document) }}" method="POST"
                                onsubmit="return confirm('Regenerate security features? Hash baru akan dibuat.')">
                                @csrf
                                <button type="submit" class="action-btn primary no-print">
                                    <i class="fas fa-arrows-rotate"></i>
                                    Regenerate Security Features
                                </button>
                            </form>
                        @endcan
                    </div>

                    <!-- Hash History -->
                    @if ($hashHistory->isNotEmpty())
                        <div class="card">
                            <div class="card-title">
                                <i class="fas fa-clock-rotate-left" style="color:var(--accent-purple)"></i>
                                Riwayat Verifikasi
                            </div>
                            <div class="scroll-area">
                                @foreach ($hashHistory as $history)
                                    <div class="history-item">
                                        <div class="history-dot {{ $history->is_valid ? 'valid' : 'invalid' }}"
                                            style="margin-top:6px"></div>
                                        <div style="flex:1">
                                            <div class="history-type">
                                                {{ ucwords(str_replace('_', ' ', $history->verification_type)) }}</div>
                                            <div class="history-meta">
                                                {{ $history->verified_at->format('d M Y, H:i') }}
                                                @if ($history->verifiedBy)
                                                    · {{ $history->verifiedBy->name }}
                                                @endif
                                            </div>
                                            @if ($history->hasDetectedChanges())
                                                <div style="font-size:11px; color:var(--accent-red); margin-top:4px;">
                                                    <i class="fas fa-exclamation-circle" style="margin-right:4px"></i>
                                                    {{ implode(', ', (array) $history->changes_detected) }}
                                                </div>
                                            @endif
                                        </div>
                                        <span
                                            class="tag {{ $history->is_valid ? 'valid' : 'invalid' }}">{{ $history->is_valid ? 'Valid' : 'Invalid' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Document Info -->
                    <div class="card">
                        <div class="card-title">
                            <i class="fas fa-circle-info" style="color: var(--accent-purple)"></i>
                            Informasi Dokumen
                        </div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Pemilik</div>
                                <div class="info-value">{{ $document->user->name }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Ukuran File</div>
                                <div class="info-value">{{ $document->formatted_file_size }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Tipe File</div>
                                <div class="info-value">{{ strtoupper($document->file_type) }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Dibuat</div>
                                <div class="info-value">{{ $document->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            @if ($document->archiveClassification)
                                <div class="info-item" style="grid-column: span 2">
                                    <div class="info-label">Klasifikasi Arsip</div>
                                    <div class="info-value">{{ $document->archiveClassification->code }} —
                                        {{ $document->archiveClassification->name }}</div>
                                </div>
                            @endif
                            <div class="info-item">
                                <div class="info-label">Hash Algorithm</div>
                                <div class="info-value mono" style="font-size:12px">
                                    {{ $document->hash_algorithm ?? 'SHA-256' }}</div>
                            </div>
                            @if ($document->hash_generated_at)
                                <div class="info-item">
                                    <div class="info-label">Hash Generated</div>
                                    <div class="info-value" style="font-size:12px">
                                        {{ $document->hash_generated_at->format('d M Y, H:i:s') }}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- RIGHT: Sidebar -->
                <div>

                    <!-- QR Code -->
                    @if ($document->qr_code_path && \Storage::disk('public')->exists($document->qr_code_path))
                        <div class="qr-card">
                            <div class="card-title" style="justify-content:center; margin-bottom:16px">
                                <i class="fas fa-qrcode" style="color:var(--text-muted)"></i>
                                QR Code Verifikasi
                            </div>
                            <img src="{{ \Storage::url($document->qr_code_path) }}" alt="QR Code" class="qr-image">
                            <p style="font-size:11px; color:var(--text-muted); margin-bottom:14px; line-height:1.5">
                                Scan untuk verifikasi kepemilikan dan integritas dokumen
                            </p>
                            <a href="{{ route('documents.qr.download', $document) }}"
                                class="action-btn primary no-print" style="margin-bottom:0">
                                <i class="fas fa-download"></i>
                                Download QR Code
                            </a>
                        </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="card no-print">
                        <div class="card-title">
                            <i class="fas fa-bolt" style="color: #E0A800"></i>
                            Aksi Cepat
                        </div>

                        @if ($document->hasEmbeddedQR())
                            <a href="{{ route('documents.download-embedded', $document) }}"
                                class="action-btn purple">
                                <i class="fas fa-qrcode"></i>
                                Download dengan QR
                            </a>
                        @endif

                        <a href="{{ route('documents.download', $document) }}" class="action-btn green">
                            <i class="fas fa-download"></i>
                            Download Asli
                        </a>

                        <a href="{{ route('documents.audit.logs', $document) }}" class="action-btn secondary">
                            <i class="fas fa-clock-rotate-left"></i>
                            Lihat Audit Logs
                        </a>

                        <button onclick="window.location.reload()" class="action-btn secondary" style="width:100%">
                            <i class="fas fa-rotate-right"></i>
                            Refresh Verifikasi
                        </button>
                    </div>

                    <!-- Security Features -->
                    <div class="card" style="background: var(--surface-2)">
                        <div class="card-title">
                            <i class="fas fa-shield-halved" style="color:var(--accent-purple)"></i>
                            Fitur Keamanan
                        </div>
                        <div class="feature-list">
                            <div class="feature-item">
                                <div class="feature-dot"></div>
                                <span><strong>Document Signature Hash</strong> — SHA-256 dari file + metadata</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-dot"></div>
                                <span><strong>File Content Hash</strong> — SHA-256 dari isi file saja</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-dot"></div>
                                <span><strong>File Checksum</strong> — MD5 untuk quick verification</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-dot"></div>
                                <span><strong>QR Code</strong> — Terenkripsi dengan data kepemilikan</span>
                            </div>
                            <div class="feature-item">
                                <div class="feature-dot"></div>
                                <span><strong>Audit Trail</strong> — Tracking setiap verifikasi</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>

    </html>
