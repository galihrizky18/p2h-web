

<div class="sidebarForm">
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
                        <img src="{{ asset('asset/driver/document-icon.svg') }}" alt="">
                        <span>Document</span>
                    </li>
                </a>
                
                <a href="/driver/form/safety">
                    <li>
                        <img src="{{ asset('asset/driver/safety-icon.svg') }}" alt="">
                        <span>Safety</span>
                    </li>
                </a>
                <a href="/driver/form/engine">
                    <li>
                        <img src="{{ asset('asset/driver/engine-icon.svg') }}" alt="">
                        <span>Engine & System</span>
                    </li>
                </a>
                <a href="/driver/form/tools">
                    <li>
                        <img src="{{ asset('asset/driver/tools-icon.svg') }}" alt="">
                        <span>Tools</span>
                    </li>
                </a>
                <a href="/driver/form/preview">
                    <li>
                        <img src="{{ asset('asset/driver/preview-icon.svg') }}" alt="">
                        <span>Preview</span>
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


