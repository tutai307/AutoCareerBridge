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
                        <input type="text" class="form-control" id="university-name" name="name"
                            value="{{ $university->name ?? '' }}">
                    </div>
                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Slug URL</label>
                        <input type="text" class="form-control" id="university-slug" name="slug"
                            value="{{ $university->slug ?? '' }}">
                    </div>
                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Website</label>
                        <input type="text" class="form-control" id="university-abbreviation" name="abbreviation"
                            value="{{ $university->abbreviation ?? '' }}">
                    </div>
                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Tên viết tắt</label>
                        <input type="text" class="form-control" id="university-website" name="website"
                            value="{{ $university->website_link ?? '' }}">
                    </div>
                    {{-- Tỉnh/Thành phố --}}
                    <div class="col-sm-6 m-b30">
                        <label class="form-label text-primary">Tỉnh/Thành phố</label>
                        <div class="dropdown bootstrap-select default-select wide form-control dropup">
                            <select class="form-control" id="province" name="province">
                                <option value="{{ $university->address->province_id }}">
                                    {{ $university->address->province->name ?? 'Chọn Tỉnh/Thành phố' }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 m-b30">
                        <label class="form-label text-primary">Quận/Huyện</label>
                        <div class="dropdown bootstrap-select default-select wide form-control dropup">
                            <select class="form-control" id="district" name="district">
                                <option value="{{ $university->address->district_id }}">
                                    {{ $university->address->district->name ?? 'Chọn Quận/Huyện' }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 m-b30">
                        <label class="form-label text-primary">Phường/Xã</label>
                        <div class="dropdown bootstrap-select default-select wide form-control dropup">
                            <select class="form-control" id="ward" name="ward">
                                <option value="{{ $university->address->ward_id }}">
                                    {{ $university->address->ward->name ?? 'Chọn Phường/Xã' }}
                                </option>
                            </select>
                        </div>
                    </div>


                    {{-- Địa chỉ chi tiết --}}
                    <div class="col-sm-6 m-b30">
                        <label class="form-label required text-primary">Địa chỉ cụ thể</label>
                        <input type="text" class="form-control" id="university-specific-address" name="specific_address"
                            value="{{ $university->address->specific_address ?? '' }}">
                    </div>

                    <div class="col-sm-12 m-b30">
                        <label class="form-label required text-primary">Giới thiệu</label>
                        <textarea name="intro" rows="10" class="ckeditor" id="university-intro" cols="80">{{ $university->about ?? '' }}</textarea>
                    </div>
                    <div class="col-sm-12 m-b30">
                        <label class="form-label required text-primary">Mô tả</label>
                        <textarea name="description" rows="10" class="ckeditor" id="university-des" cols="80">{{ $university->description ?? '' }}</textarea>
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
