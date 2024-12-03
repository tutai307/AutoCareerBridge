@extends('management.layout.main')

@section('title', 'Thêm mới chuyên ngành')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.majors.update', $major->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.fields.index') }}">Chuyên ngành</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Thêm mới chuyên ngành</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card profile-card card-bx m-b30">
                        <div class="card-header">
                            <h6 class="card-title">Thông tin chuyên ngành</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <label class="form-label required">Tên chuyên ngành</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Lập trình web" name="name" id="name" oninput="ChangeToSlug()"
                                        value="{{ old('name', $major->name) }}">
                                    @error('name')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label class="form-label required">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        placeholder="lap-trinh-web" name="slug" id="slug" readonly
                                        value="{{ old('slug', $major->slug) }}">
                                    @error('slug')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-12 mb-3">
                                    <label class="form-label required">Lĩnh vực</label>
                                    <select name="field_id" id="field_id" class="single-select">
                                        <option value="" selected>Chọn lĩnh vực</option>
                                        @foreach ($fields as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('field_id', $major->field_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('field_id')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <select class="form-control" name="status">
                                        <option value="{{ STATUS_PENDING }}"
                                            {{ old('status', $major->status) == STATUS_PENDING ? 'selected' : '' }}>Chờ
                                            duyệt</option>
                                        <option value="{{ STATUS_APPROVED }}"
                                            {{ old('status', $major->status) == STATUS_APPROVED ? 'selected' : '' }}>
                                            Duyệt
                                        </option>
                                        <option value="{{ STATUS_REJECTED }}"
                                            {{ old('status', $major->status) == STATUS_REJECTED ? 'selected' : '' }}>Từ
                                            chối
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label class="form-label ">Mô tả</label>
                                    <textarea name="description" id="description" class="tinymce_editor_init" cols="30" rows="10">{{ old('description', $major->description) }}</textarea>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.fields.index') }}" class="btn btn-light">Quay lại</a>
                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    </div>
@endsection
