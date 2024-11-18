<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li ><a  href="{{route('admin.dashboard')}}" aria-expanded="false">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a  href="{{route('admin.jobs.index')}}" aria-expanded="false">
                    <i class="fa-solid fa-briefcase"></i>
                    <span class="nav-text">Bài tuyển dụng</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.workshops.index') }}" aria-expanded="false">
                    <i class="fa-solid fa-chalkboard-teacher"></i>
                    <span class="nav-text" >Workshops</span>
                </a>
            </li>

            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="material-icons">book
                    </i>
                    <span class="nav-text">Course</span>

                </a>
                <ul aria-expanded="false">
                    <li><a href="course-llisting.html">Course List</a></li>
                    <li><a href="course-details.html">Course Details</a></li>

                </ul>
            </li>


            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="fa-solid fa-users"></i>
                    <span class="nav-text">Tài khoản</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.users.create') }}">Thêm mới</a></li>
                    <li><a href="{{ route('admin.users.index') }}">Danh sách</a></li>
                </ul>
            </li>
        </ul>

    </div>
</div>
