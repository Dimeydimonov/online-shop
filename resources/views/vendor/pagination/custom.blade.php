@if ($paginator->hasPages())
    <nav class="custom-pagination">
        {{-- Кнопка "Назад" --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-disabled">❮</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link">❮</a>
        @endif

        {{-- Номера страниц --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pagination-disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Кнопка "Вперед" --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link">❯</a>
        @else
            <span class="pagination-disabled">❯</span>
        @endif
    </nav>
@endif
