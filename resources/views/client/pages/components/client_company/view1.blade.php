@forelse ($companies as $company)
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont rounded-3">
                <div class="jp_job_post_main_wrapper jp_job_post_grid_main_wrapper rounded-3">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_job_post_side_img">
                                <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                    <img src="{{ isset($company->avatar_path) ? asset($company->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                        id="hiring_img" class="rounded-circle" alt="image" />
                                </a>
                            </div>
                            <div class="jp_job_post_right_cont jp_job_post_grid_right_cont jp_cl_job_cont">
                                <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                    <h4 style="font-size: 18px" data-bs-placement="top" data-bs-title="{{ $company->name }}" class="company_name d-inline">
                                        {{ \Illuminate\Support\Str::limit($company->name, 25, '...') }}
                                    </h4>
                                </a>
                                <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                    <div class="mt-3 mb-3 d-flex align-items-center">
                                        @if ($company->addresses->isEmpty())
                                            <label class="h5 mb-2 mt-2">
                                                Chưa cập nhật địa chỉ
                                            </label>
                                        @else
                                            <i class="fa-solid fa-location-dot me-2" style="color: #ff5353;"></i>
                                            <label class="h5">
                                                {{ $company->addresses->first()->specific_address }},
                                                {{ $company->addresses->first()->ward ? $company->addresses->first()->ward->name . ', ' : '' }}
                                                {{ $company->addresses->first()->district ? $company->addresses->first()->district->name . ', ' : '' }}
                                                {{ $company->addresses->first()->province ? $company->addresses->first()->province->name : '' }}
                                            </label>
                                        @endif
                                    </div>
                                </a>
                                <div
                                    class="jp_job_post_right_btn_wrapper jp_job_post_grid_right_btn_wrapper jp_cl_aply_btn">
                                    <ul>
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
