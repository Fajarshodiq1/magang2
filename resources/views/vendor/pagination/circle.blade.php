@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="circle-pagination">
        <ul class="pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled">
                    <span class="pagination-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </span>
                </li>
            @else
                <li class="pagination-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-circle" rel="prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-item disabled">
                        <span class="pagination-circle dots">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item active">
                                <span class="pagination-circle">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-item">
                                <a href="{{ $url }}" class="pagination-circle">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-circle" rel="next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </li>
            @else
                <li class="pagination-item disabled">
                    <span class="pagination-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                </li>
            @endif
        </ul>

        {{-- Page Info --}}
        <div class="pagination-info">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>
    </nav>

    <style>
        .circle-pagination {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0;
            font-family: system-ui, -apple-system, sans-serif;
        }

        .pagination-list {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-item {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .pagination-circle::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .pagination-circle:hover::before {
            opacity: 1;
        }

        .pagination-item:not(.disabled):not(.active) .pagination-circle {
            background: white;
            color: #667eea;
            border: 2px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .pagination-item:not(.disabled):not(.active) .pagination-circle:hover {
            border-color: #667eea;
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .pagination-item.active .pagination-circle {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: 2px solid transparent;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
            transform: scale(1.1);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
            }

            50% {
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.7);
            }
        }

        .pagination-item.disabled .pagination-circle {
            background: #f3f4f6;
            color: #9ca3af;
            border: 2px solid #e5e7eb;
            box-shadow: none;
            cursor: not-allowed;
            opacity: 0.5;
        }

        .pagination-circle.dots {
            background: transparent;
            color: #9ca3af;
            box-shadow: none;
            border: none;
            cursor: default;
        }

        .pagination-circle svg {
            width: 16px;
            height: 16px;
            stroke-width: 2.5px;
        }

        .pagination-info {
            font-size: 14px;
            color: #6b7280;
            text-align: center;
            font-weight: 500;
        }

        @media (max-width: 640px) {
            .pagination-circle {
                width: 40px;
                height: 40px;
                font-size: 13px;
            }

            .pagination-list {
                gap: 0.4rem;
            }
        }
    </style>
@endif
