@extends('management.layout.main')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">{{ __('label.hello') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('label.welcome') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>  
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card quick_payment">
                        <div class="card-header border-0 pb-2">
                            <h2 class="card-title">{{ __('label.admin.title') }}</h2>
                            <p>{{ __('label.admin.content') }}</p>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                @if (isset($listPostNew) && count($listPostNew) > 0)
                                    @foreach ($listPostNew as $item)
                                        <div class="col-xl-6">
                                            <div class="quick-info ">
                                                <div class="quick-content">
                                                    <a href="" target="_blank">
                                                        <img class="avatar me-2" width="100px"
                                                            src="{{ $item->avatar_path ? asset($item->avatar_path) : asset('admin-assets/images/no-img-avatar.png') }}"
                                                            alt="{{ $item->name }}">
                                                    </a>
                                                    <div class="user-name">
                                                        <h6 class="mb-0">
                                                            <a target="_blank"
                                                                href="{{ route('admin.post.index') }}">{{ $item->name }}
                                                            </a>
                                                        </h6>
                                                        <p class="mb-0">{{ $item->category->name ?? '' }}</p>
                                                        <span>{{ date_format($item->created_at, 'd-m-Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
