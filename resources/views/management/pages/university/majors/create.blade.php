@extends('management.layout.main')
@section('title', 'Danh sách ngành học')

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
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Thêm mới ngành học</li>
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
                                <i class="fa-sharp fa-solid fa-plus me-2"></i>Thêm mới
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <form method="POST" action="{{ route('university.majors.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-sm-12 mb-3">
                                            <label class="form-label">Chuyên ngành</label>
                                            <select name="major_id[]" class="multi-select-placeholder js-states" style="width:100%;"
                                                multiple="multiple">
                                                @foreach ($majors_data as $major_data)
                                                    @if (!in_array($major_data->id, $majors_existed))
                                                        <option selected value="{{ $major_data->id }}">{{ $major_data->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-6 align-self-end mb-3">
                                            <button class="btn btn-success me-2" title="Click here to Search"
                                                type="submit">
                                                <i class="fa-sharp fa-solid fa-plus me-2"></i>Thêm
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
