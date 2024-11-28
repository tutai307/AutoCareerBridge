<div id="resultContainer">
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($universities as $university)
            <div class="col">
                <a href="{{route('detailUniversityAdmin',$university->slug)}}" class="card-link">
                    <div class="card h-100 text-center overflow-hidden"
                        style="border: 1px solid #ddd; border-radius: 8px;">
                        <div style=" text-align: left;" class="card-body d-flex flex-column align-items-start p-3">
                            <div class="profile-photo mb-3">
                                <img src="{{ isset($university->avatar_path) ? asset('storage/' . $university->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                    width="80" height="80" class="img-fluid rounded-circle"
                                    alt="{{ $university->name }}">
                            </div>
                            <h5 class="mb-2" style="font-size: 1.1em; font-weight: bold;">{{ $university->name }}</h5>
                            <p class="text-muted mb-3" style="font-size: 0.9em; color: #666;">
                                {!! Str::limit($university->description, 100, '...') !!}</p>
                                {{-- Hàm này kiểm tra xem danh sách các công ty đã liên kết với trường đại học có chứa công ty hiện tại hay không --}}
                                @php
                                    $companyId = null;
                                    $isFollowed = false;
                                    $isPending = false;
                                    if (auth()->guard('admin')->check()) {
                                        $user = auth()->guard('admin')->user();
                                        if ($user && $user->company) {
                                            $companyId = $user->company->id;
                                            $isFollowed = $university->collaborations()
                                                                 ->where('status', 2)
                                                                 ->where('company_id', $companyId)
                                                                 ->exists();
                                            $isPending = $university->collaborations()
                                                                ->where('status', 1)
                                                                ->where('company_id', $companyId)
                                                                ->exists();
                                        }
                                    }
                                @endphp
                                @if ($companyId)
                                    @if ($isPending)
                                        <a class="btn btn-sm px-4 btn-light" href="#">
                                            Hủy yêu cầu
                                        </a>
                                    @elseif ($isFollowed)
                                        <a class="btn btn-sm px-4 btn-light" href="#">
                                            Đang hợp tác
                                        </a>
                                    @else
                                        <a class="btn btn-sm px-4 btn-primary" href="#">
                                            Hợp tác
                                        </a>
                                    @endif
                                @endif
                         
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div>
                <p>Không tìm thấy trường</p>
            </div>
        @endforelse
    </div>
</div>
