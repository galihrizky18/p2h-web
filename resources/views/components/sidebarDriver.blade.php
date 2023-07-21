

<div class="sidebarDriver">
    <div class="main-sidebar">
        <div class="logo">
            <img src="{{ asset('asset/logo_sbs.png') }}" alt="">
            <span class="namaPT">PT. Satria Bahana Sarana</span>
        </div>
        <hr>
        <div class="menu">
            <ul>
                <a href="/driver">
                    <li>
                        <img src="{{ asset('asset/admin/home-profile.svg') }}" alt="">
                        <span>Home</span>
                    </li>
                </a>
                <a href="/driver/form/document">
                    <li>
                        <img src="{{ asset('asset/driver/form-icon.svg') }}" alt="">
                        <span>Form</span>
                    </li>
                </a>
                
                <a href="/driver/report">
                    <li>
                        <img src="{{ asset('asset/driver/report-icon.svg') }}" alt="">
                        <span>Report</span>
                    </li>
                </a>
            </ul>

            <div class="menu-sidebar-admin" id="profileAdmin">
                
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
                    <span>{{ Auth::user()->driver->first_name }} {{ Auth::user()->driver->last_name }}</span>
                </div>
            </div>
        </div>
    </div>
</div>


