@include('layout.header')
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <div class="me-3">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
            </div>
            <div>
                <a class="navbar-brand brand-logo" href="https://www.myportalx.com/">
                    MyportalX
                </a>
                <a class="navbar-brand brand-logo-mini" href="https://www.myportalx.com/">
                    My
                </a>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img class="img-xs rounded-circle" src="{{ asset('public/assets/images/faces/face8.jpg') }}"
                            alt="Profile image"> </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img class="img-md rounded-circle" src="{{ asset('public/assets/images/faces/face8.jpg') }}"
                                alt="Profile image">
                            <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
                            <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
                        </div>
                        <a class="dropdown-item"><i
                                class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                            Profile
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('layout.sidebar')
        <!-- partial -->
        <div class="main-panel">
            @yield('containt')
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"><a
                            href="https://www.myportalx.com/" target="_blank">MyportalX</a></span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2024. All
                        rights reserved.</span>
                </div>
            </footer>
        </div>
        <!-- partial -->
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
@stack('script')
<!-- container-scroller -->
@include('layout.footer')
