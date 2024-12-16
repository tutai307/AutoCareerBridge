@php
    $userName = '';

    if (Auth::guard('admin')->check()) {
        if (Auth::guard('admin')->user()->role === ROLE_ADMIN) {
            $userName = Str::limit(Auth::guard('admin')->user()->user_name, 20);
        } elseif (Auth::guard('admin')->user()->role === ROLE_COMPANY) {
            $userName = Str::limit(Auth::guard('admin')->user()->company->name ?? 'No company name', 20);
        } elseif (Auth::guard('admin')->user()->role === ROLE_UNIVERSITY) {
            $userName = Str::limit(Auth::guard('admin')->user()->university->name ?? 'No university name', 20);
        } elseif (Auth::guard('admin')->user()->role === ROLE_SUB_UNIVERSITY) {
            $userName = Str::limit(Auth::guard('admin')->user()->user_name ?? 'No username', 20);
        } elseif (Auth::guard('admin')->user()->role === ROLE_SUB_ADMIN) {
            $userName = Str::limit(Auth::guard('admin')->user()->user_name ?? 'No username', 20);
        } elseif (Auth::guard('admin')->user()->role === ROLE_HIRING) {
            $userName = Str::limit(Auth::guard('admin')->user()->hirings->name ?? 'No hiring name', 20);
        } else {
            $userName = Str::limit('Unknown Role', 20);
        }
    } else {
        $userName = 'Guest';
    }
@endphp
<div class="jp_top_header_img_wrapper">
    <div class="jp_slide_img_overlay"></div>
    <div class="gc_main_menu_wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-xs hidden-sm full_width">
                    <div class="gc_header_wrapper justify-content-end">
                        <div class="gc_header float-end">
                            <a href="{{ route('home') }}"><img src=" {{ asset('clients/images/header/logo.png') }}"
                                    alt="Logo" title="Job Pro" class="img-responsive"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12 center_responsive">
                    <div class="gc_header_wrapper header-area hidden-menu-bar stick" id="sticker">
                        <!-- mainmenu start -->
                        <div class="mainmenu">
                            <ul class="gc_main_navigation">
                                <li class="has-mega gc_main_navigation"><a href="#" class="gc_main_navigation">
                                        Home&nbsp;<i class="fa fa-angle-down"></i></a>
                                    <!-- mega menu start -->
                                    <ul>
                                        <li class="parent"><a href="index.html">Home1</a></li>
                                        <li class="parent"><a href="index_II.html">Home2</a></li>
                                        <li class="parent"><a href="index_map.html">Home3</a></li>
                                        <li class="parent"><a href="index_iv.html">Home4</a></li>
                                        <li class="parent"><a href="index_v.html">Home5</a></li>
                                        <li class="parent"><a href="index_vi.html">Home6</a></li>
                                    </ul>
                                </li>
                                <li class="has-mega gc_main_navigation"><a href="#" class="gc_main_navigation">
                                        Việc làm&nbsp;<i class="fa fa-angle-down"></i></a>
                                    <!-- mega menu start -->
                                    <ul>
                                        <li class="parent"><a href="listing_right.html">Tìm việc làm</a></li>
                                        <li class="parent"><a href="listing_single.html">Việc làm mới</a></li>
                                    </ul>
                                </li>

                                <li class="has-mega gc_main_navigation"><a href="#" class="gc_main_navigation">
                                        Pages&nbsp;<i class="fa fa-angle-down"></i></a>
                                    <!-- mega menu start -->
                                    <ul>
                                        <li class="parent"><a href="about.html">About-Us</a></li>
                                        <li class="parent"><a href="404_error.html">404</a></li>
                                        <li class="parent"><a href="add_postin.html">Add-Posting</a></li>
                                        <li class="parent"><a href="login.html">Login</a></li>
                                        <li class="parent"><a href="register.html">Register</a></li>
                                        <li class="parent"><a href="pricing.html">Pricing</a></li>
                                    </ul>
                                </li>
                                <li class="has-mega gc_main_navigation"><a href="#" class="gc_main_navigation">
                                        Blog&nbsp;<i class="fa fa-angle-down"></i></a>
                                    <!-- mega menu start -->
                                    <ul>
                                        <li class="parent"><a href="blog_left.html">Blog-Left</a></li>
                                        <li class="parent"><a href="blog_right.html">Blog-Right</a></li>
                                        <li class="parent"><a href="blog_single_left.html">Blog-Single-Left</a></li>
                                        <li class="parent"><a href="blog_single_right.html">Blog-Single-Right</a></li>

                                    </ul>
                                </li>
                                @if(Auth::guard('admin')->check())
                                    @if(Auth::guard('admin')->user()->role === ROLE_COMPANY)
                                        <li class="gc_main_navigation parent {{ Request::routeIs('listUniversity') ? 'active' : '' }}">
                                            <a href="{{ route('listUniversity') }}" class="gc_main_navigation">Trường
                                                học</a>
                                        </li>

                                    @elseif(Auth::guard('admin')->user()->role === ROLE_UNIVERSITY)
                                        <li class="gc_main_navigation parent {{ Request::routeIs('listCompany') ? 'active' : '' }}">
                                            <a href="{{ route('listCompany') }}" class="gc_main_navigation">Doanh
                                                nghiệp</a>
                                        </li>
                                    @else
                                        <li class="gc_main_navigation parent {{ Request::routeIs('listCompany') ? 'active' : '' }}">
                                            <a href="{{ route('listCompany') }}" class="gc_main_navigation">Doanh
                                                nghiệp</a>
                                        </li>
                                        <li class="gc_main_navigation parent {{ Request::routeIs('listUniversity') ? 'active' : '' }}">
                                            <a href="{{ route('listUniversity') }}" class="gc_main_navigation">Trường
                                                học</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="gc_main_navigation parent {{ Request::routeIs('listCompany') ? 'active' : '' }}">
                                        <a href="{{ route('listCompany') }}" class="gc_main_navigation">Doanh nghiệp</a>
                                    </li>
                                    <li class="gc_main_navigation parent {{ Request::routeIs('listUniversity') ? 'active' : '' }}">
                                        <a href="{{ route('listUniversity') }}" class="gc_main_navigation">Trường
                                            học</a>
                                    </li>
                                    @endif
                                

                                <li>
                                    <div id="search_open" class="gc_search_box">
                                        <input type="text" placeholder="Search here">
                                        <button><i class="fa fa-search" aria-hidden="false"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- mainmenu end -->


                        <!-- mobile menu area start -->
                        <header class="mobail_menu">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6">
                                        <div class="gc_logo">
                                            <a href="{{ route('home') }}"><img
                                                    src="{{ asset('clients/images/header/logo.png') }}"
                                                    alt="Logo" title="Grace Church"></a>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6">
                                        <div class="cd-dropdown-wrapper">
                                            <a class="house_toggle" href="#0">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Capa_1"
                                                    x="0px" y="0px" viewBox="0 0 31.177 31.177"
                                                    style="enable-background:new 0 0 31.177 31.177;"
                                                    xml:space="preserve" width="25px" height="25px">
                                                    <g>
                                                        <g>
                                                            <path class="menubar"
                                                                d="M30.23,1.775H0.946c-0.489,0-0.887-0.398-0.887-0.888S0.457,0,0.946,0H30.23    c0.49,0,0.888,0.398,0.888,0.888S30.72,1.775,30.23,1.775z"
                                                                fill="#ffffff" />
                                                        </g>
                                                        <g>
                                                            <path class="menubar"
                                                                d="M30.23,9.126H12.069c-0.49,0-0.888-0.398-0.888-0.888c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,8.729,30.72,9.126,30.23,9.126z"
                                                                fill="#ffffff" />
                                                        </g>
                                                        <g>
                                                            <path class="menubar"
                                                                d="M30.23,16.477H0.946c-0.489,0-0.887-0.398-0.887-0.888c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,16.079,30.72,16.477,30.23,16.477z"
                                                                fill="#ffffff" />
                                                        </g>
                                                        <g>
                                                            <path class="menubar"
                                                                d="M30.23,23.826H12.069c-0.49,0-0.888-0.396-0.888-0.887c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,23.43,30.72,23.826,30.23,23.826z"
                                                                fill="#ffffff" />
                                                        </g>
                                                        <g>
                                                            <path class="menubar"
                                                                d="M30.23,31.177H0.946c-0.489,0-0.887-0.396-0.887-0.887c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.398,0.888,0.888C31.118,30.78,30.72,31.177,30.23,31.177z"
                                                                fill="#ffffff" />
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                            <nav class="cd-dropdown">
                                                <h2><a href="#">Job<span>Pro</span></a></h2>
                                                <a href="#0" class="cd-close">Close</a>
                                                <ul class="cd-dropdown-content">
                                                    <li>
                                                        <form class="cd-search">
                                                            <input type="search" placeholder="Search...">
                                                        </form>
                                                    </li>
                                                    <li class="has-children">
                                                        <a href="#">Home</a>
                                                        <ul class="cd-secondary-dropdown is-hidden">
                                                            <li class="go-back"><a href="#0">Menu</a></li>
                                                            <li><a href="index.html">Home1</a></li>
                                                            <li><a href="index_II.html">Home2</a></li>
                                                            <li><a href="index_map.html">Home3</a></li>
                                                            <li><a href="index_iv.html">Home4</a></li>
                                                            <li><a href="index_v.html">Home5</a></li>
                                                            <li><a href="index_vi.html">Home6</a></li>
                                                            <!-- .has-children -->
                                                        </ul>
                                                        <!-- .cd-secondary-dropdown -->
                                                    </li>
                                                    <!-- .has-children -->
                                                    <li class="has-children">
                                                        <a href="#">Listing</a>

                                                        <ul class="cd-secondary-dropdown is-hidden">
                                                            <li class="go-back"><a href="#0">Menu</a></li>
                                                            <li>
                                                                <a href="listing_left.html">listing-Left</a>
                                                            </li>
                                                            <!-- .has-children -->
                                                            <li>
                                                                <a href="listing_right.html">listing-Right</a>
                                                            </li>
                                                            <!-- .has-children -->

                                                            <li>
                                                                <a href="listing_single.html">listing-Single</a>
                                                            </li>
                                                            <!-- .has-children -->

                                                        </ul>
                                                        <!-- .cd-secondary-dropdown -->
                                                    </li>
                                                    <!-- .has-children -->
                                                    <li class="has-children">
                                                        <a href="#">Pages</a>

                                                        <ul class="cd-secondary-dropdown is-hidden">
                                                            <li class="go-back"><a href="#0">Menu</a></li>
                                                            <li><a href="about.html">About-Us</a></li>
                                                            <li><a href="404_error.html">404</a></li>
                                                            <li><a href="add_postin.html">Add-Posting</a></li>
                                                            <li><a href="login.html">Login</a></li>
                                                            <li><a href="register.html">Register</a></li>
                                                            <li><a href="pricing.html">Pricing</a></li>
                                                            <!-- .has-children -->
                                                        </ul>
                                                        <!-- .cd-secondary-dropdown -->
                                                    </li>
                                                    <!-- .has-children -->
                                                    <li class="has-children">
                                                        <a href="#">Blog</a>

                                                        <ul class="cd-secondary-dropdown is-hidden">
                                                            <li class="go-back"><a href="#0">Menu</a></li>
                                                            <li>
                                                                <a href="blog_left.html">Blog-Left</a>
                                                            </li>
                                                            <!-- .has-children -->
                                                            <li>
                                                                <a href="blog_right.html">Blog-Right</a>
                                                            </li>
                                                            <!-- .has-children -->
                                                            <li>
                                                                <a href="blog_single_left.html">Blog-Single-Left</a>
                                                            </li>
                                                            <!-- .has-children -->
                                                            <li>
                                                                <a href="blog_single_right.html">Blog-Single-Left</a>
                                                            </li>
                                                            <!-- .has-children -->
                                                        </ul>
                                                        <!-- .cd-secondary-dropdown -->
                                                    </li>
                                                    <!-- .has-children -->
                                                    <li>
                                                        <a href="contact.html">Contact</a>
                                                    </li>
                                                    <li>
                                                        <a href="register.html">Sign Up</a>
                                                    </li>
                                                    <li>
                                                        <a href="login.html">Login</a>
                                                    </li>
                                                </ul>
                                                <!-- .cd-dropdown-content -->
                                            </nav>
                                            <!-- .cd-dropdown -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .cd-dropdown-wrapper -->
                        </header>
                    </div>
                </div>
                <!-- mobile menu area end -->
                <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 hidden-xs hidden-sm full_width">
                    <div class="jp_navi_right_btn_wrapper float-end ">
                        <ul class="gc_header_wrapper menu-item dropdown ">
                            @if (Auth::guard('admin')->user())
                                <a href="javascript:void(0);" role="button" class="menu-link"
                                    data-bs-toggle="dropdown" aria-expanded="false">

                                    <li class="gc_main_navigation d-inline-flex">
                                        <p class="gc_main_navigation m-3">
                                            {{ $userName }}
                                        </p>
                                        <div class="img_thumb">
                                            @if (Auth::guard('admin')->user()->role === ROLE_ADMIN)
                                                <div id="avatar" class="avatar"></div>
                                            @elseif (Auth::guard('admin')->user()->role === ROLE_COMPANY && optional(Auth::guard('admin')->user()->company)->avatar_path)
                                                <img class="img_thumb_item"
                                                    src="{{ asset(Auth::guard('admin')->user()->company->avatar_path) }}"
                                                    alt="avatar">
                                            @elseif (Auth::guard('admin')->user()->role === ROLE_UNIVERSITY &&
                                                    optional(Auth::guard('admin')->user()->university)->avatar_path)
                                                <img class="img_thumb_item"
                                                    src="{{ asset('storage/' . Auth::guard('admin')->user()->university->avatar_path) }}"
                                                    alt="avatar">
                                            @elseif (Auth::guard('admin')->user()->role === ROLE_SUB_ADMIN)
                                                <div id="avatar" class="avatar"></div>
                                            @elseif (Auth::guard('admin')->user()->role === ROLE_HIRING && optional(Auth::guard('admin')->user()->hirings)->avatar_path)
                                                <img class="img_thumb_item"
                                                    src="{{ asset(Auth::guard('admin')->user()->hirings->avatar_path) }}"
                                                    alt="avatar">
                                            @else
                                                <div id="avatar" class="avatar"></div>
                                            @endif

                                        </div>
                                    </li>
                                </a>
                                <div class="dropdown-menu">
                                    @if (Auth::guard('admin')->user()->role === ROLE_COMPANY)
                                        <a href="{{ route('company.profile') }}" class="dropdown-item"><i
                                                class="fas fa-user-circle"></i>
                                            {{ __('label.admin.header.profile') }}</a>
                                    @elseif (Auth::guard('admin')->user()->role === ROLE_UNIVERSITY)
                                        <a href="{{ route('university.profile') }}" class="dropdown-item"><i
                                                class="fas fa-user-circle"></i>
                                            {{ __('label.admin.header.profile') }}</a>
                                    @endif

                                    <a href="" class="dropdown-item"> <i class="fas fa-bell"></i>
                                        {{ __('label.admin.header.notification') }}</a>
                                    <form action="{{ route('management.logout', Auth::guard('admin')->user()->id) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item logout-button"><i
                                                class="fas fa-sign-out-alt"></i>{{ __('label.admin.header.logout') }}
                                        </button>
                                    </form>
                                </div>
                            @else
                                <li><a href="{{ route('management.register') }}"><i class="fa fa-user"></i>&nbsp;
                                        SIGN
                                        UP</a></li>
                                <li><a href="{{ route('management.login') }}"><i class="fa fa-sign-in"></i>&nbsp;
                                        LOGIN</a>
                                </li>
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Hàm tạo màu HEX ngẫu nhiên
    function getRandomColor() {
        return '#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0');
    }

    // Lấy chữ cái đầu tiên từ tên
    const name = "{{ $userName }}"; // Truyền tên từ PHP vào JavaScript
    const firstLetter = name.charAt(0); // Lấy chữ cái đầu tiên

    // Thêm chữ cái đầu tiên vào ảnh đại diện
    const avatarElement = document.getElementById("avatar");
    avatarElement.textContent = firstLetter;

    // Gán màu nền ngẫu nhiên
    avatarElement.style.backgroundColor = getRandomColor();
</script>
