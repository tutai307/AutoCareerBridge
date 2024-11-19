@extends('management.layout.main')

@section('content')
<div class="filter cm-content-box box-primary">
<div class="cm-content-body form excerpt" style="">
     <form action="/company/searchUniversity" method="GET">
        <div class="card-body">

            <div class="row">
                <div class="col-xl-3 col-sm-6" >
                    <label  class="form-label">Tên</label>
                    <input value="{{ request('searchName') }}"  type="text" class="form-control mb-xl-0 mb-3" name="searchName" id="searchName" placeholder="Tên trường" >
                </div>
                <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                    <label class="form-label">Tỉnh</label>
                    <select name="searchProvince" id="provinces" class="form-control default-select h-auto wide "
                        aria-label="Default select example">
                        <option value=""  selected>Địa Điểm</option>
                        @foreach($provinces as $province)
                        <option value="{{$province->id}}" {{ request('searchProvince') == $province->id ? 'selected' : '' }}>{{$province->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-3 col-sm-6 align-self-end">
                    <div>
                        <button  class="btn btn-primary me-2" title="Click here to Search" type="submit" id="searchButton"><i class="fa-sharp fa-solid fa-filter me-2"></i>Tìm kiếm</button>
                        <a href="/company/searchUniversity"><button class="btn btn-danger light" title="Click here to remove filter" type="button" id="removeFilter">Xóa tìm kiếm</button></a>
                    </div>
                </div>

            </div>
        </div>
        </form>
    </div>
    
</div>


<div><h3>
    Danh sách trường học
</h3></div>

@include('company.search.tableUniversity')
<div id="pagination" class="mt-4 d-flex justify-content-between align-items-center">
        <p></p>
        {{ $universities->links('pagination::bootstrap-4') }}
    </div>
@endsection