<div class="min-h-screen transition-colors duration-200" style="font-family: 'DM Sans', sans-serif;">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=DM+Mono:wght@400;500&display=swap');

        :root {
            --bg: #F5F4F0;
            --surface: #FFFFFF;
            --surface-2: #F9F8F5;
            --border: #E8E6DF;
            --text-primary: #1A1916;
            --text-secondary: #6B6860;
            --text-muted: #A8A59F;
            --green: #1A7A4A;
            --green-bg: #EAF5EF;
            --green-border: #B8DFC9;
            --yellow: #9A6E00;
            --yellow-bg: #FEF8E8;
            --yellow-border: #F0D98A;
            --red: #B83232;
            --red-bg: #FDEAEA;
            --red-border: #F0B8B8;
            --blue: #1A5FA8;
            --blue-bg: #EAF0FA;
            --blue-border: #B8CEF0;
            --purple: #5A2DA8;
            --purple-bg: #F0EAFA;
            --purple-border: #CCB8F0;
            --orange: #B85000;
            --orange-bg: #FEF0E8;
            --orange-border: #F0C8A0;
        }

        * {
            box-sizing: border-box;
        }

        /* Page Header */
        .doc-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .doc-header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .doc-icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: var(--green);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .doc-count {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.1;
        }

        .doc-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* Bulk Action Bar */
        .bulk-bar {
            background: var(--green-bg);
            border: 1.5px solid var(--green-border);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .bulk-bar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bulk-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--green);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }
        }

        .bulk-count {
            font-size: 13px;
            font-weight: 600;
            color: var(--green);
        }

        .bulk-bar-right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* Card / Table Wrapper */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        /* Table Toolbar */
        .table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            background: var(--surface-2);
            flex-wrap: wrap;
            gap: 10px;
        }

        .toolbar-left,
        .toolbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .toolbar-label {
            font-size: 12px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .toolbar-label strong {
            color: var(--text-primary);
        }

        /* Select / Input */
        .select-sm {
            height: 34px;
            padding: 0 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--surface);
            color: var(--text-primary);
            font-size: 12px;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23A8A59F' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 28px;
            cursor: pointer;
            outline: none;
        }

        .select-sm:focus {
            border-color: var(--green);
        }

        .checkbox-custom {
            width: 16px;
            height: 16px;
            accent-color: var(--green);
            cursor: pointer;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: var(--surface-2);
            border-bottom: 1px solid var(--border);
        }

        th {
            padding: 10px 16px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            white-space: nowrap;
        }

        th.center {
            text-align: center;
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.1s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: var(--surface-2);
        }

        tbody tr.selected-row {
            background: var(--green-bg);
        }

        td {
            padding: 14px 16px;
            vertical-align: middle;
        }

        td.center {
            text-align: center;
        }

        /* Sort Button */
        .sort-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 10px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 0;
            transition: color 0.15s;
        }

        .sort-btn:hover,
        .sort-btn.active {
            color: var(--green);
        }

        /* Avatar */
        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
            color: white;
            background: linear-gradient(135deg, #4F46E5, #7C3AED);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Doc name */
        .doc-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
            display: block;
        }

        .doc-meta {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 2px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .doc-meta .mono {
            font-family: 'DM Mono', monospace;
        }

        /* Tags */
        .tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .tag.green {
            background: var(--green-bg);
            color: var(--green);
        }

        .tag.yellow {
            background: var(--yellow-bg);
            color: var(--yellow);
        }

        .tag.red {
            background: var(--red-bg);
            color: var(--red);
        }

        .tag.blue {
            background: var(--blue-bg);
            color: var(--blue);
        }

        .tag.purple {
            background: var(--purple-bg);
            color: var(--purple);
        }

        .tag.orange {
            background: var(--orange-bg);
            color: var(--orange);
        }

        .tag.gray {
            background: var(--surface-2);
            color: var(--text-muted);
            border: 1px solid var(--border);
        }

        /* Archive info */
        .archive-label {
            font-size: 10px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            min-width: 60px;
        }

        .archive-val {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .archive-row {
            display: flex;
            align-items: flex-start;
            gap: 6px;
            margin-bottom: 4px;
        }

        .archive-row:last-child {
            margin-bottom: 0;
        }

        /* Security column */
        .security-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .verify-link {
            font-size: 11px;
            font-weight: 600;
            color: var(--blue);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: color 0.15s;
        }

        .verify-link:hover {
            color: var(--purple);
        }

        /* Date */
        .date-main {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .date-time {
            font-size: 11px;
            color: var(--text-muted);
            font-family: 'DM Mono', monospace;
            margin-top: 2px;
        }

        /* Actions dropdown */
        .action-wrap {
            position: relative;
            display: inline-block;
        }

        .action-btn-trigger {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.15s;
            font-family: 'DM Sans', sans-serif;
        }

        .action-btn-trigger:hover {
            background: var(--border);
        }

        .action-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 6px);
            z-index: 50;
            width: 200px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
            overflow: hidden;
        }

        .action-group {
            padding: 4px;
            border-bottom: 1px solid var(--border);
        }

        .action-group:last-child {
            border-bottom: none;
        }

        .action-item {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 8px 10px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.12s;
            font-family: 'DM Sans', sans-serif;
        }

        .action-item:hover {
            background: var(--surface-2);
            color: var(--text-primary);
        }

        .action-item.danger {
            color: var(--red);
        }

        .action-item.danger:hover {
            background: var(--red-bg);
        }

        .action-item-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 13px;
        }

        .ai-blue {
            background: var(--blue-bg);
            color: var(--blue);
        }

        .ai-yellow {
            background: var(--yellow-bg);
            color: var(--yellow);
        }

        .ai-indigo {
            background: #EEF0FF;
            color: #3730A3;
        }

        .ai-green {
            background: var(--green-bg);
            color: var(--green);
        }

        .ai-purple {
            background: var(--purple-bg);
            color: var(--purple);
        }

        .ai-red {
            background: var(--red-bg);
            color: var(--red);
        }

        /* Empty State */
        .empty-state {
            padding: 60px 24px;
            text-align: center;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 24px;
            color: var(--text-muted);
        }

        .empty-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .empty-desc {
            font-size: 13px;
            color: var(--text-muted);
            max-width: 320px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Pagination bar */
        .pagination-bar {
            padding: 12px 20px;
            border-top: 1px solid var(--border);
            background: var(--surface-2);
        }

        /* Utility buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.15s;
            text-decoration: none;
        }

        .btn-solid-green {
            background: var(--green);
            color: white;
        }

        .btn-solid-green:hover {
            background: #155f3a;
        }

        .btn-ghost {
            background: var(--surface);
            border: 1px solid var(--border);
            color: var(--text-secondary);
        }

        .btn-ghost:hover {
            background: var(--surface-2);
            color: var(--text-primary);
        }

        .btn-danger-ghost {
            background: transparent;
            border: 1px solid var(--red-border);
            color: var(--red);
        }

        .btn-danger-ghost:hover {
            background: var(--red-bg);
        }
    </style>

    <!-- Header -->
    <div class="doc-header">
        <div class="doc-header-left">
            <div class="doc-icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" style="width:22px;height:22px;color:white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z" />
                </svg>
            </div>
            <div>
                <div class="doc-count">{{ $documents->total() }} Dokumen</div>
                <div class="doc-subtitle">Kelola dan organisir arsip dokumen Anda</div>
            </div>
        </div>

        @include('livewire.documents.partials.menu')
    </div>

    <!-- Filter -->
    @include('livewire.documents.partials.filter-dropdown')

    <!-- Bulk Action Bar -->
    @if (count($selectedDocuments) > 0)
        <div class="bulk-bar">
            <div class="bulk-bar-left">
                <div class="bulk-dot"></div>
                <span class="bulk-count">{{ count($selectedDocuments) }} dokumen dipilih</span>
                <button wire:click="$set('selectedDocuments', []); $set('selectAll', false)" class="btn btn-ghost"
                    style="padding: 5px 10px; font-size:11px">
                    Batal
                </button>
            </div>
            <div class="bulk-bar-right">
                <select wire:model="bulkAction" class="select-sm">
                    <option value="">Pilih Aksi</option>
                    <option value="delete">Hapus Terpilih</option>
                    <option value="export">Export Terpilih</option>
                </select>
                <button wire:click="executeBulkAction" class="btn btn-solid-green">
                    Jalankan
                </button>
            </div>
        </div>
    @endif

    <!-- Table Card -->
    <div class="table-card">

        <!-- Toolbar -->
        <div class="table-toolbar">
            <div class="toolbar-left">
                <label style="display:flex; align-items:center; gap:7px; cursor:pointer">
                    <input type="checkbox" wire:model.live="selectAll" class="checkbox-custom">
                    <span class="toolbar-label">Pilih Semua</span>
                </label>

                @if (count($selectedDocuments) > 0)
                    <div style="width:1px; height:16px; background:var(--border)"></div>
                    <span class="toolbar-label">
                        <strong style="color:var(--green)">{{ count($selectedDocuments) }}</strong> dipilih
                    </span>
                @endif
            </div>

            <div class="toolbar-right">
                <span class="toolbar-label">
                    <strong>{{ $documents->firstItem() ?? 0 }}</strong>–<strong>{{ $documents->lastItem() ?? 0 }}</strong>
                    dari <strong>{{ $documents->total() }}</strong>
                </span>
                <select wire:model.live="perPage" class="select-sm">
                    <option value="10">10 / hal</option>
                    <option value="25">25 / hal</option>
                    <option value="50">50 / hal</option>
                    <option value="100">100 / hal</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th style="width:44px; padding-left:20px;">
                            <input type="checkbox" wire:model.live="selectAll" class="checkbox-custom">
                        </th>
                        <th style="min-width:260px">
                            <button wire:click="sortBy('title')"
                                class="sort-btn {{ $sortField === 'title' ? 'active' : '' }}">
                                Dokumen
                                @if ($sortField === 'title')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                        <path
                                            d="{{ $sortDirection === 'asc' ? 'M4.5 15.75l7.5-7.5 7.5 7.5' : 'M19.5 8.25l-7.5 7.5-7.5-7.5' }}" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        style="opacity:0.3">
                                        <path d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                @endif
                            </button>
                        </th>
                        <th style="min-width:180px">Informasi Arsip</th>
                        <th class="center">Tipe</th>
                        <th class="center" style="min-width:130px">Security</th>
                        <th>
                            <button wire:click="sortBy('created_at')"
                                class="sort-btn {{ $sortField === 'created_at' ? 'active' : '' }}">
                                Tanggal
                                @if ($sortField === 'created_at')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                        <path
                                            d="{{ $sortDirection === 'asc' ? 'M4.5 15.75l7.5-7.5 7.5 7.5' : 'M19.5 8.25l-7.5 7.5-7.5-7.5' }}" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        style="opacity:0.3">
                                        <path d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                @endif
                            </button>
                        </th>
                        <th class="center" style="min-width:100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $document)
                        <tr class="{{ in_array($document->id, $selectedDocuments) ? 'selected-row' : '' }}">
                            <!-- Checkbox -->
                            <td style="padding-left:20px">
                                <input type="checkbox" wire:model.live="selectedDocuments"
                                    value="{{ $document->id }}" class="checkbox-custom">
                            </td>

                            <!-- Document -->
                            <td>
                                <div style="display:flex; align-items:center; gap:10px">
                                    <div class="avatar">
                                        @if ($document->user->profile_photo && Storage::exists($document->user->profile_photo))
                                            <img src="{{ Storage::url($document->user->profile_photo) }}"
                                                alt="{{ $document->user->name }}">
                                        @else
                                            {{ strtoupper(substr($document->user->name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div style="min-width:0">
                                        <div style="display:flex; align-items:center; gap:6px; flex-wrap:wrap;">
                                            <span class="doc-name" title="{{ $document->title }}">
                                                {{ $document->title }}
                                            </span>
                                            @if ($document->category)
                                                <span class="tag purple">{{ $document->category->name }}</span>
                                            @endif
                                        </div>
                                        <div class="doc-meta">
                                            <span>{{ $document->user->name }}</span>
                                            <span style="color:var(--border)">·</span>
                                            <span class="mono">{{ $document->formatted_file_size }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Archive Info -->
                            <td>
                                @if ($document->archiveClassification)
                                    <div class="archive-row">
                                        <span class="archive-label">Kode</span>
                                        <div style="display:flex;flex-direction:column;gap:2px">
                                            <span class="tag blue">{{ $document->archiveClassification->code }}</span>
                                            <span class="archive-val" style="font-size:11px">
                                                {{ Str::limit($document->archiveClassification->name, 28) }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="archive-row">
                                        <span class="archive-label">Kode</span>
                                        <span class="archive-val">{{ $document->kode_arsip ?? '—' }}</span>
                                    </div>
                                @endif
                                <div class="archive-row">
                                    <span class="archive-label">Jenis</span>
                                    <span class="archive-val">{{ $document->jenis_arsip }}</span>
                                </div>
                                <div class="archive-row">
                                    <span class="archive-label">No. Def</span>
                                    <span class="archive-val"
                                        style="font-family:'DM Mono',monospace;font-size:11px">{{ $document->no_definitif }}</span>
                                </div>
                            </td>

                            <!-- File Type -->
                            <td class="center">
                                <span
                                    class="tag {{ $document->file_type === 'pdf' ? 'red' : ($document->file_type === 'doc' || $document->file_type === 'docx' ? 'blue' : 'gray') }}">
                                    @if ($document->file_type === 'pdf')
                                        <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                        </svg>
                                    @else
                                        <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                    {{ strtoupper($document->file_type) }}
                                </span>
                            </td>

                            <!-- Security -->
                            <td class="center">
                                <div class="security-col">
                                    @if ($document->is_confidential)
                                        {{-- Level badge --}}
                                        @if ($document->security_level === 'sangat_rahasia')
                                            <span class="tag red">
                                                <svg width="9" height="9" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Sgt Rahasia
                                            </span>
                                        @elseif($document->security_level === 'rahasia')
                                            <span class="tag orange">
                                                <svg width="9" height="9" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Rahasia
                                            </span>
                                        @else
                                            <span class="tag gray">Normal</span>
                                        @endif

                                        {{-- Status badge --}}
                                        <span
                                            class="tag {{ $document->security_status === 'secured' ? 'green' : ($document->security_status === 'partial' ? 'yellow' : 'gray') }}">
                                            {{ $document->security_status === 'secured' ? 'Secured' : ($document->security_status === 'partial' ? 'Partial' : 'Basic') }}
                                        </span>

                                        {{-- Verify link --}}
                                        <a href="{{ route('documents.verify', $document->id) }}" class="verify-link">
                                            <svg width="11" height="11" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Verify
                                        </a>

                                        @if ($document->document_hash)
                                            <button
                                                onclick="showHashModal('{{ $document->id }}', '{{ $document->title }}', '{{ $document->document_hash }}', '{{ $document->file_checksum }}')"
                                                class="verify-link"
                                                style="background:none; border:none; cursor:pointer; font-family:'DM Sans',sans-serif;">
                                                <svg width="11" height="11" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Hash
                                            </button>
                                        @endif
                                    @else
                                        <span class="tag gray">Normal</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Date -->
                            <td>
                                <div class="date-main">{{ $document->created_at->format('d M Y') }}</div>
                                <div class="date-time">{{ $document->created_at->format('H:i') }} WIB</div>
                            </td>

                            <!-- Actions -->
                            <td class="center">
                                <div class="action-wrap" x-data="{ open: false }">
                                    <button @click="open = !open" @click.outside="open = false"
                                        class="action-btn-trigger">
                                        Aksi
                                        <svg width="12" height="12" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95" class="action-dropdown"
                                        style="display:none">

                                        <!-- Primary -->
                                        <div class="action-group">
                                            <button wire:click="preview({{ $document->id }})" @click="open = false"
                                                class="action-item">
                                                <div class="action-item-icon ai-blue">
                                                    <svg width="13" height="13" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </div>
                                                Preview
                                            </button>

                                            <a href="/documents/{{ $document->id }}/edit" wire:navigate
                                                class="action-item">
                                                <div class="action-item-icon ai-yellow">
                                                    <svg width="13" height="13" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </div>
                                                Edit
                                            </a>
                                        </div>

                                        @if ($document->is_confidential)
                                            <!-- Security -->
                                            <div class="action-group">
                                                <a href="{{ route('documents.verify', $document->id) }}" wire:navigate
                                                    class="action-item">
                                                    <div class="action-item-icon ai-indigo">
                                                        <svg width="13" height="13" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                        </svg>
                                                    </div>
                                                    Verify Security
                                                </a>

                                                @if ($document->qr_code_path)
                                                    <a href="{{ route('documents.qr.download', $document->id) }}"
                                                        class="action-item">
                                                        <div class="action-item-icon ai-green">
                                                            <svg width="13" height="13" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24"
                                                                stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                                            </svg>
                                                        </div>
                                                        Download QR
                                                    </a>
                                                @endif
                                            </div>
                                        @endif

                                        @if ($document->hasEmbeddedQR())
                                            <!-- Downloads -->
                                            <div class="action-group">
                                                <a href="{{ route('documents.download-embedded', $document) }}"
                                                    class="action-item">
                                                    <div class="action-item-icon ai-purple">
                                                        <svg width="13" height="13" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                        </svg>
                                                    </div>
                                                    Download + QR
                                                </a>
                                            </div>
                                        @endif

                                        <!-- Danger -->
                                        <div class="action-group">
                                            <button
                                                wire:click="$dispatch('delete-confirm', { id: {{ $document->id }} })"
                                                @click="open = false" class="action-item danger">
                                                <div class="action-item-icon ai-red">
                                                    <svg width="13" height="13" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </div>
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" style="width:28px;height:28px">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                                        </svg>
                                    </div>
                                    <div class="empty-title">Tidak ada dokumen ditemukan</div>
                                    <div class="empty-desc">
                                        Mulai dengan menambahkan dokumen baru atau ubah filter pencarian Anda
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($documents->hasPages())
            <div class="pagination-bar">
                {{ $documents->links('pagination::tailwind') }}
            </div>
        @endif
    </div>

    <!-- Modals -->
    @include('livewire.documents.partials.import-modal')
    @include('livewire.documents.partials.preview-modal')
    @include('livewire.documents.partials.hash-modal')

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('delete-confirm', (event) => {
                if (confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) {
                    Livewire.dispatch('delete-document', {
                        id: event.id
                    });
                }
            });
        });

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                const toast = document.createElement('div');
                toast.style.cssText =
                    'position:fixed;bottom:20px;right:20px;background:#1A7A4A;color:white;padding:10px 16px;border-radius:10px;font-size:13px;font-weight:600;font-family:"DM Sans",sans-serif;z-index:9999;display:flex;align-items:center;gap:8px;box-shadow:0 4px 16px rgba(0,0,0,0.15)';
                toast.innerHTML =
                    '<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Hash disalin!';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 2000);
            });
        }

        function showHashModal(id, title, documentHash, fileChecksum) {
            document.getElementById('hashModalTitle').textContent = title;
            document.getElementById('documentHash').textContent = documentHash;
            document.getElementById('fileChecksum').textContent = fileChecksum || 'N/A';
            document.getElementById('hashModal').classList.remove('hidden');
        }

        function closeHashModal() {
            document.getElementById('hashModal').classList.add('hidden');
        }

        function copyHash(elementId) {
            copyToClipboard(document.getElementById(elementId).textContent);
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeHashModal();
        });
    </script>
</div>
