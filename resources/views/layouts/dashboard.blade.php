@if(Request::ajax())
@if(isset($_GET['t_optimized']))
@yield('t_optimized')
@elseif(isset($_GET['ta_optimized']))
@yield('ta_optimized')
@else
        <!-- end page title -->
        @yield('content')
@endif
@include('common.essential_js')

<style>
    .displayContent {
        display: block !important;
    }
</style>
@else
<!DOCTYPE html>
<html lang="en">
<head>
    <!--  Title -->
    <title>{{ $page_title ?? 'Wakili CRM' }}</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ url('backend/images/logos/favicon.ico') }}" />
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ url( 'backend/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">

    <!-- Core Css -->
    <link  id="themeColors"  rel="stylesheet" href="{{ url('backend/css/style.min.css')  }}" />
  @yield('styles')
    <script src="{{ url('backend/libs/jquery/dist/jquery.min.js') }}"></script>

</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <img src="{{ url('backend/images/logos/favicon.ico') }}" alt="loader" class="lds-ripple img-fluid" />
</div>
<!-- Preloader -->
<div class="preloader">
    <img src="{{ url('backend/images/logos/favicon.ico') }}" alt="loader" class="lds-ripple img-fluid" />
</div>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
    <aside class="left-sidebar">

        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="/" class="text-nowrap logo-img">
                    <img src="{{ url('backend') }}/images/logos/dark-logo.svg" class="dark-logo" width="180" alt="" />
                    <img src="{{ url('backend') }}/images/logos/light-logo.svg" class="light-logo"  width="180" alt="" />
                </a>
                <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8 text-muted"></i>
                </div>
            </div>

            <hr>

            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar>
                <ul id="sidebarnav">

                    <!-- ============================= -->
                    <!-- Home -->
                    <!-- ============================= -->
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>

                    <!-- =================== -->
                    <!-- Dashboard -->
                    <!-- =================== -->
                    @isset($real_menus)
                        @foreach($real_menus as $menu)
                            @if($menu->type=='single' && @$menu->menus)
                                <li class="sidebar-item">
                                    <a class="sidebar-link load-page"  href="{{ url($menu->menus->url) }}" aria-expanded="false">
                                      <span>
                                        <i class="ti {{ $menu->menus->icon }}"></i>
                                      </span>
                                        <span class="hide-menu">{{ $menu->menus->label }}</span>
                                    </a>
                                </li>
                            @elseif($menu->type=='many')

                                <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow" href="#{{$menu->slug}}" aria-expanded="false">
                                      <span class="d-flex">
                                        <i class="ti {{$menu->icon}}"></i>
                                      </span>
                                        <span class="hide-menu">{{ $menu->label }} </span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse first-level">
                                        @foreach($menu->children as $drop)
                                            @if($drop->label)
                                            <li class="sidebar-item">
                                                <a href="{{ url($drop->url) }}" class="sidebar-link load-page">
                                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-circle"></i>
                                                    </div>
                                                    <span class="hide-menu">{{ $drop->label }}</span>
                                                </a>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    @endisset


                </ul>

            </nav>
            <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
                <div class="hstack gap-3">
                    <div class="john-img">
                        <img src="{{ url('backend') }}/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" alt="">
                    </div>
                    <div class="john-title">
                        <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                        <span class="fs-2 text-dark">Designer</span>
                    </div>
                    <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                        <i class="ti ti-power fs-6"></i>
                    </button>
                </div>
            </div>
            <!-- End Sidebar navigation -->

        </div>
        <!-- End Sidebar scroll-->

    </aside>
    <!--  Sidebar End -->

    <!--  Main wrapper -->
    <div class="body-wrapper">

        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="ti ti-search"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav quick-links d-none d-lg-flex">
                    <li class="nav-item dropdown-hover d-none d-lg-block">
                        <a class="nav-link" href="app-chat.html">Chat</a>
                    </li>
                    <li class="nav-item dropdown-hover d-none d-lg-block">
                        <a class="nav-link" href="{{ url('admin/calendar') }}">Calendar</a>
                    </li>
                    <li class="nav-item dropdown-hover d-none d-lg-block">
                        <a class="nav-link" href="app-email.html">Email</a>
                    </li>
                </ul>

                <div class="d-block d-lg-none">
                    <img src="{{ url('backend') }}/images/logos/dark-logo.svg" class="dark-logo" width="180" alt="" />
                    <img src="{{ url('backend') }}/images/logos/light-logo.svg" class="light-logo"  width="180" alt="" />
                </div>

                <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
              </span>
                </button>

               @auth()
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                            <i class="ti ti-align-justified fs-7"></i>
                        </a>

                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">

                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-bell-ringing"></i>
                                    <div class="notification bg-primary rounded-circle"></div>
                                </a>
                                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="d-flex align-items-center justify-content-between py-3 px-7">
                                        <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                                        <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm">5 new</span>
                                    </div>
                                    <div class="message-body" data-simplebar>
                                        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                          <span class="me-3">
                            <img src="{{ url('backend') }}/images/profile/user-1.jpg" alt="user" class="rounded-circle" width="48" height="48" />
                          </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">Roman Joined the Team!</h6>
                                                <span class="d-block">Congratulate him</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                          <span class="me-3">
                            <img src="{{ url('backend') }}/images/profile/user-2.jpg" alt="user" class="rounded-circle" width="48" height="48" />
                          </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">New message</h6>
                                                <span class="d-block">Salma sent you new message</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                          <span class="me-3">
                            <img src="{{ url('backend') }}/images/profile/user-3.jpg" alt="user" class="rounded-circle" width="48" height="48" />
                          </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">Bianca sent payment</h6>
                                                <span class="d-block">Check your earnings</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                          <span class="me-3">
                            <img src="{{ url('backend') }}/images/profile/user-4.jpg" alt="user" class="rounded-circle" width="48" height="48" />
                          </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">Jolly completed tasks</h6>
                                                <span class="d-block">Assign her new tasks</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                          <span class="me-3">
                            <img src="{{ url('backend') }}/images/profile/user-5.jpg" alt="user" class="rounded-circle" width="48" height="48" />
                          </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">John received payment</h6>
                                                <span class="d-block">$230 deducted from account</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                          <span class="me-3">
                            <img src="{{ url('backend') }}/images/profile/user-1.jpg" alt="user" class="rounded-circle" width="48" height="48" />
                          </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">Roman Joined the Team!</h6>
                                                <span class="d-block">Congratulate him</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="py-6 px-7 mb-1">
                                        <button class="btn btn-outline-primary w-100"> See All Notifications </button>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="d-flex align-items-center">
                                        <div class="user-profile-img">
                                            <img src="{{ url('backend') }}/images/profile/user-1.jpg" class="rounded-circle" width="35" height="35" alt="" />
                                        </div>
                                    </div>
                                </a>

                                <!-- user profile -->
                                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                                    <div class="profile-dropdown position-relative" data-simplebar>
                                        <div class="py-3 px-7 pb-0">
                                            <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                        </div>
                                        <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                            <img src="{{ url('backend') }}/images/profile/user-1.jpg" class="rounded-circle" width="80" height="80" alt="" />
                                            <div class="ms-3">
                                                @auth()
                                                <h5 class="mb-1 fs-3">{{ auth()->user()->name }}</h5>

                                                <span class="mb-1 d-block text-dark">Administrator</span>
                                                <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                                    <i class="ti ti-mail fs-4"></i> {{ auth()->user()->email }}
                                                </p>
                                                @endauth
                                            </div>
                                        </div>
                                        <div class="message-body">
                                            <a href="page-user-profile.html" class="py-8 px-7 mt-8 d-flex align-items-center">
                            <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                              <img src="{{ url('backend') }}/images/svgs/icon-account.svg" alt="" width="24" height="24">
                            </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                                                    <span class="d-block text-dark">Account Settings</span>
                                                </div>
                                            </a>
                                            <a href="{{ url('settings') }}" class="py-8 px-7 mt-8 d-flex align-items-center">
                            <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                              <img src="{{ url('backend') }}/images/svgs/icon-briefcase.svg" alt="" width="24" height="24">
                            </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h6 class="mb-1 bg-hover-primary fw-semibold"> Settings </h6>
                                                    <span class="d-block text-dark">System Settings</span>
                                                </div>
                                            </a>
                                            <a href="app-email.html" class="py-8 px-7 d-flex align-items-center">
                            <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                              <img src="{{ url('backend') }}/images/svgs/icon-inbox.svg" alt="" width="24" height="24">
                            </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h6 class="mb-1 bg-hover-primary fw-semibold">My Inbox</h6>
                                                    <span class="d-block text-dark">Messages & Emails</span>
                                                </div>
                                            </a>
                                            <a href="app-notes.html" class="py-8 px-7 d-flex align-items-center">
                            <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                              <img src="{{ url('backend') }}/images/svgs/icon-tasks.svg" alt="" width="24" height="24">
                            </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h6 class="mb-1 bg-hover-primary fw-semibold">My Task</h6>
                                                    <span class="d-block text-dark">To-do and Daily Tasks</span>
                                                </div>
                                            </a>
                                            <a href="{{ url('user-reg') }}" class="py-8 px-7 d-flex align-items-center">
                            <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                              <img src="{{ url('backend') }}/images/svgs/icon-tasks.svg" alt="" width="24" height="24">
                            </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h6 class="mb-1 bg-hover-primary fw-semibold">Settings</h6>
                                                    <span class="d-block text-dark">Register New User</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-grid py-4 px-7 pt-8">
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();  document.getElementById('logout-form').submit();" class="btn btn-outline-primary">Log Out</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth

            </nav>
        </header>
        <!--  Header End -->
        <div class="container-fluid system-container">


            @yield('content')

        </div>
    </div>
</div>


<!--  Search Bar -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content rounded-1">
            <div class="modal-header border-bottom">
                <input type="search" class="form-control fs-3" placeholder="Search here" id="search" />
                <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
              <i class="ti ti-x fs-5 ms-3"></i>
            </span>
            </div>
            <div class="modal-body message-body" data-simplebar="">
                <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
                <ul class="list mb-0 py-2">
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Modern</span>
                            <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                            <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                            <span class="fs-3 text-muted d-block">/apps/contacts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Posts</span>
                            <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Detail</span>
                            <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Shop</span>
                            <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Modern</span>
                            <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                            <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                            <span class="fs-3 text-muted d-block">/apps/contacts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Posts</span>
                            <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Detail</span>
                            <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="page-faq.html#">
                            <span class="fs-3 text-black fw-normal d-block">Shop</span>
                            <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--  Customizer -->
<button class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
    <i class="ti ti-settings fs-7" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Settings"></i>
</button>
<div class="offcanvas offcanvas-end customizer" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" data-simplebar="">
    <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
        <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Settings</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-4">
        <div class="theme-option pb-4">
            <h6 class="fw-semibold fs-4 mb-1">Theme Option</h6>
            <div class="d-flex align-items-center gap-3 my-3">
                <a href="javascript:void(0)"  onclick="toggleTheme('{{ url('backend') }}/css/style.min.css')"  class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 light-theme text-dark">
                    <i class="ti ti-brightness-up fs-7 text-primary"></i>
                    <span class="text-dark">Light</span>
                </a>
                <a href="javascript:void(0)" onclick="toggleTheme('{{ url('backend') }}/css/style-dark.min.css')" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 dark-theme text-dark">
                    <i class="ti ti-moon fs-7 "></i>
                    <span class="text-dark">Dark</span>
                </a>
            </div>
        </div>
        <div class="theme-direction pb-4">
            <h6 class="fw-semibold fs-4 mb-1">Theme Direction</h6>
            <div class="d-flex align-items-center gap-3 my-3">
                <a href="index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
                    <i class="ti ti-text-direction-ltr fs-6 text-primary"></i>
                    <span class="text-dark">LTR</span>
                </a>
                <a href="../rtl/index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
                    <i class="ti ti-text-direction-rtl fs-6 text-dark"></i>
                    <span class="text-dark">RTL</span>
                </a>
            </div>
        </div>
        <div class="theme-colors pb-4">
            <h6 class="fw-semibold fs-4 mb-1">Theme Colors</h6>
            <div class="d-flex align-items-center gap-3 my-3">
                <ul class="list-unstyled mb-0 d-flex gap-3 flex-wrap change-colors">
                    <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                        <a href="javascript:void(0)" class="rounded-circle position-relative d-block customizer-bgcolor skin1-bluetheme-primary active-theme " onclick="toggleTheme('{{ url('backend') }}/css/style.min.css')"  data-color="blue_theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="BLUE_THEME"><i class="ti ti-check text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                    </li>
                    <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                        <a href="javascript:void(0)"  class="rounded-circle position-relative d-block customizer-bgcolor skin2-aquatheme-primary " onclick="toggleTheme('{{ url('backend') }}/css/style-aqua.min.css')"  data-color="aqua_theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="AQUA_THEME"><i class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                    </li>
                    <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                        <a href="javascript:void(0)" class="rounded-circle position-relative d-block customizer-bgcolor skin3-purpletheme-primary" onclick="toggleTheme('{{ url('backend') }}/css/style-purple.min.css')"  data-color="purple_theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="PURPLE_THEME"><i class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                    </li>
                    <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                        <a href="javascript:void(0)" class="rounded-circle position-relative d-block customizer-bgcolor skin4-greentheme-primary" onclick="toggleTheme('{{ url('backend') }}/css/style-green.min.css')"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="GREEN_THEME"><i class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                    </li>
                    <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                        <a href="javascript:void(0)" class="rounded-circle position-relative d-block customizer-bgcolor skin5-cyantheme-primary" onclick="toggleTheme('{{ url('backend') }}/css/style-cyan.min.css')"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="CYAN_THEME"><i class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                    </li>
                    <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                        <a href="javascript:void(0)" class="rounded-circle position-relative d-block customizer-bgcolor skin6-orangetheme-primary" onclick="toggleTheme('{{ url('backend')  }}/css/style-orange.min.css')"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ORANGE_THEME"><i class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="layout-type pb-4">
            <h6 class="fw-semibold fs-4 mb-1">Layout Type</h6>
            <div class="d-flex align-items-center gap-3 my-3">
                <a href="index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
                    <i class="ti ti-layout-sidebar fs-6 text-primary"></i>
                    <span class="text-dark">Vertical</span>
                </a>
                <a href="../horizontal/index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
                    <i class="ti ti-layout-navbar fs-6 text-dark"></i>
                    <span class="text-dark">Horizontal</span>
                </a>
            </div>
        </div>
        <div class="container-option pb-4">
            <h6 class="fw-semibold fs-4 mb-1">Container Option</h6>
            <div class="d-flex align-items-center gap-3 my-3">
                <a href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 boxed-width text-dark">
                    <i class="ti ti-layout-distribute-vertical fs-7 text-primary"></i>
                    <span class="text-dark">Boxed</span>
                </a>
                <a href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 full-width text-dark">
                    <i class="ti ti-layout-distribute-horizontal fs-7"></i>
                    <span class="text-dark">Full</span>
                </a>
            </div>
        </div>
        <div class="sidebar-type pb-4">
            <h6 class="fw-semibold fs-4 mb-1">Sidebar Type</h6>
            <div class="d-flex align-items-center gap-3 my-3">
                <a  href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 fullsidebar">
                    <i class="ti ti-layout-sidebar-right fs-7"></i>
                    <span class="text-dark">Full</span>
                </a>
                <a  href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center text-dark sidebartoggler gap-2">
                    <i class="ti ti-layout-sidebar fs-7"></i>
                    <span class="text-dark">Collapse</span>
                </a>
            </div>
        </div>
        <div class="card-with pb-4">
            <h6 class="fw-semibold fs-4 mb-1">Card With</h6>
            <div class="d-flex align-items-center gap-3 my-3">
                <a href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 text-dark cardborder">
                    <i class="ti ti-border-outer fs-7"></i>
                    <span class="text-dark">Border</span>
                </a>
                <a href="javascript:void(0)" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 cardshadow">
                    <i class="ti ti-border-none fs-7"></i>
                    <span class="text-dark">Shadow</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!--  Customizer -->
<!--  Import Js Files -->
<script src="{{ url('backend/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ url('backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!--  core files -->
<script src="{{url("backend")}}/js/app.min.js"></script>
<script src="{{url("backend")}}/js/app.init.js"></script>
<script src="{{url("backend")}}/js/app-style-switcher.js"></script>
<script src="{{url("backend")}}/js/sidebarmenu.js"></script>

<script src="{{url("backend")}}/js/custom.js"></script>
<!--  current page js files -->
<script src="{{url("backend")}}/libs/owl.carousel/dist/owl.carousel.min.js"></script>
</body>
</html>

@endif
