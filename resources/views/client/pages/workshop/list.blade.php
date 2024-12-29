@extends('client.layout.main')
@section('title', 'Workshop')

@section('content')
@section('css')
@endsection

{{--    breacrumb --}}
<div class="jp_tittle_main_wrapper">
    <div class="jp_tittle_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="jp_tittle_heading_wrapper">
                    <div class="jp_tittle_heading">
                        <h2>Workshop</h2>
                    </div>
                    <div class="jp_tittle_breadcrumb_main_wrapper">
                        <div class="jp_tittle_breadcrumb_wrapper">
                            <ul>
                                <li><a href="{{ route('home') }}">Trang chủ</a> <i
                                        class="fa fa-angle-right"></i></li>
                                <li>Workshop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@isset($workShops)
    <div class="jp_career_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_hiring_slider_main_wrapper">
                        <div class="jp_career_slider_heading_wrapper">
                            <h2>Workshop</h2>
                        </div>
                        <div class="jp_career_slider_wrapper">
                            <div class="row">

                                @foreach ($workShops as $item)
                                    <div class="col-lg-4 mb-4">
                                        <div class="item jp_recent_main">
                                            <div class="jp_career_main_box_wrapper" style="height: 340px;">
                                                <div class="jp_career_img_wrapper">
                                                    <a href="{{ route('detailWorkShop', ['slug' => $item->slug]) }}">
                                                        <img style="width: 100%; height: 200px;"
                                                            src="{{ $item->avatar_path ? asset($item->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                            alt="{{ $item->name }}" />
                                                    </a>
                                                </div>
                                                <div class="jp_career_cont_wrapper">
                                                    <p><i class="fa fa-calendar"></i>&nbsp;&nbsp;
                                                        {{ $item->start_date }}</p>
                                                    <h3><a href="{{ route('detailWorkShop', ['slug' => $item->slug]) }}"
                                                            title="{{ $item->name }}"
                                                            data-to>{{ Str::limit($item->name, 25, '...') }}</a>
                                                    </h3>
                                                </div>
                                            </div>
                                            @if ($item->university)
                                                <div class="jp_career_slider_bottom_cont">
                                                    <ul>
                                                        <li>
                                                            <img style="width: 50px; height: 50px; max-width: 50px; max-height: 50px; border-radius: 50%; object-fit: cover;"
                                                                src="{{ $item->university->avatar_path ? asset('storage/' . $item->university->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                                alt="{{ $item->university->name }}"
                                                                class="img-circle">&nbsp;&nbsp;
                                                            <a
                                                                href="{{ route('detailUniversity', ['slug' => $item->university->slug]) }}">{{ Str::limit($item->university->name, 30, '...') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if ($workShops->lastPage() > 1)
                                <div class="pager_wrapper gc_blog_pagination">
                                    <ul class="pagination">
                                        <li class="{{ $workShops->onFirstPage() ? 'disabled' : '' }}">
                                            <a href="{{ $workShops->previousPageUrl() }}"><i
                                                    class="fa fa-chevron-left"></i></a>
                                        </li>
                                        @for ($i = max(1, $workShops->currentPage() - 2); $i <= min($workShops->currentPage() + 2, $workShops->lastPage()); $i++)
                                            <li class="{{ $i == $workShops->currentPage() ? 'active' : '' }}">
                                                <a href="{{ $workShops->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="{{ $workShops->hasMorePages() ? '' : 'disabled' }}">
                                            <a href="{{ $workShops->nextPageUrl() }}"><i
                                                    class="fa fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endisset

@endsection

@section('js')
@endsection
