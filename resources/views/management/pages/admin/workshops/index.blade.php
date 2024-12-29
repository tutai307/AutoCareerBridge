@extends('management.layout.main')

@section('title', 'Quản lý workshop')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('label.admin.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('label.admin.sidebar.workshops') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="filter cm-content-box box-primary">
                <div class="content-title SlideToolHeader">
                    <div class="cpa">
                        <i class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.admin.filter') }}
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="handle expand"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt" style="">
                    <form method="GET" action="{{ route('admin.workshops.index') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6">
                                    <label
                                        class="form-label">{{ __('label.admin.workshop.workshop_name_or_university_name') }}</label>
                                    <input type="text" class="form-control mb-xl-0 mb-3" name="search"
                                        value="{{ request()->search }}" placeholder="{{ __('label.admin.search') }}">
                                </div>

                                <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                    <label class="form-label">{{ __('label.admin.job.status') }}</label>
                                    <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                        <select name="status" class="form-control default-select h-auto wide">
                                            <option value="" @if (request()->status == '') selected @endif>
                                                {{ __('label.admin.job.select_status') }}</option>
                                            <option value="{{ STATUS_PENDING }}"
                                                @if (request()->status == STATUS_PENDING) selected @endif>
                                                {{ __('label.admin.workshop.pending') }}</option>
                                            <option value="{{ STATUS_APPROVED }}"
                                                @if (request()->status == STATUS_APPROVED) selected @endif>
                                                {{ __('label.admin.workshop.in_progress') }}</option>
                                            <option value="{{ STATUS_REJECTED }}"
                                                @if (request()->status == STATUS_REJECTED) selected @endif>
                                                {{ __('label.admin.workshop.completed') }}</option>
                                        </select>

                                        <div class="dropdown-menu ">
                                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-6 align-self-end">
                                    <div>
                                        <button class="btn btn-primary me-2" title="Click here to Search" type="submit">
                                            <i class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.admin.filter') }}
                                        </button>
                                        <button class="btn btn-danger light" title="Click here to remove filter"
                                            type="button"
                                            onclick="window.location.href='{{ route('admin.workshops.index') }}'">
                                            {{ __('label.admin.clear_filter') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('label.admin.workshop.list_workshop') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>{{ __('label.admin.workshop.title_workshop') }}</th>
                                    <th>{{ __('label.admin.workshop.university_create') }}</th>
                                    <th>{{ __('label.admin.workshop.start_date') }}</th>
                                    <th>{{ __('label.admin.workshop.end_date') }}</th>
                                    <th>{{ __('label.admin.workshop.status') }}</th>
                                    <th>{{ __('label.admin.workshop.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($workshops->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            {{ __('label.admin.workshop.no_workshop') }}
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($workshops as $index => $workshop)
                                    <tr>
                                        <td>
                                            <strong>{{ $index + 1 + ($workshops->currentPage() - 1) * $workshops->perPage() }}</strong>
                                        </td>
                                        <td>
                                            {{ $workshop->name }}
                                        </td>
                                        <td>
                                            {{ $workshop->university_name }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($workshop->start_date)->format('d/m/Y, H:i') }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($workshop->end_date)->format('d/m/Y, H:i') }}
                                        </td>
                                        <td>
                                            @if (\Carbon\Carbon::now()->between($workshop->start_date, $workshop->end_date))
                                                <span
                                                    class="badge bg-info">{{ __('label.admin.workshop.in_progress') }}</span>
                                            @elseif (\Carbon\Carbon::now()->gt($workshop->end_date))
                                                <span
                                                    class="badge bg-success">{{ __('label.admin.workshop.completed') }}</span>
                                            @else
                                                <span class="badge bg-warning">{{ __('label.admin.workshop.pending') }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div>
                                                <a href="#" class="btn btn-primary shadow btn-xs btn-show-details"
                                                    data-slug="{{ $workshop->slug }}" data-bs-toggle="modal">
                                                    <i class="fa-solid fa-file-alt"></i>
                                                    {{ __('label.admin.workshop.detail') }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    @if ($workshops->lastPage() > 1)
                        {{ $workshops->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 80%;"> <!-- Đặt chiều rộng tối đa là 80% -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">{{ __('label.admin.workshop.detail_workshop') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailsModalBody">
                    <!-- Form bên trong modal -->
                    <form action="" id="jobForm" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12 col-xl-3">
                                <div class="card box-2 pt-0" style="max-height: 240px;">
                                    <div class="flow flow-ws">
                                        <div class="dz-media"><img
                                                src="https://png.pngtree.com/thumb_back/fh260/background/20230516/pngtree-cute-wallpapers-cats-wallpapers-hd-4k-wallpapers-desktop-wallpapers-hd-image_2562853.jpg"
                                                class="avatar-workshop" id="avt_workshop" alt="">
                                            <h5 id="title-workshop">sssss</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card box-2 pt-0" style="max-height: 240px;">
                                    <div class="flow">
                                        <div class="dz-media"><img
                                                src="{{ asset('management-assets/images/no-img-avatar.png') }}"
                                                class="avatar" id="avt_university" alt="">
                                            <h5 id="university-name">sssss</h5>
                                        </div>
                                        <div class="side" style="background-color: #23c0e9;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-9">


                                <div class="card box-1 overflow-hidden">

                                    <div class="max-2 mt-3">
                                        <div class="ul-li">
                                            <ul class="d-flex mb-2">
                                                <li class="me-3 me-lg-5"><svg class="me-2" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 14C12.1978 14 12.3911 13.9414 12.5556 13.8315C12.72 13.7216 12.8482 13.5654 12.9239 13.3827C12.9996 13.2 13.0194 12.9989 12.9808 12.8049C12.9422 12.6109 12.847 12.4327 12.7071 12.2929C12.5673 12.153 12.3891 12.0578 12.1951 12.0192C12.0011 11.9806 11.8 12.0004 11.6173 12.0761C11.4346 12.1518 11.2784 12.28 11.1685 12.4444C11.0587 12.6089 11 12.8022 11 13C11 13.2652 11.1054 13.5196 11.2929 13.7071C11.4804 13.8946 11.7348 14 12 14ZM17 14C17.1978 14 17.3911 13.9414 17.5556 13.8315C17.72 13.7216 17.8482 13.5654 17.9239 13.3827C17.9996 13.2 18.0194 12.9989 17.9808 12.8049C17.9422 12.6109 17.847 12.4327 17.7071 12.2929C17.5673 12.153 17.3891 12.0578 17.1951 12.0192C17.0011 11.9806 16.8 12.0004 16.6173 12.0761C16.4346 12.1518 16.2784 12.28 16.1685 12.4444C16.0587 12.6089 16 12.8022 16 13C16 13.2652 16.1054 13.5196 16.2929 13.7071C16.4804 13.8946 16.7348 14 17 14ZM12 18C12.1978 18 12.3911 17.9414 12.5556 17.8315C12.72 17.7216 12.8482 17.5654 12.9239 17.3827C12.9996 17.2 13.0194 16.9989 12.9808 16.8049C12.9422 16.6109 12.847 16.4327 12.7071 16.2929C12.5673 16.153 12.3891 16.0578 12.1951 16.0192C12.0011 15.9806 11.8 16.0004 11.6173 16.0761C11.4346 16.1518 11.2784 16.28 11.1685 16.4444C11.0587 16.6089 11 16.8022 11 17C11 17.2652 11.1054 17.5196 11.2929 17.7071C11.4804 17.8946 11.7348 18 12 18ZM17 18C17.1978 18 17.3911 17.9414 17.5556 17.8315C17.72 17.7216 17.8482 17.5654 17.9239 17.3827C17.9996 17.2 18.0194 16.9989 17.9808 16.8049C17.9422 16.6109 17.847 16.4327 17.7071 16.2929C17.5673 16.153 17.3891 16.0578 17.1951 16.0192C17.0011 15.9806 16.8 16.0004 16.6173 16.0761C16.4346 16.1518 16.2784 16.28 16.1685 16.4444C16.0587 16.6089 16 16.8022 16 17C16 17.2652 16.1054 17.5196 16.2929 17.7071C16.4804 17.8946 16.7348 18 17 18ZM7 14C7.19778 14 7.39112 13.9414 7.55557 13.8315C7.72002 13.7216 7.84819 13.5654 7.92388 13.3827C7.99957 13.2 8.01937 12.9989 7.98079 12.8049C7.9422 12.6109 7.84696 12.4327 7.70711 12.2929C7.56725 12.153 7.38907 12.0578 7.19509 12.0192C7.00111 11.9806 6.80004 12.0004 6.61732 12.0761C6.43459 12.1518 6.27841 12.28 6.16853 12.4444C6.05865 12.6089 6 12.8022 6 13C6 13.2652 6.10536 13.5196 6.29289 13.7071C6.48043 13.8946 6.73478 14 7 14ZM19 4H18V3C18 2.73478 17.8946 2.48043 17.7071 2.29289C17.5196 2.10536 17.2652 2 17 2C16.7348 2 16.4804 2.10536 16.2929 2.29289C16.1054 2.48043 16 2.73478 16 3V4H8V3C8 2.73478 7.89464 2.48043 7.70711 2.29289C7.51957 2.10536 7.26522 2 7 2C6.73478 2 6.48043 2.10536 6.29289 2.29289C6.10536 2.48043 6 2.73478 6 3V4H5C4.20435 4 3.44129 4.31607 2.87868 4.87868C2.31607 5.44129 2 6.20435 2 7V19C2 19.7957 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 22 5 22H19C19.7957 22 20.5587 21.6839 21.1213 21.1213C21.6839 20.5587 22 19.7957 22 19V7C22 6.20435 21.6839 5.44129 21.1213 4.87868C20.5587 4.31607 19.7957 4 19 4ZM20 19C20 19.2652 19.8946 19.5196 19.7071 19.7071C19.5196 19.8946 19.2652 20 19 20H5C4.73478 20 4.48043 19.8946 4.29289 19.7071C4.10536 19.5196 4 19.2652 4 19V10H20V19ZM20 8H4V7C4 6.73478 4.10536 6.48043 4.29289 6.29289C4.48043 6.10536 4.73478 6 5 6H19C19.2652 6 19.5196 6.10536 19.7071 6.29289C19.8946 6.48043 20 6.73478 20 7V8ZM7 18C7.19778 18 7.39112 17.9414 7.55557 17.8315C7.72002 17.7216 7.84819 17.5654 7.92388 17.3827C7.99957 17.2 8.01937 16.9989 7.98079 16.8049C7.9422 16.6109 7.84696 16.4327 7.70711 16.2929C7.56725 16.153 7.38907 16.0578 7.19509 16.0192C7.00111 15.9806 6.80004 16.0004 6.61732 16.0761C6.43459 16.1518 6.27841 16.28 6.16853 16.4444C6.05865 16.6089 6 16.8022 6 17C6 17.2652 6.10536 17.5196 6.29289 17.7071C6.48043 17.8946 6.73478 18 7 18Z"
                                                            fill="#FFD125" />
                                                    </svg>
                                                    <b id="created_at">aaaaaaa</b>
                                                </li>
                                                <li class="me-3 me-lg-5">
                                                    <svg class="me-2" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 6C11.8687 5.99997 11.7386 6.02581 11.6173 6.07605C11.4959 6.12629 11.3857 6.19995 11.2928 6.29282C11.2 6.38568 11.1263 6.49594 11.0761 6.61728C11.0258 6.73862 11 6.86867 11 7V11.3838L8.56934 12.6069C8.45206 12.6659 8.34755 12.7474 8.26178 12.8468C8.176 12.9462 8.11064 13.0615 8.06942 13.1861C8.0282 13.3108 8.01194 13.4423 8.02156 13.5733C8.03118 13.7042 8.0665 13.8319 8.12549 13.9492C8.18448 14.0665 8.26599 14.171 8.36538 14.2568C8.46476 14.3426 8.58006 14.4079 8.70471 14.4491C8.82935 14.4904 8.96089 14.5066 9.09182 14.497C9.22274 14.4874 9.35049 14.4521 9.46777 14.3931L12.4492 12.8931C12.6148 12.81 12.7541 12.6824 12.8513 12.5247C12.9486 12.367 13.0001 12.1853 13 12V7C13 6.86867 12.9742 6.73862 12.924 6.61728C12.8737 6.49594 12.8001 6.38568 12.7072 6.29282C12.6143 6.19995 12.5041 6.12629 12.3827 6.07605C12.2614 6.02581 12.1313 5.99997 12 6ZM12 2C10.0222 2 8.08879 2.58649 6.4443 3.6853C4.79981 4.78412 3.51809 6.3459 2.76121 8.17317C2.00433 10.0004 1.8063 12.0111 2.19215 13.9509C2.578 15.8907 3.53041 17.6725 4.92894 19.0711C6.32746 20.4696 8.10929 21.422 10.0491 21.8079C11.9889 22.1937 13.9996 21.9957 15.8268 21.2388C17.6541 20.4819 19.2159 19.2002 20.3147 17.5557C21.4135 15.9112 22 13.9778 22 12C21.997 9.34877 20.9424 6.80699 19.0677 4.93228C17.193 3.05758 14.6512 2.00303 12 2ZM12 20C10.4178 20 8.87104 19.5308 7.55544 18.6518C6.23985 17.7727 5.21447 16.5233 4.60897 15.0615C4.00347 13.5997 3.84504 11.9911 4.15372 10.4393C4.4624 8.88743 5.22433 7.46197 6.34315 6.34315C7.46197 5.22433 8.88743 4.4624 10.4393 4.15372C11.9911 3.84504 13.5997 4.00346 15.0615 4.60896C16.5233 5.21447 17.7727 6.23985 18.6518 7.55544C19.5308 8.87103 20 10.4178 20 12C19.9976 14.121 19.1539 16.1544 17.6542 17.6542C16.1544 19.1539 14.121 19.9976 12 20Z"
                                                            fill="#01A3FF" />
                                                    </svg>
                                                    <b id="end_date">aaaaaaa</b>
                                                </li>
                                                <li class="me-3 me-lg-5">
                                                    <i class="bi bi-people-fill me-2"></i>
                                                    <b id="total_company">aaaaaaa</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="card-title mb-3">
                                            {{ __('label.university.collaboration.detail_colab') }}</h3>
                                        <div class="mt-4 job-detail" id="colab-content">

                                            aaaaaaaa
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <input type="hidden" name="id" value="aaaa">
                        <input type="hidden" name="status" value="">
                    </form>
                </div>
                <div class="modal-footer" id="buttonSubmit">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bắt sự kiện khi nhấn vào nút "Chi tiết"
            document.querySelectorAll('.btn-show-details').forEach(function(button) {
                button.addEventListener('click', function() {
                    var jobSlug = this.getAttribute(
                        'data-slug'); // Lấy slug của bài đăng từ thuộc tính data-slug
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    // Gửi yêu cầu Fetch đến server để lấy chi tiết bài đăng dựa trên slug
                    fetch(`{{ route('admin.workshops.slug', ':slug') }}`.replace(':slug', jobSlug))
                        .then(function(response) {
                            return response.json();
                        })
                        .then(function(data) {

                            if (data.message) return Toast.fire({
                                icon: "error",
                                title: data.message
                            });
                            data = data[0]
                            // Đổ dữ liệu vào modal
                            document.querySelector('#detailsModal #title-workshop').innerHTML =
                                '{{ __('label.admin.workshop.title_workshop') }}: ' +
                                data.name;
                            document.querySelector('#detailsModal img[id="avt_workshop"]').src =
                                data.avatar_path ??
                                "{{ asset('management-assets/images/no-img-avatar.png') }}";
                            document.querySelector(
                                    '#detailsModal #university-name').innerHTML =
                                '{{ __('label.admin.university') }}: ' + data
                                .university_name;
                            document.querySelector('#detailsModal img[id="avt_university"]')
                                .src =
                                data.university_avatar_path ?
                                `{{ asset('storage/${data.university_avatar_path}') }}` :
                                "{{ asset('management-assets/images/no-img-avatar.png') }}";
                            document.querySelector('#detailsModal #created_at').innerHTML =
                                '{{ __('label.admin.workshop.start_date') }}: ' + data
                                .start_date;

                            document.querySelector('#detailsModal #end_date').innerHTML =
                                '{{ __('label.admin.workshop.end_date') }}: ' + data
                                .end_date;
                            document.querySelector('#detailsModal #total_company').innerHTML =
                                '{{ __('label.admin.workshop.company_total') }}: ' +
                                `${data.company_count}/${data.amount}`;

                            // // Đổ nội dung bài đăng vào content
                            document.querySelector('#detailsModal #colab-content').innerHTML =
                                data
                                .content;

                            $('#detailsModal').modal('show');
                        })
                        .catch(function(error) {
                            console.error('Error:', error);

                            Toast.fire({
                                icon: "error",
                                title: error.message
                            });
                        });
                });
            });
        });
    </script>
@endsection

@section('css')
    <style>
        #title-workshop {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .avatar-workshop {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover
        }

        .card {
            height: auto !important;
        }

        .col-md-12.col-xl-3 {
            margin-bottom: 60px;
            /* Adjust the value as needed */
        }

        #res_message {
            max-height: 160px;
            overflow-y: auto;
        }

        .job-detail {
            font-family: 'poppins', sans-serif !important;
            max-height: 400px;
            overflow-y: scroll;
        }

        .job-detail h1 {
            font-size: 1.6rem
        }

        .job-detail h2 {
            font-size: 1.4rem
        }

        .job-detail h3 {
            font-size: 1.2rem
        }

        .job-detail h4 {
            font-size: 1rem
        }

        .job-detail h5 {
            font-size: 0.8rem
        }

        .job-detail h6 {
            font-size: 0.7rem
        }
    </style>
@endsection
