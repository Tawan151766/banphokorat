<!-- Header Section -->
<header class="header">
    <div class="nav-section">
        <div class="nav-container">
            <div class="header-right">
                <div class="search-box">
                    <input type="text" class="search-input" placeholder="ค้นหา...">
                </div>
                <div class="auth-buttons">
                    <button class="auth-btn1">เข้าสู่ระบบ</button>
                    <button class="auth-btn2">สมัครสมาชิก</button>
                </div>
                <div class="lang-selector">
                    <button class="lang-btn" onclick="toggleLanguage()">
                        <span class="lang-text">ไทย</span>
                        <span class="lang-arrow">▼</span>
                    </button>
                    <div class="lang-dropdown" id="langDropdown">
                        <a href="#" class="lang-option">
                            <span class="flag flag-th"></span>
                            ไทย
                        </a>
                        <a href="#" class="lang-option">
                            <span class="flag flag-kh"></span>
                            ខ្មែរ
                        </a>
                        <a href="#" class="lang-option">
                            <span class="flag flag-vn"></span>
                            Tiếng Việt
                        </a>
                        <a href="#" class="lang-option">
                            <span class="flag flag-cn"></span>
                            中文
                        </a>
                        <a href="#" class="lang-option">
                            <span class="flag flag-la"></span>
                            ລາວ
                        </a>
                    </div>
                </div>
            </div>

            <div class="nav-content">
                <div class="logo-section">
                    <div class="logo">
                        เทศบาล<br>ตำบล<br>บ้านโพธิ์
                    </div>
                    <div class="site-info">
                        <div class="site-title">เทศบาลตำบลบ้านโพธิ์</div>
                        <div class="site-subtitle">Ban Pho Sub-district Municipality</div>
                    </div>
                </div>

                <nav class="nav-menu">
                    <a href="#" class="nav-item">หน้าแรก</a>
                    
                    <div class="nav-item-dropdown">
                        <a href="#" class="nav-item">เกี่ยวกับเรา</a>
                        <div class="nav-dropdown">
                            <a href="#" class="dropdown-item">ประวัติความเป็นมา</a>
                            <a href="#" class="dropdown-item">วิสัยทัศน์ พันธกิจ</a>
                            <a href="#" class="dropdown-item">โครงสร้างองค์กร</a>
                            <div class="nav-sub-dropdown">
                                <a href="#" class="dropdown-item">คณะผู้บริหาร ▶</a>
                                <div class="sub-dropdown-content">
                                    <a href="#" class="sub-dropdown-item">นายกเทศมนตรี</a>
                                    <a href="#" class="sub-dropdown-item">รองนายกเทศมนตรี</a>
                                    <a href="#" class="sub-dropdown-item">เลขานุการนายกเทศมนตรี</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nav-item-dropdown">
                        <a href="#" class="nav-item">ข้อมูลข่าวสาร</a>
                        <div class="nav-dropdown">
                            <a href="#" class="dropdown-item">ข่าวประชาสัมพันธ์</a>
                            <a href="#" class="dropdown-item">กิจกรรม</a>
                            <a href="#" class="dropdown-item">ประกาศ</a>
                        </div>
                    </div>

                    <div class="nav-item-dropdown">
                        <a href="#" class="nav-item">บริการ</a>
                        <div class="nav-dropdown">
                            <a href="#" class="dropdown-item">E-Service</a>
                            <a href="#" class="dropdown-item">แจ้งเหตุร้องเรียน</a>
                            <a href="#" class="dropdown-item">คู่มือประชาชน</a>
                        </div>
                    </div>

                    <a href="#" class="nav-item">ติดต่อเรา</a>
                </nav>
            </div>
        </div>
    </div>
</header>

<script>
function toggleLanguage() {
    const dropdown = document.getElementById('langDropdown');
    dropdown.classList.toggle('show');
}

// Close dropdown when clicking outside
window.onclick = function(event) {
    if (!event.target.matches('.lang-btn') && !event.target.matches('.lang-text') && !event.target.matches('.lang-arrow')) {
        const dropdown = document.getElementById('langDropdown');
        if (dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
        }
    }
}
</script>