@if ($paginator->hasPages())
    @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

    <nav class="pagination mt-7 flex flex-wrap justify-center gap-0.5 leading-none" aria-label="Навигация по страницам">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="disabled mr-3 flex items-center py-1 px-2 [&amp;.disabled]:pointer-events-none [&amp;.disabled]:opacity-50 cursor-pointer"
               aria-disabled="true" aria-label="Предыдущая страница">
                <svg viewBox="0 0 8 13" class="h-3 fill-current" aria-hidden="true">
                    <path d="M7.94 1.42 6.84.32.65 6.5l6.19 6.19 1.1-1.1L2.86 6.5l5.08-5.08Z"></path>
                </svg>
            </a>
        @else
            <a dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
               class="mr-3 flex items-center py-1 px-2 [&amp;.disabled]:pointer-events-none [&amp;.disabled]:opacity-50 cursor-pointer"
               wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev"
               aria-label="Предыдущая страница">
                <svg viewBox="0 0 8 13" class="h-3 fill-current" aria-hidden="true">
                    <path d="M7.94 1.42 6.84.32.65 6.5l6.19 6.19 1.1-1.1L2.86 6.5l5.08-5.08Z"></path>
                </svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="flex items-center py-1 px-2 [&amp;.active]:font-extrabold cursor-pointer"
                   aria-disabled="true">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @dd($paginator)
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active flex items-center py-1 px-2 [&amp;.active]:font-extrabold cursor-pointer"
                           wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                           aria-current="page">{{ $page }}</a>
                    @else
                        <a class="flex items-center py-1 px-2 [&amp;.active]:font-extrabold cursor-pointer"
                           wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                           wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
               class="ml-3 flex items-center py-1 px-2 [&amp;.disabled]:pointer-events-none [&amp;.disabled]:opacity-50 cursor-pointer"
               wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="next"
               aria-label="Следующая страница">
                <svg viewBox="0 0 8 13" class="h-3 fill-current" aria-hidden="true">
                    <path d="m.06 11.58 1.1 1.1L7.35 6.5 1.16.31l-1.1 1.1L5.14 6.5.06 11.58Z"></path>
                </svg>
            </a>
        @else
            <a class="disabled ml-3 flex items-center py-1 px-2 [&amp;.disabled]:pointer-events-none [&amp;.disabled]:opacity-50 cursor-pointer"
               aria-disabled="true" aria-label="Следующая страница">
                <svg viewBox="0 0 8 13" class="h-3 fill-current" aria-hidden="true">
                    <path d="m.06 11.58 1.1 1.1L7.35 6.5 1.16.31l-1.1 1.1L5.14 6.5.06 11.58Z"></path>
                </svg>
            </a>
        @endif
    </nav>
@endif
