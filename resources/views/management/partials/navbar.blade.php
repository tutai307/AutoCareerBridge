<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li ><a  href="javascript:void(0);" aria-expanded="false">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-text">Dashboard</span>

                </a>
            </li>
            <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="material-icons">folder</i>
                    <span class="nav-text">File Manager</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="file-manager.html">File Manager</a></li>
                    <li><a href="user.html">User</a></li>
                    <li><a href="calendar.html">Calendar</a></li>
                    <li><a href="to-do-list.html">To Do List</a></li>
                    <li><a href="chat.html">Chat</a></li>
                    <li><a href="activity.html">Activity</a></li>
                </ul>
            </li>
            <li><a href="/company/manage-hiring" class="{{ request()->is('/company/manage_hiring') ? 'active' : '' }}">Quản lý nhân viên</a>
            </li>
            <li><a href="/company/search-university" class="{{ request()->is('/company/search-university') ? 'active' : '' }}">Tìm kiếm trường học</a>
            </li>
           
        </ul>
      
    </div>
</div>
