@forelse ($companies as $company)
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont rounded-3">
                <div class="jp_job_post_main_wrapper jp_job_post_grid_main_wrapper rounded-3">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_job_post_side_img">
                                <img src="{{ isset($company->avatar_path) ? asset($company->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                    style="object-fit: cover; width: 100%; height: 100%; object-position: center;"
                                    alt="image" />
                            </div>
                            <div class="jp_job_post_right_cont jp_job_post_grid_right_cont jp_cl_job_cont">
                                <h4 style="font-size: 18px">
                                    {{ $company->name }}</h4>
                                <div class="mt-3 mb-3">
                                    @if ($company->addresses->isEmpty())
                                        <span>
                                            Chưa cập nhật địa chỉ
                                        </span>
                                    @else
                                        <i class="fa fa-map-marker"></i>&nbsp;
                                        <span>{{ $company->addresses->first()->specific_address }},
                                            {{ $company->addresses->first()->ward ? $company->addresses->first()->ward->name . ', ' : '' }}
                                            {{ $company->addresses->first()->district ? $company->addresses->first()->district->name . ', ' : '' }}
                                            {{ $company->addresses->first()->province ? $company->addresses->first()->province->name : '' }}
                                        </span>
                                    @endif
                                </div>
                                <div
                                    class="jp_job_post_right_btn_wrapper jp_job_post_grid_right_btn_wrapper jp_cl_aply_btn">
                                    @php
                                        // Đếm tổng số jobs
                                        $jobCount = $company->hirings->sum(function ($hiring) {
                                            return $hiring->jobs->count();
                                        });
                                    @endphp
                                    <ul>
                                        <li>
                                            <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                {{ $jobCount }} việc làm
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@empty
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        <h4>Không có doanh nghiệp nào</h4>
    </div>
@endforelse

