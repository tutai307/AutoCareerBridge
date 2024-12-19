@extends('management.layout.main')
@section('title', 'Chi tiết trường học')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="page-titles">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/company/search-university">Tìm kiếm</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thông tin trường học</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
            <div class="profile-head">
                <div class="photo-content">
                    <div style="background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20240301/pngtree-desktop-wallpaper-hd-image_15634025.jpg');" class="cover-photo rounded"></div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                    <img src="{{ isset($detail->avatar_path) ? asset('storage/' . $detail->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}" class="img-fluid rounded-circle" alt="">
                    </div>
                    <div class="profile-details">
                        <div class="profile-name px-3 pt-2">
                            <h4 class="text-primary mb-0">{{$detail->name}}</h4>

                        </div>
                        <div class="profile-email px-2 pt-2">

                            <p>{{$detail->user->email}}</p>
                        </div>
                        <div class="dropdown ms-auto">
                            <div class="btn sharp btn-primary tp-btn" data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <circle fill="#000000" cx="12" cy="5" r="2"></circle>
                                        <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                        <circle fill="#000000" cx="12" cy="19" r="2"></circle>
                                    </g>
                                </svg>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="dropdown-item"><a href="user.html"><i
                                            class="fa fa-user-circle text-primary me-2"></i> View profile</a></li>
                                <li class="dropdown-item"><a href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"><i class="fa fa-users text-primary me-2"></i>
                                        Add to btn-close friends</a></li>
                                <li class="dropdown-item"><a href="javascript:void(0);"><i
                                            class="fa fa-plus text-primary me-2"></i> Add to group</a></li>
                                <li class="dropdown-item"><a href="javascript:void(0);" class="text-danger"><i
                                            class="fa fa-ban text-danger me-2"></i> Block</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-8">
        <div class="card h-auto">
            <div class="card-body">
                <div class="profile-tab">
                    <div class="custom-tab-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link active show">Mô tả
                                </a>
                            </li>
                            <li class="nav-item"><a href="#my-posts" data-bs-toggle="tab"
                                    class="nav-link ">Work Shop</a>
                            </li>


                        </ul>
                        <div class="tab-content">
                            <div id="my-posts" class="tab-pane fade ">
                                <div class="my-post-content pt-3">
                                    <!-- Bài Post work shop -->
                                    @forelse($workshops as $workshop)
                                    <div class="card mb-3" style="width: 100%; border: 1px solid #ddd; border-radius: 8px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img style="width: 100%; height: 220px; background-size: contain; background-repeat: no-repeat; background-position: center;" src="{{$workshop->avatar_path}}" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body" style="padding-bottom:10px;">
                                                    <h5 class="card-title">{!! Str::limit($workshop->name, 100, '...') !!}</h5>
                                        
                                                    <p class="card-text"><small class="text-muted">Thời gian bắt đầu: <b>{{$workshop->start_date}}</b></small></p>
                                                    <p class="card-text"><small class="text-muted">Thời gian kết thúc: <b>{{$workshop->end_date}}</b></small></p>
                                                    <div class="d-flex justify-content-end mb-0">
                                                        <button class="btn btn-primary me-2">
                                                            <span class="me-2"><i class="fa fa-heart"></i></span>Tham gia
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    @empty
                                    <p class="text-center"> Chưa có Work Shop nào</p>
                                  @endforelse
                                    
                                </div>
                            </div>
                            <div id="about-me" class="tab-pane fade active show">
                            <div class="profile-about-me">
                                    <div class="pt-4 border-bottom-1 pb-3">
                                        <h5 class="text-primary">Giới thiệu</h5>
                                        <p class="mb-2">{!!$detail->description!!}
                                        </p>

                                    </div>
                                </div>
                                <div class="profile-about-me">
                                    <div class="pt-4 border-bottom-1 pb-3">
                                        <h5 class="text-primary">Mô tả</h5>
                                        <p class="mb-2">{!! $detail->about !!}
                                        </p>

                                    </div>
                                </div>
                                <div class="profile-skills mb-5">
                                    <h5 class="text-primary mb-2">Các ngành học</h5>

                                    @foreach($majors as $major)
                                    <a href="" class="btn btn-primary light btn-xs mb-1" >
                                        {{ $major->name }}
                                    </a>
                                    @endforeach
                                </div>

                                <div class="profile-personal-info">
                                    <h5 class="text-primary mb-4">Thông tin trường học</h5>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Tên trường <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{$detail->name}}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Email <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{$detail->user->email}}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Hotline <span class="pull-end">:</span></h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>0971410801</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Quy Mô <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{$detail->students->count()}} sinh viên</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">

                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Website:<span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><a href="{{ $detail->website_link }}"><span>{{ $detail->website_link }} </span></a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-statistics">
                            <div class="text-center">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="m-b-0">{{$detail->students->count()}}</h3><span>Quy mô</span>
                                    </div>
                                    <div class="col">
                                        <h3 class="m-b-0">{{count($majors)}}</h3>Ngành<span></span>
                                    </div>
                                    <div class="col">
                                        <h3 class="m-b-0">{{$detail->collaborations->count()}}</h3><span>Liên kểt</span>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    @php
                                    $companyId = null;
                                    $isFollowed = false;
                                    $isPending = false;
                                    if (auth()->guard('admin')->check()) {
                                        $user = auth()->guard('admin')->user();
                                        if ($user && $user->company) {
                                            $companyId = $user->company->id;
                                            $isFollowed = $detail->collaborations()
                                                                 ->where('status', 2)
                                                                 ->where('company_id', $companyId)
                                                                 ->exists();
                                            $isPending = $detail->collaborations()
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-blog">
                            <h5 class="text-primary d-inline">
                                Địa chỉ </h5>
                            <p>{{$full_address}}</p>
                            <h5 class="text-primary d-inline">
                                Xem bản đồ</h5>
                            <?php

                            $encodedAddress = urlencode($full_address);
                            ?>

                            <div style="width: 100%; height: 400px;">
                                <iframe
                                    src="https://www.google.com/maps?q=<?php echo $encodedAddress; ?>&output=embed"
                                    width="100%"
                                    height="100%"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Friend</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" class="form-control mb-3" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="John">
                    </div>
                    <div class="col-xl-12">
                        <label for="exampleInputEmail2" class="form-label">Position</label>
                        <input type="text" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp"
                            placeholder="Position">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection