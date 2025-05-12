@extends('management.layout.main')

@section('title', __('label.university.manage_account'))

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('university.home') }}">{{ __('label.breadcrumb.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('label.university.manage_account') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('label.university.filter') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('university.manageAccounts') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('label.university.student.student_code') }}</label>
                                    <input type="text" name="student_code" class="form-control"
                                        value="{{ request('student_code') }}"
                                        placeholder="{{ __('label.university.student.enter_student_code') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('label.university.student.username') }}</label>
                                    <input type="text" name="username" class="form-control"
                                        value="{{ request('username') }}"
                                        placeholder="{{ __('label.university.student.enter_username') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-2">
                                            <i class="fas fa-search"></i> {{ __('label.university.search') }}
                                        </button>
                                        <a href="{{ route('university.manageAccounts') }}" class="btn btn-secondary">
                                            <i class="fas fa-redo"></i> {{ __('label.university.reset') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('label.university.manage_account') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('label.university.student.student_code') }}</th>
                                    <th>{{ __('label.university.student.name') }}</th>
                                    <th>{{ __('label.university.student.email') }}</th>
                                    <th>{{ __('label.university.student.major') }}</th>
                                    <th>{{ __('label.university.student.status') }}</th>
                                    <th>{{ __('label.university.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($students) && count($students) > 0)
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->student_code }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->major->name ?? '' }}</td>
                                            <td>
                                                @if ($student->is_locked)
                                                    <span
                                                        class="badge badge-danger">{{ __('label.university.student.locked') }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-success">{{ __('label.university.student.active') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <form action="{{ route('university.resetPassword', $student->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info shadow btn-xs sharp">
                                                            <i class="fas fa-sync"></i></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">{{ __('label.university.no_data') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
