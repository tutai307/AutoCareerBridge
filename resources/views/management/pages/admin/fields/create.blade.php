@extends('management.layout.main')

@section('title', 'Thêm mới lĩnh vực')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.fields.store') }}" method="POST">
            @csrf
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.fields.index') }}">{{__('label.admin.fields.list_fields')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('label.admin.add_new')}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card profile-card card-bx m-b30">
                        <div class="card-header">
                            <h6 class="card-title">{{ __('label.admin.fields.info_field') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <label class="form-label required">{{__('label.admin.fields.name_field')}}</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="{{__('label.admin.fields.name_field')}}" name="name" id="name"
                                        oninput="ChangeToSlug()" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-12 mb-3">
                                    <label class="form-label required">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        placeholder="{{__('label.admin.fields.slug')}}" name="slug" id="slug" readonly
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-12 mb-3">
                                    <label class="form-label ">{{__('label.admin.fields.description')}}</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="20"
                                        rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.fields.index') }}" class="btn btn-light">{{__('label.admin.back')}}</a>
                            <button class="btn btn-primary" type="submit">{{__('label.admin.add_new')}}</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    </div>
@endsection
