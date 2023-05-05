@if ($paginator->hasPages())
    <div class="col-xs-12 mt-4">
    	<div class="pagination">
	        {{-- Previous Page Link --}}
	        @if ($paginator->onFirstPage())
	            <a class="disabled" href="#">&laquo;</a>
	        @else
	        	<a href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
	        @endif

	        @if($paginator->currentPage() > 3)
	            <a href="{{ $paginator->url(1) }}">1</a>
	        @endif
	        @if($paginator->currentPage() > 4)
	            <a>....</a>
	        @endif

	        {{-- Pagination Elements --}}
	        @foreach (range(1, $paginator->lastPage()) as $i)
	            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
	                @if ($i == $paginator->currentPage())
	                    <a class="active">{{ $i }}</a>
	                @else
	                    <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
	                @endif
	            @endif
	        @endforeach

	        @if($paginator->currentPage() < $paginator->lastPage() - 3)
	            <a>....</a>
	        @endif
	        @if($paginator->currentPage() < $paginator->lastPage() - 2)
	            <a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
	        @endif

	        {{-- Next Page Link --}}
	        @if ($paginator->hasMorePages())
	            <a href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
	        @else
	            <a>&raquo;</a>
	        @endif
	    </div>
    </div>
@endif
