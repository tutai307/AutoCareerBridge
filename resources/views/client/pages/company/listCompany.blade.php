@extends('client.layout.main')
@section('title', 'Danh sách doanh nghiệp')
@section('content')
    {{--    breacrumb --}}
    <div class="jp_tittle_main_wrapper">
        <div class="jp_tittle_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_tittle_heading_wrapper">
                        <div class="jp_tittle_heading">
                            <h2>{{ __('label.client.title.companies') }}</h2>
                        </div>
                        <div class="jp_tittle_breadcrumb_main_wrapper">
                            <div class="jp_tittle_breadcrumb_wrapper">
                                <ul>
                                    <li><a href="{{ route('home') }}">{{ __('label.breadcrumb.home') }}</a> <i
                                            class="fa fa-angle-right"></i></li>
                                    <li>{{ __('label.breadcrumb.company') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            <div class="row mt-5">

                @if ($listCompanies)
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jp_hiring_slider_main_wrapper">
                            <div class="jp_hiring_heading_wrapper">
                                <h2>Top doanh nghiệp</h2>
                            </div>
                            <div class="jp_hiring_slider_wrapper">
                                <div class="owl-carousel owl-theme">
                                    @foreach ($listCompanies as $company)
                                        <div class="item">
                                            <div class="jp_hiring_content_main_wrapper">
                                                <div class="jp_hiring_content_wrapper">
                                                    <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                        <img id="hiring_img" class="rounded-circle"
                                                            src="{{ isset($company->avatar_path) ? asset($company->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                            alt="hiring_img" />
                                                    </a>
                                                    <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                        <h4 data-bs-placement="top" data-bs-title="{{ $company->name }}" class="company_name">
                                                            {{ \Illuminate\Support\Str::limit($company->name, 22, '...') }}
                                                        </h4>
                                                    </a>
                                                    <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                        <label class="h5 mb-2 mt-2">
                                                            @if ($company->addresses->isEmpty())
                                                                Chưa cập nhật địa chỉ
                                                            @else
                                                                {{ $company->addresses->first()->province->name ?? '' }}
                                                            @endif
                                                        </label>
                                                    </a>
                                                    <ul class="d-flex justify-content-center">
                                                        <li>
                                                            <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}"
                                                                style="background-color: #23c0e9;">
                                                                <label class="h6" style="color: #fff">
                                                                    {{ $company->jobs_count }} việc làm
                                                                </label>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_hiring_slider_main_wrapper mt-3">
                        <div class="jp_hiring_heading_wrapper">
                            <h2>Tìm kiếm</h2>
                        </div>
                        <div class="jp_hiring_slider_wrapper d-flex justify-content-center">
                            <div class="ms-3">
                                <input type="text" placeholder="Tìm kiếm" name="search" id="name_search"
                                    value="{{ request()->query('search') }}">
                            </div>
                            <div class="ms-3">
                                <select class="form-select form-control-lg" id="province_id" name="province_id">
                                    <option value="">Tất cả tỉnh thành</option>
                                    @foreach ($provincies as $province)
                                        <option value="{{ $province->id }}"
                                            {{ request()->query('province_id') == $province->id ? 'selected' : '' }}>
                                            {{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="ms-3">
                                <button class="btn btn-primary" id="search">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_header_form_wrapper d-flex justify-content-end">

                                <div class="me-2">
                                    <div class="gc_causes_select_box">
                                        <select id="sortOrder" name="sort_order" onchange="this.form.submit()">
                                            <option value="">Mặc định (việc làm)</option>
                                            <option value="asc"
                                                {{ request()->query('sort_order') == 'asc' ? 'selected' : '' }}>
                                                Tăng dần
                                            </option>
                                            <option value="desc"
                                                {{ request()->query('sort_order') == 'desc' ? 'selected' : '' }}>
                                                Giảm dần
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="gc_causes_view_tabs">
                                        <ul class="nav nav-pills">
                                            <li class="active">
                                                <a data-toggle="pill" href="#grid" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Xem dạng lưới" id="grid-view">
                                                    <i class="fa fa-th-large"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-toggle="pill" href="#list" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Xem dạng danh sách" id="list-view">
                                                    <i class="fa fa-list"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="tab-content">
                                <div id="grid" class="tab-pane fade in active">
                                    <div id="view1" class="row">
                                        @include('client.pages.components.client_company.view1', [
                                            'companies' => $companies,
                                        ])
                                    </div>

                                    @if ($companies->lastPage() > 1)
                                        <div id="pagination1">
                                            @include(
                                                'client.pages.components.client_company.pagination1',
                                                [
                                                    'companies' => $companies,
                                                ]
                                            )
                                        </div>
                                    @endif
                                </div>
                                <div id="list" class="tab-pane fade">
                                    <div id="view2" class="row">
                                        @include('client.pages.components.client_company.view2', [
                                            'companies' => $companies,
                                        ])
                                    </div>

                                    @if ($companies->lastPage() > 1)
                                        <div id="pagination2">
                                            @include(
                                                'client.pages.components.client_company.pagination2',
                                                [
                                                    'companies' => $companies,
                                                ]
                                            )
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('clients/css/custom.css') }}">
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#province_id').select2({
                allowClear: false,
                containerCssClass: "select2-height-fix",
                width: '300px'
            });
        });
    </script>
    <script>
        $(document).on('click', '#search', function(e) {
            let search = $('#name_search').val();
            let province_id = $('#province_id').val();
            let sort_order = $('#sortOrder').val();
            $.ajax({
                url: '{{ route('listCompany') }}',
                type: 'GET',
                data: {
                    search: search,
                    province_id: province_id,
                    sort_order: sort_order
                },
                success: function(response) {
                    $('#view1').html(response.view1);
                    $('#view2').html(response.view2);
                    $('#pagination1').html(response.pagination1);
                    $('#pagination2').html(response.pagination2);
                }
            })
        })

        $(document).on('change', '#sortOrder', function(e) {
            let search = $('#name_search').val();
            let province_id = $('#province_id').val();
            let sort_order = $('#sortOrder').val();
            $.ajax({
                url: '{{ route('listCompany') }}',
                type: 'GET',
                data: {
                    search: search,
                    province_id: province_id,
                    sort_order: sort_order
                },
                success: function(response) {
                    $('#view1').html(response.view1);
                    $('#view2').html(response.view2);
                    $('#pagination1').html(response.pagination1);
                    $('#pagination2').html(response.pagination2);
                }
            })
        })

        $(document).on('click', '.pagination-link', function(e) {
            e.preventDefault();

            let url = $(this).attr('href');
            let search = $('#name_search').val();
            let province_id = $('#province_id').val();
            let sort_order = $('#sortOrder').val();

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    search: search,
                    province_id: province_id,
                    sort_order: sort_order
                },
                success: function(response) {
                    $('#view1').html(response.view1);
                    $('#view2').html(response.view2);
                    $('#pagination1').html(response.pagination1);
                    $('#pagination2').html(response.pagination2);
                }
            });
        });

        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip()
            $('.company_name').tooltip({
                title: function() {
                    return $(this).attr('data-bs-title');
                }
            });
        });
    </script>
@endsection
