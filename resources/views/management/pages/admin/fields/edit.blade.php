@extends('management.layout.main')

@section('title', 'Sửa lĩnh vực')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.fields.update', $fields->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.fields.index') }}">Lĩnh vực</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sửa lĩnh vực</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card profile-card card-bx m-b30">
                        <div class="card-header">
                            <h6 class="card-title">Thông tin lĩnh vực</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <label class="form-label required">Têm lĩnh vực</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Công nghệ thông tin" name="name" id="name"
                                        oninput="ChangeToSlug()" value="{{ old('name', $fields->name) }}">
                                    @error('name')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-12 mb-3">
                                    <label class="form-label required">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        placeholder="cong-nghe-thong-tin" name="slug" id="slug" readonly
                                        value="{{ old('slug', $fields->slug) }}">
                                    @error('slug')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-12 mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <select class="form-control" name="status">
                                        <option value="{{ STATUS_PENDING }}"
                                            {{ old('status', $fields->status) == STATUS_PENDING ? 'selected' : '' }}>Chờ
                                            duyệt</option>
                                        <option value="{{ STATUS_APPROVED }}"
                                            {{ old('status', $fields->status) == STATUS_APPROVED ? 'selected' : '' }}>
                                            Duyệt
                                        </option>
                                        <option value="{{ STATUS_REJECTED }}"
                                            {{ old('status', $fields->status) == STATUS_REJECTED ? 'selected' : '' }}>Từ
                                            chối
                                        </option>
                                    </select>
                                </div>

                                <div class="col-sm-12 mb-3">
                                    <label class="form-label ">Mô tả</label>
                                    <textarea name="description" id="description" class="tinymce_editor_init" cols="30" rows="10">{{ old('description', $fields->description) }}</textarea>
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
