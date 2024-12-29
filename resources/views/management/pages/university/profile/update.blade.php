<div class="modal fade modal_update_university" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật thông tin hồ sơ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Tên trường</label>
                        <input type="text" class="form-control" id="name" name="name" oninput="ChangeToSlug()"
                            value="{{ $university->name ?? '' }}">
                        @error('name')
                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Slug URL</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            value="{{ $university->slug ?? '' }}">
                        @error('slug')
                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Tên viết tắt</label>
                        <input type="text" class="form-control" id="abbreviation" name="abbreviation"
                            value="{{ $university->abbreviation ?? '' }}">
                        @error('abbreviation')
                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Website</label>
                        <input type="text" class="form-control" id="website" name="website"
                            value="{{ $university->website_link ?? '' }}">
                        @error('website')
                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Tỉnh/Thành phố --}}
                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Tỉnh/Thành phố</label>
                        <div class="dropdown bootstrap-select default-select wide form-control dropdown">
                            <select class="form-control" id="province" name="province">
                                <option value="{{ $university->address->province_id }}">
                                    {{ $university->address->province->name ?? 'Chọn Tỉnh/Thành phố' }}
                                </option>
                            </select>
                            @error('province')
                                <span class="d-block text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Quận/Huyện</label>
                        <div class="dropdown bootstrap-select default-select wide form-control dropdown">
                            <select class="form-control" id="district" name="district">
                                <option value="{{ $university->address->district_id }}">
                                    {{ $university->address->district->name ?? 'Chọn Quận/Huyện' }}
                                </option>
                            </select>
                            @error('district')
                                <span class="d-block text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Phường/Xã</label>
                        <div class="dropdown bootstrap-select default-select wide form-control dropdown">
                            <select class="form-control" id="ward" name="ward">
                                <option value="{{ $university->address->ward_id }}">
                                    {{ $university->address->ward->name ?? 'Chọn Phường/Xã' }}
                                </option>
                            </select>
                            @error('ward')
                                <span class="d-block text-danger mt-2">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>


                    {{-- Địa chỉ chi tiết --}}
                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Địa chỉ cụ thể</label>
                        <input type="text" class="form-control" id="specific-address"
                            name="specific_address" value="{{ $university->address->specific_address ?? '' }}">
                        @error('specific_address')
                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 m-b30">
                        <label class="form-label required text-primary">Giới thiệu</label>
                        <textarea name="intro" rows="10" class="tinymce_editor_init" id="intro" cols="80">{{ $university->about ?? '' }}</textarea>
                        @error('intro')
                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-12 m-b30">
                        <label class="form-label required text-primary">Mô tả</label>
                        <textarea name="description" rows="10" class="tinymce_editor_init" id="des" cols="80">{{ $university->description ?? '' }}</textarea>
                        @error('description')
                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary" id="saveChangesBtn" form="update-university-form">Lưu
                    thay đổi</button>
            </div>
        </div>
    </div>
</div>
