@extends('management.layout.main')
@section('title', __('label.university.student.list_student'))

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">{{ __('label.university.home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ __('label.university.student.list_student') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.university.filter') }}
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <form method="GET" action="{{ route('university.students.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 mb-3">
                                            <label class="form-label">{{ __('label.university.title_search') }}</label>
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request()->search }}"
                                                placeholder="{{ __('label.university.search') }}">
                                        </div>

                                        <div class="col-xl-3 col-sm-6 mb-3">
                                            <label class="form-label">{{ __('label.university.student.major') }}</label>
                                            <select name="major_id" class="form-control default-select"
                                                placeholder="{{ __('label.university.student.select_major') }}">
                                                @foreach ($majors as $major)
                                                    <option value="{{ $major->id }}"
                                                        {{ old('major_id', request()->major_id) == $major->id ? 'selected' : '' }}>
                                                        {{ $major->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-sm-6 mb-3">
                                            <label
                                                class="form-label">{{ __('label.university.student.entry_graduation_year_range') }}</label>

                                            @php
                                                $dateRange = '';
                                                if (request()->date_range) {
                                                    $entryYear = isset($student['entry_year'])
                                                        ? $student['entry_year']
                                                        : '';
                                                    $graduationYear = isset($student['graduation_year'])
                                                        ? $student['graduation_year']
                                                        : '';

                                                    if (app()->getLocale() == 'vi') {
                                                        $defaultDateRange = $entryYear . ' đến ' . $graduationYear;
                                                        $dateRange = request()->date_range
                                                            ? str_replace('to', 'đến', request()->date_range)
                                                            : $defaultDateRange;
                                                    } else {
                                                        $defaultDateRange = $entryYear . ' to ' . $graduationYear;
                                                        $dateRange = request()->date_range
                                                            ? str_replace('đến', 'to', request()->date_range)
                                                            : $defaultDateRange;
                                                    }
                                                }
                                            @endphp

                                            <input type="text" id="dateRangePicker" class="form-control"
                                                name="date_range"
                                                placeholder="{{ __('label.university.student.select_entry_graduation_year_range') }}"
                                                style="background-color: #fff" value="{{ old('date_range', $dateRange) }}">
                                        </div>

                                        <div class="col-xl-3 col-sm-6 align-self-end mb-3">
                                            <button class="btn btn-primary me-2" title="Click here to Search"
                                                type="submit">
                                                <i
                                                    class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.university.filter') }}
                                            </button>
                                            <button class="btn btn-danger light" title="Click here to remove filter"
                                                type="button"
                                                onclick="window.location.href='{{ route('university.students.index') }}'">
                                                {{ __('label.university.clear_filter') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (session()->has('import_fail'))
                <div class="row">
                    <div class="col-xl-12">
                        <div class="filter cm-content-box box-primary bg-danger">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa text-white">
                                    <i
                                        class="fa-sharp fa-solid fa-bug me-2 text-white"></i>{{ __('label.university.student.error') }}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i
                                            class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body form excerpt">
                                <ul class="p-3">
                                    <li class="text-white">{!! session()->get('import_fail') !!}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-xl-12">
                    <div class="card quick_payment">
                        <div class="card-header border-0 pb-2 d-flex justify-content-between">
                            <h2 class="card-title">{{ __('label.university.student.list_student') }}</h2>
                            <div class="d-flex align-items-center">
                                <form action="{{ route('university.studentsExport') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success m-0">
                                        <i class="fa-solid fa-cloud-arrow-down"></i>
                                        Export excel
                                    </button>
                                </form>
                                <a href="{{ route('university.studentsDownloadTemplate') }}" class="btn btn-dark m-0 ms-2">
                                    <i class="fa fa-download"></i>
                                    {{ __('label.university.student.download_template') }}
                                </a>
                                <label for="import_student" class="btn btn-info m-0 ms-2">
                                    <i class="fa fa-upload"></i>
                                    {{ __('label.university.student.import') }}
                                </label>
                                <a href="{{ route('university.students.create') }}"
                                    class="btn btn-primary ms-2">{{ __('label.university.add_new') }}</a>
                            </div>
                        </div>

                        <form id="importForm" action="{{ route('university.studentsImport') }}" method="POST"
                            enctype="multipart/form-data" class="d-none">
                            @csrf
                            <input type="file" id="import_student" name="file" accept=".xlsx, .xls">
                        </form>

                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> {{ __('label.university.student.student_code') }} </th>
                                                <th>{{ __('label.university.student.name') }}</th>
                                                <th class="text-center">{{ __('label.university.student.avatar') }}</th>
                                                <th>{{ __('label.university.student.email') }}</th>
                                                <th>{{ __('label.university.student.phone') }}</th>
                                                <th>{{ __('label.university.student.major') }}</th>
                                                <th>{{ __('label.university.student.entry_year') }}</th>
                                                <th>{{ __('label.university.student.graduation_year') }}</th>
                                                <th>{{ __('label.university.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($students))
                                                @forelse ($students as $student)
                                                    <tr>
                                                        <td><strong>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</strong>
                                                        </td>
                                                        <td>{!! wordwrap($student->student_code, 20, '<br>', true) !!}</td>
                                                        <td>
                                                            {!! wordwrap($student->name, 50, '<br>', true) !!}
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($student->avatar_path)
                                                                @if (str_starts_with($student->avatar_path, 'student/'))
                                                                    <img src="{{ asset('storage/' . $student->avatar_path) }}"
                                                                        alt="{{ $student->name }}" class="rounded-circle"
                                                                        style="max-width: 45px; max-height: 45px; height: 45px; object-fit: cover;" />
                                                                @else
                                                                    <img src="{{ asset('management-assets/images/no-img-avatar.png') }}"
                                                                        alt="{{ $student->name }}" class="rounded-circle"
                                                                        style="max-width: 45px; max-height: 45px; height: 45px; object-fit: cover;" />
                                                                @endif
                                                            @else
                                                                <img src="{{ asset('management-assets/images/no-img-avatar.png') }}"
                                                                    alt="{{ $student->name }}" class="rounded-circle"
                                                                    style="max-width: 45px; max-height: 45px; height: 45px; object-fit: cover;" />
                                                            @endif
                                                        </td>
                                                        <td>{!! wordwrap($student->email, 50, '<br>', true) !!}</td>
                                                        <td>{{ $student->phone }}</td>
                                                        <td>{!! wordwrap($student->major->name ?? '', 50, '<br>', true) !!}</td>
                                                        <td>{{ \Carbon\Carbon::parse($student->entry_year)->format('d/m/Y') }}
                                                        </td>
                                                        <td>
                                                            {{ $student->graduation_year ? \Carbon\Carbon::parse($student->graduation_year)->format('d/m/Y') : '' }}
                                                        </td>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <a href="{{ route('university.students.edit', $student->slug) }}"
                                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                        class="fa fa-pencil"></i></a>
                                                                <form
                                                                    action="{{ route('university.students.destroy', $student) }}"
                                                                    method="POST" style="display:inline;"
                                                                    class="delete-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                                        data-id="{{ $student->id }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="12" class="text-center">
                                                            {{ __('label.university.student.no_data') }}
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                {{ $students->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#dateRangePicker", {
                mode: "range",
                dateFormat: "Y-m-d",
                locale: "{{ app()->getLocale() }}" === 'vi' ? 'vn' : 'en',
                monthSelectorType: "static",
                yearSelectorType: "static",
                onClose: function(selectedDates, dateStr, instance) {
                    document.getElementById('dateRangePicker').value = dateStr;
                },
                onOpen: function(selectedDates, dateStr, instance) {
                    const calendar = instance.calendarContainer;
                    calendar.style.width = "19.9rem";
                },
            });
        });
    </script>

    <script>
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            let form = $(this).closest('.delete-form');
            Swal.fire({
                title: "{{ __('label.university.delete_confirm') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "{{ __('label.university.delete') }}",
                cancelButtonText: "{{ __('label.university.cancel') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
        document.getElementById('import_student').addEventListener('change', function() {
            if (this.files.length > 0) {
                document.getElementById('importForm').submit();
            }
        });
    </script>
@endsection
