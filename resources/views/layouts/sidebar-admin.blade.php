<!-- Main sidebar -->
<div class="sidebar sidebar-dark primary-background sidebar-main sidebar-expand-lg">
    <div class="navbar navbar-dark secondary-background bg-dark-100 navbar-static border-0">
        <div class="navbar-brand flex-fill wmin-0">
            <a href="{{ route('admin.index') }}" class="d-inline-block">
                <img src="{{ asset('images/site-icon.png') }}" width="40px" class="sidebar-resize-hide" alt="logo-img">
                <img src="{{ asset('images/site-icon.png') }}" width="40px" class="sidebar-resize-show" alt="logo-img">
            </a>
        </div>

        <ul class="navbar-nav align-self-center ml-auto sidebar-resize-hide">
            <li class="nav-item dropdown">
                <button type="button"
                    class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                    <i class="icon-transmission"></i>
                </button>

                <button type="button"
                    class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                    <i class="icon-cross2"></i>
                </button>
            </li>
        </ul>
    </div>
    <!-- Sidebar content -->
    <div class="sidebar-content">


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                @if (authUser()->isAdmin())
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-house"></i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-submenu">
                        <a class="nav-link">
                            <i class="ph-buildings"></i>
                            <span>Properties</span>
                        </a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><a href="" class="nav-link">Property Types</a></li>
                            <li class="nav-item"><a href="" class="nav-link">Properties</a></li>
                        </ul>
                    </li>

                    <li class="nav-item nav-item-submenu">
                        <a class="nav-link">
                            <i class="ph-house-simple"></i>
                            <span>Units</span>
                        </a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><a href="" class="nav-link">List Units</a></li>
                            <li class="nav-item"><a href="" class="nav-link">Unit Assignments</a></li>
                        </ul>
                    </li>


                    <li class="nav-item nav-item-submenu">
                        <a class="nav-link">
                            <i class="ph-users"></i>
                            <span>Managers & Owners</span>
                        </a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item">
                                <a href="" class="nav-link">

                                    List Managers</a>
                            </li>
                            <li class="nav-item"><a href="" class="nav-link">Assign to Property</a></li>
                        </ul>
                    </li>

                    <li class="nav-item nav-item-submenu">
                        <a class="nav-link">
                            <i class="ph-scroll"></i>
                            <span>Accounting</span>
                        </a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><a href="" class="nav-link">All Payments</a></li>
                            <li class="nav-item"><a href="" class="nav-link">All Invoices</a></li>
                            <li class="nav-item"><a href="" class="nav-link">Reports</a></li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu">
                        <a class="nav-link">
                            <i class="ph-gear"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><a href="{{ route('admin.general-settings.index') }}"
                                    class="nav-link">General</a></li>
                            <li
                                class="nav-item nav-item-submenu {{ isOpenMenu(['admin.users.index', 'admin.users.create']) }}">
                                <a href="#" class="nav-link">
                                    <span>Admin Users</span>
                                </a>
                                <ul
                                    class="nav-group-sub collapse {{ isShowMenu(['admin.users.index', 'admin.users.create']) }}">
                                    <li class="nav-item"><a href="{{ route('admin.users.index') }}"
                                            class="nav-link {{ isActiveMenu(['admin.users.index']) }}">View Users</a>
                                    </li>
                                    <li class="nav-item"><a href="{{ route('admin.users.create') }}"
                                            class="nav-link {{ isActiveMenu(['admin.users.create']) }}">Add User</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="{{ route('admin.backups.index') }}" class="nav-link">Back
                                    Ups</a></li>
                            <li class="nav-item"><a href="{{ route('admin.audit-logs.index') }}"
                                    class="nav-link">Activity Logs</a></li>
                        </ul>
                    </li>
                @endif

                @if (authUser()->isTenant())
                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-house"></i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-buildings"></i>
                            <span>
                                Rent Unit Info
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-wrench"></i>
                            <span>
                                Service Request
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-file"></i>
                            <span>
                                Documents
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-receipt"></i>
                            <span>
                                My Payment/Invoices
                            </span>
                        </a>
                    </li>
                @endif

                @if (authUser()->isOwner())
                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-house"></i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-buildings"></i>
                            <span>
                                Unit Info
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-wrench"></i>
                            <span>
                                Service Request
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-file"></i>
                            <span>
                                Documents
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-receipt"></i>
                            <span>
                                My Payment/Invoices
                            </span>
                        </a>
                    </li>
                @endif

                @if (authUser()->isTenantManager())
                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-house"></i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-user"></i>
                            <span>
                                Tenant List
                            </span>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-wrench"></i>
                            <span>
                                Request/Complaints
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-money"></i>
                            <span>
                                Pending Payment
                            </span>
                        </a>
                    </li>
                @endif

                @if (authUser()->isAccountant())
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-house"></i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-submenu">
                        <a class="nav-link">
                            <i class="ph-buildings"></i>
                            <span>Payments</span>
                        </a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><a href="" class="nav-link">Record Payment</a></li>
                            <li class="nav-item"><a href="" class="nav-link">View All Payments</a></li>
                        </ul>
                    </li>

                    <li class="nav-item nav-item-submenu">
                        <a class="nav-link">
                            <i class="ph-house-simple"></i>
                            <span>Invoices</span>
                        </a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><a href="" class="nav-link">Generate Invoice</a></li>
                            <li class="nav-item"><a href="" class="nav-link">View Invoices</a></li>
                        </ul>
                    </li>


                    <li class="nav-item nav-item-submenu">
                        <a class="nav-link">
                            <i class="ph-megaphone"></i>
                            <span>Reminders</span>
                        </a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    Send Payment Reminders</a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item nav-item-submenu">
                        <a class="nav-link">
                            <i class="ph-scroll"></i>
                            <span>Reports</span>
                        </a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><a href="" class="nav-link">Income by Property</a></li>
                        </ul>
                    </li>
                @endif

                @if (authUser()->isPropertyManager())
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-house"></i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('property.index') }}"
                            class="nav-link {{ isActiveMenu(['property.index']) }}">
                            <i class="ph-buildings"></i>
                            <span>
                                Properties
                            </span>
                        </a>
                    </li>

                    <li class="nav-item nav-item-submenu">
                        <a class="nav-link">
                            <i class="ph-door"></i>
                            <span>Units</span>
                        </a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><a href="{{ route('unit.index') }}" class="nav-link">Unit List</a></li>
                            <li class="nav-item"><a href="" class="nav-link">Rental Records</a></li>
                            <li class="nav-item"><a href="" class="nav-link">Damage Reports</a></li>
                        </ul>
                    </li>

                    <li class="nav-item nav-item-submenu">
                        <a class="nav-link">
                            <i class="ph-users"></i>
                            <span>Occupant</span>
                        </a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><a href="" class="nav-link">Tenants</a></li>
                            <li class="nav-item"><a href="" class="nav-link">Owners</a></li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link {{ isActiveMenu(['admin.index']) }}">
                            <i class="ph-file"></i>
                            <span>
                                Documents
                            </span>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="javascript:void" class="nav-link" data-bs-target="#logoutConfirm"
                        data-bs-toggle="modal">
                        <i class="ph-sign-out"></i>
                        <span>Log Out</span>
                    </a>
                </li>

                <!-- /page kits -->

            </ul>
        </div>


    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
