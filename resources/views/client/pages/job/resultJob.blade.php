@extends('client.layout.main')
@section('title', 'Tìm kiếm '. $getJobs->count() . ' việc làm ' .  ucfirst(request()->key_search) )

@section('content')
    <div class="jp_img_wrapper">
        <div class="jp_slide_img_overlay"></div>
        <div class="jp_banner_heading_cont_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jp_job_heading_wrapper">
                            <div class="jp_job_heading">
                                <h1><span></span> Cơ hội nghề nghiệp hấp dẫn</h1>
                                <p>Tìm kiếm công việc phù hợp với bạn!</p>
                            </div>
                        </div>
                    </div>
                    @include('client.pages.components.search.searchForm', ['getProvince' => $getProvince, 'getMajor' => $getMajor, 'getFiled' => $getFiled])
                </div>
            </div>
        </div>
    </div>
    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs p"
                     style="position: sticky; top: 0;">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-2">
                            <div class="jp_filter_wrapper d-flex align-items-center">
                                <div class="d-flex align-items-center filter-btn">
                                    <i class="fa-solid fa-filter" style="padding-right: 10px; color: #23c0e9"></i>
                                    <h4 class="mb-0"> Lọc nâng cao</h4>
                                </div>
                                <div
                                    class="clear-filter-btn ms-auto d-flex align-items-center"
                                    id="">
                                    <a type="button" onclick="removeFilter()"><i class="fa fa-times-circle"></i> Xoá lọc</a>
                                </div>

                            </div>
                            <div class="jp_rightside_job_categories_wrapper"
                                 style="max-height: calc(70vh - 10px); overflow-y: auto;">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>Lọc lĩnh vực</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                @foreach($getFiled as $field)
                                                    <p>
                                                        <input type="checkbox" id="fields-{{$field->id}}"
                                                               name="fields[]"
                                                               value="{{$field->id}}">
                                                        <label for="fields-{{$field->id}}">{{ $field->name }}</label>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper"
                                 style="max-height: calc(70vh - 10px); overflow-y: auto;">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>Lọc kỹ năng</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                @foreach($getSkills as $skill)
                                                    <p>
                                                        <input type="checkbox" id="skill-{{$skill->id}}" name="skills[]"
                                                               value="{{$skill->id}}">
                                                        <label for="skill-{{$skill->id}}">{{ $skill->name }}</label>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="tab-content">
                                <div id="list" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            @if($getJobs->count() > 0)
                                                @foreach($getJobs as $getJob)
                                                    <div
                                                        class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                        <div class="item">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div
                                                                        class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                                        <div class="jp_job_post_main_wrapper">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                                    <a href="{{ route('detailJob', ['slug' => $getJob->slug]) }}">
                                                                                        <div
                                                                                            class="jp_job_post_side_img">
                                                                                            <img
                                                                                                data-bs-toggle="tooltip"
                                                                                                title="{{ $getJob->company->name }}"
                                                                                                src="{{isset($getJob->company->avatar_path) ? asset($getJob->company->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                                                                alt="post_img"/>
                                                                                        </div>

                                                                                        <div
                                                                                            class="jp_job_post_right_cont jp_cl_job_cont">
                                                                                            <h4 data-bs-toggle="tooltip"
                                                                                                title="{{ ucwords($getJob->name) }}">
                                                                                                {{ Str::limit(ucwords($getJob->name), 45) }}</h4>
                                                                                            <p style="color:#e69920;"
                                                                                               data-bs-toggle="tooltip"
                                                                                               title="{{ strtoupper($getJob->company->name) }}">
                                                                                                {{ strtoupper($getJob->company->name)}}</p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="jp_job_post_right_content d-flex align-items-center justify-content-between">
                                                                                            <ul>
                                                                                                <li data-bs-toggle="tooltip"
                                                                                                    title="{{ ucwords($getJob->company->addresses->first()->province->name) }}, {{ ucwords($getJob->company->addresses->first()->district->name) }}">
                                                                                                    <i class="fa-solid fa-location-dot"
                                                                                                       style="color: #ff5353;"></i>
                                                                                                    {{ ucwords($getJob->company->addresses->first()->province->name) }}
                                                                                                </li>
                                                                                            </ul>
                                                                                            <ul>
                                                                                                <li>
                                                                                                    Còn
                                                                                                    <strong>{{ Carbon\Carbon::parse($getJob->end_date)->startOfDay()->diffInDays(now()->startOfDay())}}</strong>
                                                                                                    ngày để ứng
                                                                                                    tuyển
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </a>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                    <div
                                                                                        class="jp_job_post_right_btn_wrapper btn-block">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <a
                                                                                                    href="{{ route('detailJob', ['slug' => $getJob->slug]) }}">Ứng
                                                                                                    tuyển</a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="jp_job_post_keyword_wrapper">
                                                                            <ul>
                                                                                <li>
                                                                                    <i class="fa-solid fa-graduation-cap"></i>
                                                                                </li>
                                                                                @if ($getJob->skills)
                                                                                    @foreach ($getJob->skills as $skill)
                                                                                        <li><a
                                                                                                style="text-decoration: none;"
                                                                                                href="#">{{ $skill->name }}</a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                @endif
                                                                                <li class="float-end">
                                                                                    <p>Đã
                                                                                        đăng {{ Carbon\Carbon::parse($getJob->updated_at)->diffForHumans() }}</p>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="text-center" style="margin-top: 100px;">
                                                    <img class="lazy entered loaded"
                                                         data-src="https://cdn-new.topcv.vn/unsafe/https://static.topcv.vn/v4/image/job-list/foppy-far-far-away.svg"
                                                         alt="None suitable job" data-ll-status="loaded"
                                                         src="https://cdn-new.topcv.vn/unsafe/https://static.topcv.vn/v4/image/job-list/foppy-far-far-away.svg">
                                                    <p class="text-center">
                                                        Chưa tìm thấy việc làm phù hợp với yêu cầu của bạn</p>
                                                </div>
                                            @endif
                                        </div>
                                        @if ($getJobs->lastPage() > 1)
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                                                <div class="pager_wrapper gc_blog_pagination">
                                                    <ul class="pagination">
                                                        <li class="{{ $getJobs->onFirstPage() ? 'disabled' : '' }}">
                                                            <a href="{{ $getJobs->previousPageUrl() }}">
                                                                <i class="fa fa-chevron-left"></i>
                                                            </a>
                                                        </li>

                                                        @foreach ($getJobs->getUrlRange(1, $getJobs->lastPage()) as $page => $url)
                                                            <li class="{{ $page == $getJobs->currentPage() ? 'active' : '' }}">
                                                                <a href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach

                                                        <li class="{{ $getJobs->hasMorePages() ? '' : 'disabled' }}">
                                                            <a href="{{ $getJobs->nextPageUrl() }}">
                                                                <i class="fa fa-chevron-right"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
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
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            let loading = false;

            $('input[type="checkbox"]').on('change', function () {
                if (loading) return;

                loading = true;

                let selectedFields = [];
                let selectedSkills = [];

                $('input[name="fields[]"]:checked').each(function () {
                    selectedFields.push($(this).val());
                });

                $('input[name="skills[]"]:checked').each(function () {
                    selectedSkills.push($(this).val());
                });

                let keySearch = $('input[name="key_search"]').val();
                console.log(keySearch)
                $.ajax({
                    url: '{{ route("search") }}',
                    method: 'GET',
                    data: {
                        key_search: keySearch,
                        fields: selectedFields,
                        skills: selectedSkills,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function () {
                        $('.tab-content').html('<div class="text-center"><div class="foppy-loader"><div class="foppy-loader__circle"></div><div class="foppy-loader__circle"></div><div class="foppy-loader__circle"></div></div></div>');
                    },
                    success: function (response) {
                        $('.tab-content').html(response.html);
                    },
                    complete: function () {
                        loading = false;
                    },
                    error: function (xhr, status, error) {
                        console.error('Lỗi AJAX:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Xử lý checkbox
            $('input[type="checkbox"]').on('change', handleFilter);

            // Xử lý click phân trang
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                loadJobs(url);
            });
        });

        function handleFilter() {
            let selectedFields = [];
            let selectedSkills = [];

            $('input[name="fields[]"]:checked').each(function () {
                selectedFields.push($(this).val());
            });

            $('input[name="skills[]"]:checked').each(function () {
                selectedSkills.push($(this).val());
            });

            loadJobs('{{ route("search") }}', {
                fields: selectedFields,
                skills: selectedSkills
            });
        }

        function loadJobs(url, data = {}) {
            $('.tab-content').html('<div class="text-center"><div class="foppy-loader"><div class="foppy-loader__circle"></div><div class="foppy-loader__circle"></div><div class="foppy-loader__circle"></div></div></div>');

            $.ajax({
                url: url,
                method: 'GET',
                data: data,
                success: function (response) {
                    $('.tab-content').html(response.html);
                },
                error: function (xhr, status, error) {
                    console.error('Lỗi AJAX:', error);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function () {
            // Xử lý checkbox filters với AJAX
            $('input[type="checkbox"]').on('change', function () {
                handleSearch(true); // true = use AJAX
            });

            // Xử lý form tìm kiếm
            $('.jp_header_form_wrapper').find('select, input').on('change keyup', function () {
                // Nếu không phải submit button, thực hiện search AJAX
                handleSearch(true);
            });

            // Xử lý submit form thông thường
            $('form').on('submit', function (e) {
                e.preventDefault();
                handleSearch(false); // false = normal form submit
            });
        });

        function handleSearch(isAjax) {
            let form = $('form');
            let formData = {
                key_search: $('input[name="key_search"]').val(),
                province_id: $('select[name="province_id"]').val(),
                major_id: $('select[name="major_id"]').val()
            };

            // Thêm dữ liệu từ checkbox filters nếu có
            let selectedFields = [];
            let selectedSkills = [];

            $('input[name="fields[]"]:checked').each(function () {
                selectedFields.push($(this).val());
            });

            $('input[name="skills[]"]:checked').each(function () {
                selectedSkills.push($(this).val());
            });

            formData.fields = selectedFields;
            formData.skills = selectedSkills;

            if (isAjax) {
                // AJAX search
                $('.tab-content').html('<div class="text-center"><div class="foppy-loader"><div class="foppy-loader__circle"></div><div class="foppy-loader__circle"></div><div class="foppy-loader__circle"></div></div></div>');

                $.ajax({
                    url: form.attr('action'),
                    method: 'GET',
                    data: formData,
                    success: function (response) {
                        $('.tab-content').html(response.html);
                    },
                    error: function (xhr, status, error) {
                        console.error('Lỗi AJAX:', error);
                    }
                });
            } else {
                // Normal form submit - Chuyển các filter thành hidden inputs
                form.find('input[name="fields[]"]').remove();
                form.find('input[name="skills[]"]').remove();

                selectedFields.forEach(function (field) {
                    form.append(`<input type="hidden" name="fields[]" value="${field}">`);
                });

                selectedSkills.forEach(function (skill) {
                    form.append(`<input type="hidden" name="skills[]" value="${skill}">`);
                });

                form.submit();
            }
        }

        // Xử lý phân trang AJAX
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');

            $('.tab-content').html('<div class="text-center"><div class="foppy-loader"><div class="foppy-loader__circle"></div><div class="foppy-loader__circle"></div><div class="foppy-loader__circle"></div></div></div>');

            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    $('.tab-content').html(response.html);
                },
                error: function (xhr, status, error) {
                    console.error('Lỗi AJAX:', error);
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("key_search");
            const clearBtn = document.getElementById("clear_btn");

            clearBtn.addEventListener("click", () => {
                searchInput.value = "";
                searchInput.dispatchEvent(new Event("input")); // Kích hoạt sự kiện input
                searchInput.focus(); // Để người dùng tiếp tục nhập liệu
            });
        });
    </script>
    <script>
        function removeFilter() {
            $('#key_search').val('');
            $('#province_id').val('');
            $('#major_id').val('');
            $('input[name="fields[]"]').prop('checked', false);
            $('input[name="skills[]"]').prop('checked', false);
            const url = new URL(window.location.href);
            url.search = '';
            window.history.pushState({}, document.title, url.toString());
            const searchParams = new URLSearchParams(window.location.search);
            if (searchParams.get('key_search') || searchParams.get('province_id') || searchParams.get('major_id')) {
                loadJobs(window.location.href, searchParams);
            } else {
                loadJobs(window.location.href);
            }

            function removeFilter() {
                $('#key_search').val('');
                $('#province_id').val('');
                $('#major_id').val('');
                $('input[name="fields[]"]').prop('checked', false);
                $('input[name="skills[]"]').prop('checked', false);
                const url = new URL(window.location.href);
                url.search = '';
                window.history.pushState({}, document.title, url.toString());

                const searchParams = new URLSearchParams(window.location.search);
                if (searchParams.toString()) {
                    loadJobs(window.location.href, searchParams);
                } else {
                    loadJobs(window.location.href);
                }
            }

            $(document).ready(function () {
                // Check nếu có request lên thì hiển thị ra
                const searchParams = new URLSearchParams(window.location.search);
                if (searchParams.toString()) {
                    loadJobs(window.location.href, searchParams);
                }
            });
        }
    </script>
@endsection
