@extends('management.layout.main')

@section('content')
<div class="filter cm-content-box box-primary">
<div class="cm-content-body form excerpt" style="">
        <div class="card-body">
            <div class="row">

                <div class="col-xl-3 col-sm-6" >
                    <label  class="form-label">Tên</label>
                    <input  type="text" class="form-control mb-xl-0 mb-3" id="searchName" placeholder="Tên trường" >
                </div>
                <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                    <label class="form-label">Tỉnh</label>
                    <select id="provinces" class="form-control default-select h-auto wide "
                        aria-label="Default select example">
                        <option value="" selected>Địa Điểm</option>
                        @foreach($provinces as $province)
                        <option value="{{$province->id}}">{{$province->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-3 col-sm-6 align-self-end">
                    <div>
                        <button class="btn btn-primary me-2" title="Click here to Search" type="button" id="searchButton"><i class="fa-sharp fa-solid fa-filter me-2"></i>Tìm kiếm</button>
                        <button class="btn btn-danger light" title="Click here to remove filter" type="button" id="removeFilter">Xóa tìm kiếm</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</div>


<div><h3>
    Danh sách trường học
</h3></div>

@include('management.company.search.tableUniversity')
<script>
 $(document).ready(function() {
        $('#searchButton').click(function() {
            let searchName = $('#searchName').val();
            let selectedProvince = $('#provinces').val();
            console.log(selectedProvince); 
            console.log(searchName); 
            $.ajax({
                url: '/search-university', 
                method: 'GET',
                data: {
                    name: searchName,
                    province: selectedProvince
                },
                success: function(response) {
                    console.log(response); 
                    $('#resultContainer').html(response.html); 
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

    $('#removeFilter').click(function() {
            $('#searchName').val('');
            $('#searchEmail').val('');
            $('#searchDate').val('');
            window.location.reload();

        });
</script>
@endsection