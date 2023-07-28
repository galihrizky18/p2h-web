<div class="sidebarSuperAdmin" id="sidebar">
    <div class="main-sidebar">
        <div class="logo">
            <img src="{{ asset('asset/logo_sbs.png') }}" alt="">
            <span class="namaPT">PT. Satria Bahana Sarana</span>
        </div>
        <hr>
        <div class="menu">
            <ul>
                <a href="/super-admin">
                    <li>
                        <img src="{{ asset('asset/admin/home-profile.svg') }}" alt="">
                        <span>Home</span>
                    </li>
                </a>
                <a href="/super-admin/admin">
                    <li>
                        <img src="{{ asset('asset/admin/admin-icon.svg') }}" alt="">
                        <span>Admin</span>
                    </li>
                </a>
                <a href="/super-admin/driver">
                    <li>
                        <img src="{{ asset('asset/admin/driver-icon.svg') }}" alt="">
                        <span>Driver</span>
                    </li>
                </a>

                <a href="/super-admin/unit">
                    <li>
                        <img src="{{ asset('asset/admin/unit-icon.svg') }}" alt="">
                        <span>Unit</span>
                    </li>
                </a>

                <a href="/super-admin/bengkel">
                    <li>
                        <img src="{{ asset('asset/admin/bengkel-icon.svg') }}" alt="">
                        <span>Bengkel</span>
                    </li>
                </a>

                <a href="/super-admin/reportForm">
                    <li>
                        <img src="{{ asset('asset/admin/report-icon.svg') }}" alt="">
                        <span>Report Form</span>
                    </li>
                </a>

                <a href="/super-admin/perbaikan">
                    <li>
                        <img src="{{ asset('asset/admin/perbaikan-icon.svg') }}" alt="">
                        <span>Perbaikan Form</span>
                    </li>
                </a>
            </ul>

            <div class="menu-sidebar-super-admin" id="profileAdmin">

                <a href="{{ route('logout') }}">
                    <div class="item">
                        <img src="{{ asset('asset/admin/logout-icon.svg') }}" alt="">
                        <span>Logout</span>
                    </div>
                </a>

            </div>
            <div class="profile" onclick="openMenuSidebarAdmin()">
                <div class="item item1">
                    <img src="{{ asset('asset/admin/profile-icon.svg') }}" alt="">
                    <span>{{ Auth::user()->admin->first_name }} {{ Auth::user()->admin->last_name }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
