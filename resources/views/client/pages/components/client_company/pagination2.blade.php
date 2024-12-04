<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
    <div class="pager_wrapper gc_blog_pagination">
        <ul class="pagination">
            <li class="{{ $companies->onFirstPage() ? 'disabled' : '' }}">
                <a class="pagination-link" href="{{ $companies->previousPageUrl() }}"><i
                        class="fa fa-chevron-left"></i></a>
            </li>

            @foreach ($companies->getUrlRange(1, $companies->lastPage()) as $page => $url)
                <li
                    class="{{ $page == $companies->currentPage() ? 'active' : '' }}">
                    <a class="pagination-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            <li class="{{ $companies->hasMorePages() ? '' : 'disabled' }}">
                <a class="pagination-link" href="{{ $companies->nextPageUrl() }}"><i
                        class="fa fa-chevron-right"></i></a>
            </li>
        </ul>
    </div>
</div>