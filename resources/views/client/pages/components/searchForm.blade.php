<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <form action="{{ route('search') }}" method="get">
        <div class="jp_header_form_wrapper">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <input type="text" name="key_search"
                       placeholder="Từ khoá, ví dụ: (Tên công việc, kỹ năng)"
                       value="{{ old('key_search') }}">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="jp_form_location_wrapper">
                    <select name="province_id" class="form-select single-select" style="width:100%;">
                        <option value="">Chọn tỉnh/thành phố</option>
                        @foreach($getProvince as $province)
                            <option value="{{ $province->id }}"
                                    @if(old('province_id') == $province->id) selected @endif>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="jp_form_exper_wrapper">
                    <select name="major_id" class="form-select single-select">
                        <option value="">Chọn chuyên ngành</option>
                        @foreach($getMajor as $name => $id)
                            <option value="{{ $id }}"
                                    @if(old('major_id') == $id) selected @endif>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <div class="jp_form_btn_wrapper">
                    <ul>
                        <li>
                            <button type="submit" class="btn"
                                    style="background-color: #23c0e9; height: 50px; border-radius: 11px; width: 80px">
                                <i class="fa fa-search"></i> Tìm
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

