@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="py-4">

        {{-- Mobile Version --}}
        <div class="flex gap-3 items-center justify-center sm:hidden">

            @if ($paginator->onFirstPage())
                <span
                    class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed rounded-full dark:text-gray-500 dark:bg-gray-800 dark:border-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-blue-50 hover:border-blue-400 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:border-blue-500 dark:hover:text-blue-400 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-blue-50 hover:border-blue-400 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:border-blue-500 dark:hover:text-blue-400 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span
                    class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed rounded-full dark:text-gray-500 dark:bg-gray-800 dark:border-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif

        </div>

        {{-- Desktop Version --}}
        <div class="hidden sm:flex sm:flex-col sm:items-center sm:gap-4">

            {{-- Info Text --}}
            <div>
                <p class="text-sm text-gray-600 leading-5 dark:text-gray-400">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span
                            class="font-semibold text-gray-900 dark:text-gray-200">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-semibold text-gray-900 dark:text-gray-200">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-semibold text-gray-900 dark:text-gray-200">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            {{-- Pagination Buttons --}}
            <div class="flex items-center gap-2">

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                        class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed rounded-full dark:text-gray-500 dark:bg-gray-800 dark:border-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-blue-50 hover:border-blue-400 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:border-blue-500 dark:hover:text-blue-400 shadow-sm hover:shadow-md"
                        aria-label="{{ __('pagination.previous') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true"
                            class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page"
                                    class="inline-flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-gradient-to-br from-blue-500 to-blue-600 border-2 border-blue-500 rounded-full shadow-lg transform scale-110 dark:from-blue-600 dark:to-blue-700 dark:border-blue-600">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-blue-50 hover:border-blue-400 hover:text-blue-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:border-blue-500 dark:hover:text-blue-400 shadow-sm hover:shadow-md"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-blue-50 hover:border-blue-400 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:border-blue-500 dark:hover:text-blue-400 shadow-sm hover:shadow-md"
                        aria-label="{{ __('pagination.next') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                        class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed rounded-full dark:text-gray-500 dark:bg-gray-800 dark:border-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
