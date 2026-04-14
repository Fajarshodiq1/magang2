<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Dokumen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F0F2F5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 16px 16px 40px;
            color: #1A1D23;
            -webkit-font-smoothing: antialiased;
        }

        .mono {
            font-family: 'JetBrains Mono', monospace;
        }

        /* ── Layout wrapper ── */
        .wrapper {
            width: 100%;
            max-width: 440px;
        }

        /* ── Instansi banner ── */
        .banner {
            background: #0F5C35;
            border-radius: 16px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            margin-top: 8px;
        }

        .banner-icon {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .banner-title {
            font-size: 11px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            line-height: 1.3;
        }

        .banner-sub {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 2px;
            line-height: 1.4;
        }

        .banner-sub span {
            color: #fff;
            font-weight: 600;
        }

        /* ── Main card ── */
        .card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        /* ── Status strip ── */
        .status-strip {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .status-strip.verified {
            background: #F0FBF4;
            border-bottom: 1px solid #C6EDD5;
        }

        .status-strip.invalid {
            background: #FEF2F2;
            border-bottom: 1px solid #FECACA;
        }

        .status-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .status-icon.verified {
            background: #16A34A;
        }

        .status-icon.invalid {
            background: #DC2626;
        }

        .status-icon svg {
            width: 20px;
            height: 20px;
            color: #fff;
        }

        .status-label {
            font-size: 15px;
            font-weight: 700;
        }

        .status-label.verified {
            color: #15803D;
        }

        .status-label.invalid {
            color: #B91C1C;
        }

        .status-sub {
            font-size: 12px;
            color: #6B7280;
            margin-top: 2px;
        }

        /* ── Body padding ── */
        .body {
            padding: 20px 20px 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* ── Section label ── */
        .section-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #9CA3AF;
            margin-bottom: 10px;
        }

        /* ── Info grid ── */
        .info-card {
            background: #F8F9FB;
            border-radius: 14px;
            padding: 14px 16px;
        }

        .info-row {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .info-row+.info-row {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #EAEDF1;
        }

        .info-key {
            font-size: 11px;
            color: #9CA3AF;
            font-weight: 500;
        }

        .info-val {
            font-size: 13px;
            font-weight: 600;
            color: #1A1D23;
        }

        .info-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .info-grid-2 .info-card {
            padding: 12px 14px;
        }

        /* ── Security level chip ── */
        .sec-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            border: 1px solid;
        }

        .sec-chip.normal {
            background: #F3F4F6;
            border-color: #D1D5DB;
            color: #374151;
        }

        .sec-chip.rahasia {
            background: #FFF7ED;
            border-color: #FED7AA;
            color: #C2410C;
        }

        .sec-chip.sangat_rahasia {
            background: #FEF2F2;
            border-color: #FECACA;
            color: #B91C1C;
        }

        /* ── Hash blocks ── */
        .hash-block {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #E5E7EB;
        }

        .hash-header {
            background: #1F2937;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hash-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 8px;
            flex-shrink: 0;
        }

        .hash-header-left {
            display: flex;
            align-items: center;
        }

        .hash-header-title {
            font-size: 11px;
            font-weight: 600;
            color: #D1D5DB;
        }

        .hash-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 9px;
            border-radius: 100px;
            letter-spacing: 0.04em;
        }

        .hash-badge.valid {
            background: #064E3B;
            color: #6EE7B7;
        }

        .hash-badge.invalid {
            background: #7F1D1D;
            color: #FCA5A5;
        }

        .hash-badge.info {
            background: #1E3A5F;
            color: #93C5FD;
        }

        .hash-badge.warn {
            background: #431407;
            color: #FDBA74;
        }

        .hash-body {
            background: #111827;
            padding: 12px 14px;
        }

        .hash-value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            color: #A7F3D0;
            word-break: break-all;
            line-height: 1.6;
        }

        .hash-value.purple {
            color: #C4B5FD;
        }

        .hash-hint {
            font-size: 11px;
            color: #6B7280;
            margin-top: 6px;
            line-height: 1.5;
        }

        .hash-hint code {
            background: #1F2937;
            color: #9CA3AF;
            padding: 1px 5px;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
        }

        .hash-hint span {
            color: #9CA3AF;
        }

        /* ── Why two hashes explanation ── */
        .explain-box {
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            border-radius: 10px;
            padding: 12px 14px;
        }

        .explain-title {
            font-size: 11px;
            font-weight: 700;
            color: #1D4ED8;
            margin-bottom: 4px;
        }

        .explain-text {
            font-size: 11px;
            color: #3B82F6;
            line-height: 1.6;
        }

        /* ── Download cards ── */
        .dl-card {
            border-radius: 14px;
            border: 1px solid;
            padding: 14px 16px;
        }

        .dl-card.qr-embed {
            background: #FAF5FF;
            border-color: #DDD6FE;
        }

        .dl-card.original {
            background: #F0FDF4;
            border-color: #BBF7D0;
        }

        .dl-card.locked {
            background: #FEF2F2;
            border-color: #FECACA;
        }

        .dl-card-head {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
        }

        .dl-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dl-icon.purple {
            background: #EDE9FE;
        }

        .dl-icon.green {
            background: #DCFCE7;
        }

        .dl-icon.red-ic {
            background: #FEE2E2;
        }

        .dl-icon svg {
            width: 18px;
            height: 18px;
        }

        .dl-icon.purple svg {
            color: #7C3AED;
        }

        .dl-icon.green svg {
            color: #16A34A;
        }

        .dl-icon.red-ic svg {
            color: #DC2626;
        }

        .dl-title {
            font-size: 13px;
            font-weight: 700;
            color: #1A1D23;
        }

        .dl-sub {
            font-size: 11px;
            color: #6B7280;
            margin-top: 2px;
            line-height: 1.4;
        }

        .dl-hash {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            margin-top: 5px;
            word-break: break-all;
        }

        .dl-hash.purple {
            color: #7C3AED;
        }

        .dl-hash.green {
            color: #15803D;
        }

        .dl-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 11px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: filter 0.15s;
        }

        .dl-btn:hover {
            filter: brightness(0.93);
        }

        .dl-btn svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .dl-btn-sub {
            font-size: 11px;
            font-weight: 400;
            opacity: 0.75;
        }

        .dl-btn.purple {
            background: #7C3AED;
            color: #fff;
        }

        .dl-btn.green {
            background: #16A34A;
            color: #fff;
        }

        /* ── Footer ── */
        .footer {
            text-align: center;
            font-size: 11px;
            color: #9CA3AF;
            padding-top: 4px;
            line-height: 1.8;
        }

        .footer-brand {
            color: #15803D;
            font-weight: 600;
        }

        /* ── Error state ── */
        .error-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px 24px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        .error-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .error-title {
            font-size: 18px;
            font-weight: 700;
            color: #B91C1C;
            margin-bottom: 8px;
        }

        .error-text {
            font-size: 13px;
            color: #6B7280;
            line-height: 1.6;
        }
    </style>
</head>

<body>

    <div class="wrapper">

        {{-- ── Instansi Banner ── --}}
        <div class="banner">
            <div class="banner-icon">
                <svg width="18" height="18" fill="white" viewBox="0 0 24 24">
                    <path
                        d="M12 2L2 7h2v13h16V7h2L12 2zm0 2.18L19 7H5l7-2.82zM6 9h2v9H6V9zm4 0h2v9h-2V9zm4 0h2v9h-2V9z" />
                </svg>
            </div>
            <div>
                <div class="banner-title">Kementerian Agama Republik Indonesia</div>
                <div class="banner-sub">
                    Dokumen ini telah <span>dialihmediakan</span> oleh
                    <span>Biro Umum Setjen Kementerian Agama</span>.
                </div>
            </div>
        </div>

        @if (!$valid || !$document)

            {{-- ── Invalid State ── --}}
            <div class="error-card">
                <div class="error-icon">⚠️</div>
                <div class="error-title">Dokumen Tidak Valid</div>
                <div class="error-text">{{ $message ?? 'QR Code tidak valid atau dokumen telah dimodifikasi.' }}</div>
            </div>
        @else
            @php
                $isPubliclyDownloadable = !$document->is_confidential || $document->security_level === 'normal';
                $hasEmbedded = $document->hasEmbeddedQR() && $document->embedded_document_hash;
                $embeddedValid = $verification['embedded_hash_valid'] ?? null;
                $secLevel = $document->security_level ?? 'normal';
                $levelMap = [
                    'normal' => ['label' => 'Normal', 'class' => 'normal'],
                    'rahasia' => ['label' => 'Rahasia', 'class' => 'rahasia'],
                    'sangat_rahasia' => ['label' => 'Sangat Rahasia', 'class' => 'sangat_rahasia'],
                ];
                $level = $levelMap[$secLevel] ?? $levelMap['normal'];
            @endphp

            <div class="card">

                {{-- ── Status Strip ── --}}
                <div class="status-strip {{ $valid ? 'verified' : 'invalid' }}">
                    <div class="status-icon {{ $valid ? 'verified' : 'invalid' }}">
                        @if ($valid)
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @endif
                    </div>
                    <div>
                        <div class="status-label {{ $valid ? 'verified' : 'invalid' }}">
                            {{ $valid ? 'Dokumen Terverifikasi' : 'Integritas Bermasalah' }}
                        </div>
                        <div class="status-sub">
                            {{ $valid ? 'Dokumen asli dan tidak ada perubahan terdeteksi.' : 'File mungkin telah dimodifikasi sejak terakhir disimpan.' }}
                        </div>
                    </div>
                </div>

                <div class="body">

                    {{-- ── Info Dokumen ── --}}
                    <div>
                        <div class="section-label">Informasi Dokumen</div>
                        <div class="info-card">
                            <div class="info-row">
                                <div class="info-key">Judul Dokumen</div>
                                <div class="info-val">{{ $document->title }}</div>
                            </div>
                            @if ($document->archiveClassification)
                                <div class="info-row">
                                    <div class="info-key">Kode Klasifikasi</div>
                                    <div class="info-val">{{ $document->archiveClassification->code }} —
                                        {{ $document->archiveClassification->name }}</div>
                                </div>
                            @endif
                        </div>

                        <div class="info-grid-2" style="margin-top:10px">
                            <div class="info-card">
                                <div class="info-key">Pemilik</div>
                                <div class="info-val" style="margin-top:3px">{{ $document->user->name }}</div>
                            </div>
                            <div class="info-card">
                                <div class="info-key">Tahun</div>
                                <div class="info-val" style="margin-top:3px">{{ $document->tahun }}</div>
                            </div>
                            <div class="info-card">
                                <div class="info-key">Jenis Arsip</div>
                                <div class="info-val" style="margin-top:3px">{{ $document->jenis_arsip }}</div>
                            </div>
                            <div class="info-card">
                                <div class="info-key">Tipe File</div>
                                <div class="info-val" style="margin-top:3px;text-transform:uppercase">
                                    {{ $document->file_type }}</div>
                            </div>
                        </div>

                        @if ($document->is_confidential)
                            <div style="margin-top:10px">
                                <span class="sec-chip {{ $level['class'] }}">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $level['label'] }}
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- ── Hash Verification ── --}}
                    @if ($document->document_hash)
                        <div>
                            <div class="section-label">Verifikasi Hash</div>
                            <div style="display:flex; flex-direction:column; gap:8px">

                                {{-- Hash Original --}}
                                <div class="hash-block">
                                    <div class="hash-header">
                                        <div class="hash-header-left">
                                            <div class="hash-dot" style="background:#34D399"></div>
                                            <span class="hash-header-title">Hash File Original (MD5)</span>
                                        </div>
                                        @if ($verification['document_hash_valid'] ?? false)
                                            <span class="hash-badge valid">✓ Valid</span>
                                        @else
                                            <span class="hash-badge invalid">✗ Berubah</span>
                                        @endif
                                    </div>
                                    <div class="hash-body">
                                        <div class="hash-value">{{ $document->document_hash }}</div>
                                        <div class="hash-hint">
                                            Verifikasi mandiri: <code>md5sum {{ $document->file_name }}</code>
                                        </div>
                                    </div>
                                </div>

                                {{-- Hash Embedded (jika ada) --}}
                                @if ($document->embedded_document_hash)
                                    <div class="hash-block">
                                        <div class="hash-header">
                                            <div class="hash-header-left">
                                                <div class="hash-dot" style="background:#A78BFA"></div>
                                                <span class="hash-header-title">Hash File + QR Embed (MD5)</span>
                                            </div>
                                            @if ($embeddedValid === null)
                                                <span class="hash-badge info">Info</span>
                                            @elseif ($embeddedValid)
                                                <span class="hash-badge valid">✓ Utuh</span>
                                            @else
                                                <span class="hash-badge warn">! Berubah</span>
                                            @endif
                                        </div>
                                        <div class="hash-body">
                                            <div class="hash-value purple">{{ $document->embedded_document_hash }}
                                            </div>
                                            <div class="hash-hint">
                                                Hash ini <span>berbeda dari original</span> — wajar karena konten file
                                                berubah setelah QR disisipkan.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="explain-box">
                                        <div class="explain-title">Mengapa dua hash berbeda?</div>
                                        <div class="explain-text">
                                            Hash original adalah sidik jari dokumen asli. Hash embed adalah sidik jari
                                            dokumen setelah QR Code disisipkan ke dalamnya. Keduanya valid dan tersimpan
                                            di sistem untuk dua tujuan verifikasi yang berbeda.
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endif

                    {{-- ── Download Section ── --}}
                    <div>
                        <div class="section-label">Unduh Dokumen</div>

                        @if ($isPubliclyDownloadable)
                            <div style="display:flex; flex-direction:column; gap:10px">

                                {{-- Tombol dengan QR embed (prioritas) --}}
                                @if ($hasEmbedded)
                                    <div class="dl-card qr-embed">
                                        <div class="dl-card-head">
                                            <div class="dl-icon purple">
                                                <svg fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z"
                                                        clip-rule="evenodd" />
                                                    <path
                                                        d="M11 4a1 1 0 10-2 0v1a1 1 0 002 0V4zM10 7a1 1 0 011 1v1h2a1 1 0 110 2h-3a1 1 0 01-1-1V8a1 1 0 011-1zM16 9a1 1 0 100 2 1 1 0 000-2zM9 13a1 1 0 011-1h1a1 1 0 110 2v2a1 1 0 11-2 0v-3zM7 11a1 1 0 100-2H4a1 1 0 100 2h3zM17 13a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1zM16 17a1 1 0 100-2h-3a1 1 0 100 2h3z" />
                                                </svg>
                                            </div>
                                            <div style="flex:1;min-width:0">
                                                <div class="dl-title">Unduh dengan QR Code</div>
                                                <div class="dl-sub">File sudah disematkan QR Code dan cap verifikasi
                                                    resmi.</div>
                                                <div class="dl-hash purple">MD5:
                                                    {{ $document->embedded_document_hash }}</div>
                                            </div>
                                        </div>
                                        <a href="{{ route('documents.public.download-embedded', ['id' => $document->id, 'token' => request('token')]) }}"
                                            class="dl-btn purple">
                                            <svg fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Unduh Dokumen Terverifikasi
                                            <span class="dl-btn-sub">(PDF + QR)</span>
                                        </a>
                                    </div>
                                @endif

                                {{-- Tombol file original --}}
                                <div class="dl-card original">
                                    <div class="dl-card-head">
                                        <div class="dl-icon green">
                                            <svg fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div style="flex:1;min-width:0">
                                            <div class="dl-title">Unduh File Original</div>
                                            <div class="dl-sub">File asli yang diarsipkan tanpa tambahan QR Code.</div>
                                            <div class="dl-hash green">MD5: {{ $document->document_hash }}</div>
                                        </div>
                                    </div>
                                    <a href="{{ route('documents.public.download', ['id' => $document->id, 'token' => request('token')]) }}"
                                        class="dl-btn green">
                                        <svg fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Unduh File Original
                                        <span class="dl-btn-sub">({{ strtoupper($document->file_type) }},
                                            {{ $document->formatted_file_size }})</span>
                                    </a>
                                </div>

                            </div>
                        @else
                            {{-- Dokumen rahasia --}}
                            <div class="dl-card locked">
                                <div class="dl-card-head" style="margin-bottom:0">
                                    <div class="dl-icon red-ic">
                                        <svg fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="dl-title" style="color:#B91C1C">Dokumen Terbatas</div>
                                        <div class="dl-sub" style="color:#EF4444">Dokumen ini bersifat rahasia dan
                                            tidak tersedia untuk diunduh secara publik. Hubungi pemilik dokumen untuk
                                            mendapatkan akses.</div>
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>

                    {{-- ── Footer ── --}}
                    <div class="footer">
                        <div>Dipindai pada: {{ $scanned_at->format('d F Y, H:i') }} WIB</div>
                        <div>Document Management System</div>
                        <div class="footer-brand">Biro Umum Setjen Kementerian Agama RI</div>
                    </div>

                </div>{{-- end .body --}}
            </div>{{-- end .card --}}

        @endif

    </div>{{-- end .wrapper --}}

</body>

</html>
