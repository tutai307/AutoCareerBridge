<div id="resultContainer">
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($universities as $university)
            <div class="col">
                <a href="{{route('detailUniversity',$university->id)}}" class="card-link">
                    <div class="card h-100 text-center overflow-hidden"
                        style="border: 1px solid #ddd; border-radius: 8px;">
                        <div style=" text-align: left;" class="card-body d-flex flex-column align-items-start p-3">
                            <div class="profile-photo mb-3">
                                <img src="https://cdn-new.topcv.vn/unsafe/140x/https://static.topcv.vn/company_logos/cong-ty-tnhh-cnv-holdings-7520148eeea2bdf172c68a89e29a6d28-66fe67072e3ed.jpg"
                                    width="80" height="80" class="img-fluid rounded-circle"
                                    alt="{{ $university->name }}">
                            </div>
                            <h5 class="mb-2" style="font-size: 1.1em; font-weight: bold;">{{ $university->name }}</h5>
                            <p class="text-muted mb-3" style="font-size: 0.9em; color: #666;">
                                {!! Str::limit($university->description, 100, '...') !!}</p>
                                {{-- Hàm này kiểm tra xem danh sách các công ty đã liên kết với trường đại học có chứa công ty hiện tại hay không --}}
                                @php
                                $isFollowed = $university->collaborations->contains(auth()->guard('admin')->user()->company->id);
                            @endphp
                            <a class="btn btn-sm px-4 {{ $isFollowed ? 'btn-outline-primary' : 'btn-primary' }}" 
                            href="">
                             {{ $isFollowed ? 'Đang hợp tác' : 'Hợp tác' }}
                         </a>
                         
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
