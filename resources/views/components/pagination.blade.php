@if ($pagi->hasPages())
  <nav aria-label="pagination">
    @if (! $pagi->onFirstPage())
      <a
        href="{{ $pagi->previousPageUrl() }}"
        rel="prev"
        aria-label="Página anterior"
        class="button"
      >
        <span aria-hidden="true">
          <x-fas-chevron-left/>
        </span>
      </a>
    @endif

    <ul>
      @foreach ($pagi->elements() as $element)
        @if (is_string($element))
          <li class="disabled">
            <span class="mr-3 py-1">&hellip;</span>
          </li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            <li>
              @if ($page == $pagi->currentPage())
                <span
                  class="button current"
                  aria-current="page"
                >{{ $page }}</span>
              @else
                <a
                  href="{{ $url }}"
                  class="button"
                >{{ $page }}</a>
              @endif
            </li>
          @endforeach
        @endif
      @endforeach
    </ul>

    @if ($pagi->hasMorePages())
      <a
        href="{{ $pagi->nextPageUrl() }}"
        rel="next"
        aria-label="Página siguiente"
        class="button"
      >
        <span aria-hidden="true">
          <x-fas-chevron-right/>
        </span>
      </a>
    @endif
  </nav>
@endif
