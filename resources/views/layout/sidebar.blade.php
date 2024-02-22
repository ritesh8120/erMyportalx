<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">{{ __('labels.dashboard') }}</span>
            </a>
        </li>
        @if(Auth::check() && Auth::user()->role == App\Models\User::ADMIN)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('employee.index') }}">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">{{ __('labels.manage_employee') }}</span>
            </a>
        </li>
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" href="{{ route('task.index') }}">-->
        <!--        <i class="menu-icon mdi mdi-account-circle-outline"></i>-->
        <!--        <span class="menu-title">{{ __('labels.manage_task') }}</span>-->
        <!--    </a>-->
        <!--</li>-->
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('timelog.index') }}">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">{{ __('labels.timesheet') }}</span>
            </a>
        </li>
        {{-- <li class="nav-item nav-category">UI Elements</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="pages/ui-features/buttons.html">Buttons</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="pages/ui-features/typography.html">Typography</a></li>
                </ul>
            </div>
        </li> --}}
    </ul>
</nav>