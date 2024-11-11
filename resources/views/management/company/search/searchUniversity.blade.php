@extends('management.layout.main')
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
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.filter-container.visible {
    max-height: 300px; /* Adjust the height as needed */
}

.filter-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}


	.col{
		margin-bottom: 50px;

	}

</style>
@section('content')

<div class="search-bar">
        <!-- <div class="filter-item">
            <i class="fas fa-list"></i>
            <span>Danh mục Nghề</span>
            <i class="fas fa-chevron-down"></i>
        </div> -->
        <input type="text" placeholder="Tên trường học">
        <div class="filter-item">
            <i class="fas fa-map-marker-alt"></i>
            <span>Địa điểm</span>
            <i class="fas fa-chevron-down"></i>
        </div>
        <button>Tìm kiếm</button>
        <!-- <div class="advanced-filter">
            <i class="fas fa-filter"></i>
            <span>Lọc nâng cao</span>
            <i class="fas fa-chevron-up"></i>
        </div> -->
    </div>

    <!-- <div class="filter-container">
        <div class="filter-item">
            <i class="fas fa-building"></i>
            <span>Lĩnh vực công ty</span>
            <i class="fas fa-chevron-down"></i>
        </div>
        <div class="filter-item">
            <i class="fas fa-star"></i>
            <span>Kinh nghiệm</span>
            <i class="fas fa-chevron-down"></i>
        </div>
        <div class="filter-item">
            <i class="fas fa-dollar-sign"></i>
            <span>Mức lương</span>
            <i class="fas fa-chevron-down"></i>
        </div>
        <div class="filter-item">
            <i class="fas fa-star"></i>
            <span>Cấp bậc</span>
            <i class="fas fa-chevron-down"></i>
        </div>
        <div class="filter-item">
            <i class="fas fa-briefcase"></i>
            <span>Hình thức</span>
            <i class="fas fa-chevron-down"></i>
        </div>
        <div class="filter-item">
            <i class="fas fa-building"></i>
            <span>Loại công ty</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </div> -->
    @include('management.company.search.tableUniversity')
<!-- <script>
  document.addEventListener("DOMContentLoaded", function() {
    const advancedFilter = document.querySelector('.advanced-filter');
    const filterContainer = document.querySelector('.filter-container');
    const chevronIcon = advancedFilter.querySelector('.fas');

    advancedFilter.addEventListener('click', function() {
        filterContainer.classList.toggle('visible');
        
        // Toggle the chevron icon direction
        if (filterContainer.classList.contains('visible')) {
            chevronIcon.classList.remove('fa-chevron-up');
            chevronIcon.classList.add('fa-chevron-down');
        } else {
            chevronIcon.classList.remove('fa-chevron-down');
            chevronIcon.classList.add('fa-chevron-up');
        }
    });
});

</script> -->
@endsection