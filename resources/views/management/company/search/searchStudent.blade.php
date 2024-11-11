@extends('management.layout.main')
<!-- <div class="container-fluid">
    <div class="page-titles">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Employee Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Employee</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div>
                <a href="/company/manager-employe" class="btn btn-sm btn-primary mb-4">Employee List</a>
            </div>
            <div class="card h-auto">
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="employeeId" class="form-label">Employee ID</label>
                            <input type="text" class="form-control" id="employeeId" placeholder="Employee ID" readonly> 
                        </div>
                        <div class="mb-3">
                            <label for="Name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="Name" placeholder="First Name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" placeholder="Password">
						</div>
						<div class="mb-3">
							<label for="confirmPassword" class="form-label">Confirm Password</label>
							<input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
						</div>
                        <button type="submit" class="btn btn-primary">Update Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

<style>
    .search-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .search-bar .filter-item {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        background-color: #fff;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .search-bar .filter-item:hover {
        background-color: #e9ecef;
    }

    .search-bar input[type="text"] {
        flex-grow: 1;
        padding: 8px 12px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 14px;
        color: #495057;
    }

    .search-bar button {
        padding: 8px 15px;
        border: none;
        border-radius: 6px;
        background-color: #007bff;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .search-bar button:hover {
        background-color: #0056b3;
    }

    .search-bar .advanced-filter {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        background-color: #fff;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .search-bar .advanced-filter:hover {
        background-color: #e9ecef;
    }

    .filter-container {
        display: none;
        flex-wrap: wrap;
        gap: 10px;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .filter-container.visible {
        display: flex;
    }



    .col {
        margin-bottom: 50px;

    }
</style>
@section('content')

<div class="search-bar">
    <div class="filter-item">
        <i class="fas fa-list"></i>
        <span>Danh mục Nghề</span>
        <i class="fas fa-chevron-down"></i>
    </div>
    <input type="text" placeholder="Tên sinh viên">
    <div class="filter-item">
    <i class="fas fa-birthday-cake"></i>
<span>Năm sinh</span>
<i class="fas fa-chevron-down"></i>

    </div>
    <button>Tìm kiếm</button>
    <div class="advanced-filter">
        <i class="fas fa-filter"></i>
        <span>Lọc nâng cao</span>
        <i class="fas fa-chevron-up"></i>
    </div>
</div>

<div class="filter-container">
    <div class="filter-item">
        <i class="fas fa-building"></i>
        <span>Lĩnh vực công ty</span>
        <select class="form-select select2" >
            <option value="">Chọn lĩnh vực</option>
            <option value="IT">Công nghệ thông tin</option>
            <option value="Finance">Tài chính</option>
            <option value="Marketing">Marketing</option>
        </select>
    </div>
    <div class="filter-item">
        <i class="fas fa-star"></i>
        <span>Kinh nghiệm</span>
        <select class="form-select select2" multiple="multiple">
            <option value="">Chọn kinh nghiệm</option>
            <option value="0-1">0-1 năm</option>
            <option value="2-3">2-3 năm</option>
            <option value="4+">4+ năm</option>
        </select>
    </div>
    <div class="filter-item">
        <i class="fas fa-dollar-sign"></i>
        <span>Mức lương</span>
        <select class="form-select select2" multiple="multiple">
            <option value="">Chọn mức lương</option>
            <option value="10k-20k">10k - 20k</option>
            <option value="20k-30k">20k - 30k</option>
            <option value="30k+">30k+</option>
        </select>
    </div>
    <div class="filter-item">
        <i class="fas fa-star"></i>
        <span>Cấp bậc</span>
        <select class="form-select select2" multiple="multiple">
            <option value="">Chọn cấp bậc</option>
            <option value="Junior">Junior</option>
            <option value="Mid">Mid</option>
            <option value="Senior">Senior</option>
        </select>
    </div>
    <div class="filter-item">
        <i class="fas fa-briefcase"></i>
        <span>Hình thức</span>
        <select class="form-select select2" multiple="multiple">
            <option value="">Chọn hình thức</option>
            <option value="Fulltime">Toàn thời gian</option>
            <option value="Parttime">Bán thời gian</option>
            <option value="Freelance">Freelancer</option>
        </select>
    </div>
    <div class="filter-item">
        <i class="fas fa-building"></i>
        <span>Loại công ty</span>
        <select class="form-select select2" multiple="multiple">
            <option value="">Chọn loại công ty</option>
            <option value="Startup">Khởi nghiệp</option>
            <option value="Enterprise">Doanh nghiệp</option>
            <option value="Corporation">Tập đoàn</option>
        </select>
    </div>
</div>

<div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0 table-striped order-table">
                        <thead>
                            <tr>
                                <th class=" pe-3">
                                    <div class="form-check custom-checkbox mx-2">
                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th class=" ps-5" style="min-width: 200px;">Billing Address
                                </th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @include('management.company.search.tableStudent')

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const advancedFilter = document.querySelector('.advanced-filter');
        const filterContainer = document.querySelector('.filter-container');
        const chevronIcon = advancedFilter.querySelector('.fas');

        advancedFilter.addEventListener('click', function() {
            filterContainer.classList.toggle('visible');

            if (filterContainer.classList.contains('visible')) {
                chevronIcon.classList.remove('fa-chevron-up');
                chevronIcon.classList.add('fa-chevron-down');
            } else {
                chevronIcon.classList.remove('fa-chevron-down');
                chevronIcon.classList.add('fa-chevron-up');
            }
        });
    });
  
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Chọn một lựa chọn", 
            allowClear: true // Cho phép xóa lựa chọn
        });
    });
</script>


@endsection