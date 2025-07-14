<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="#" class="logo d-flex align-items-center text-white fw-bold"
                style="font-size: 18px;">
                <i class="fas fa-coins me-2"></i> ระบบจัดการข้อมูล
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <li class="nav-section">
                    <h4 class="text-section">เมนูพื้นฐาน</h4>
                </li>

                <li class="nav-item {{ request()->is('Admin/PerformanceResults*') ? 'active' : '' }}">
                    <a href="{{ route('PerformanceResultsType') }}">
                        <i class="fas fa-cogs"></i>
                        <p>ผลการดำเนินงาน</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('Admin/LawsAndRegulations*') ? 'active' : '' }}">
                    <a href="{{ route('LawsAndRegulationsType') }}">
                        <i class="fas fa-cogs"></i>
                        <p>กฎหมายและระเบียบ</p>
                    </a>
                </li>

                <li class="nav-section">
                    <h4 class="text-section">เนื้อหา</h4>
                </li>

                <li class="nav-item {{ request()->is('Admin/PressRelease*') ? 'active' : '' }}">
                    <a href="{{ route('PressReleaseHome') }}">
                        <i class="fas fa-cogs"></i>
                        <p>ข่าวประชาสัมพันธ์</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('Admin/Activity*') ? 'active' : '' }}">
                    <a href="{{ route('ActivityHome') }}">
                        <i class="fas fa-cogs"></i>
                        <p>กิจกรรม</p>
                    </a>
                </li>

                <li class="nav-section">
                    <h4 class="text-section">ประกาศงานคลัง</h4>
                </li>

                <li class="nav-item {{ request()->is('Admin/Procurement/*') ? 'active' : '' }}">
                    <a href="{{ route('ProcurementHome') }}">
                        <i class="fas fa-cogs"></i>
                        <p>ประกาศจัดซื้อจัดจ้าง</p>
                    </a>
                </li>

                <li class="nav-section">
                    <h4 class="text-section">แบนเนอร์</h4>
                </li>

                <li class="nav-item {{ request()->is('Admin/ProcurementPlan/*') ? 'active' : '' }}">
                    <a href="{{ route('ProcurementPlanType') }}">
                        <i class="fas fa-cogs"></i>
                        <p>แผนจัดซื้อจัดจ้าง</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#exampleSubmenu" aria-expanded="false" class="collapsed">
                        <i class="fas fa-cogs"></i>
                        <p>ตั้งค่า</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="exampleSubmenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/settings/profile') }}">
                                    <span class="sub-item">โปรไฟล์ผู้ใช้</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
