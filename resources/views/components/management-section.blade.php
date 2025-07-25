<!-- Management Section -->
<section class="management-section">
    <h2 class="section-title" id="management-title">คณะผู้บริหาร</h2>
    <div class="management-grid" id="managementGrid">
        <div class="management-card position-1">
            <div class="management-avatar">
                <img src="image/avatar.png" alt="ชื่อบุคคล 1">
            </div>
            <div class="management-name">ตำแหน่ง</div>
            <div class="management-position">ชื่อ........................<br>เบอร์โทร...............</div>
        </div>
        <div class="management-card position-2">
            <div class="management-avatar">
                <img src="image/avatar.png" alt="ชื่อบุคคล 2">
            </div>
            <div class="management-name">ตำแหน่ง</div>
            <div class="management-position">ชื่อ........................<br>เบอร์โทร...............</div>
        </div>
        <div class="management-card position-3">
            <div class="management-avatar">
                <img src="image/avatar.png" alt="ชื่อบุคคล 3">
            </div>
            <div class="management-name">ตำแหน่ง</div>
            <div class="management-position">ชื่อ........................<br>เบอร์โทร...............</div>
        </div>
        <div class="management-card position-4">
            <div class="management-avatar">
                <img src="image/avatar.png" alt="ชื่อบุคคล 4">
            </div>
            <div class="management-name">ตำแหน่ง</div>
            <div class="management-position">ชื่อ........................<br>เบอร์โทร...............</div>
        </div>
        <div class="management-card position-5">
            <div class="management-avatar">
                <img src="image/avatar.png" alt="ชื่อบุคคล 5">
            </div>
            <div class="management-name">ตำแหน่ง</div>
            <div class="management-position">ชื่อ........................<br>เบอร์โทร...............</div>
        </div>
    </div>

    <!-- Services Container -->
    <div class="services-container">
        <button class="nav-arrow2 left" onclick="scrollServices('left')">‹</button>
        <button class="nav-arrow2 right" onclick="scrollServices('right')">›</button>

        <div class="services-grid" id="servicesGrid">
            <div class="service-item">
                <div class="service-icon">📋</div>
                <div class="service-title">แจ้งเหตุ<br>ร้องเรียน-ร้องทุกข์</div>
            </div>
            <div class="service-item">
                <div class="service-icon">🗺️</div>
                <div class="service-title">แผนที่การเดินทาง<br>ทต.บ้านโพธิ์</div>
            </div>
            <div class="service-item">
                <div class="service-icon">📖</div>
                <div class="service-title">คู่มือประชาชน<br>ทต.บ้านโพธิ์</div>
            </div>
            <div class="service-item">
                <div class="service-icon">💰</div>
                <div class="service-title">กองทุนสุขภาพ<br>ทต.บ้านโพธิ์</div>
            </div>
            <div class="service-item">
                <div class="service-icon">👥</div>
                <div class="service-title">สถานที่สำคัญ<br>ทำเนียบบุคคล</div>
            </div>
            <div class="service-item">
                <div class="service-icon">🤝</div>
                <div class="service-title">สิ่งช่วยเหลือ<br>ทต.บ้านโพธิ์</div>
            </div>
        </div>
    </div>

    <h2 class="section-title" id="management-title2">ผู้บริหารส่วนราชการ</h2>
    <div class="management-grid" id="managementGrid2">
        <div class="management-card position-1">
            <div class="management-avatar">
                <img src="image/avatar.png" alt="ชื่อบุคคล 1">
            </div>
            <div class="management-name">ตำแหน่ง</div>
            <div class="management-position">ชื่อ........................<br>เบอร์โทร...............</div>
        </div>
        <div class="management-card position-2">
            <div class="management-avatar">
                <img src="image/avatar.png" alt="ชื่อบุคคล 2">
            </div>
            <div class="management-name">ตำแหน่ง</div>
            <div class="management-position">ชื่อ........................<br>เบอร์โทร...............</div>
        </div>
        <div class="management-card position-3">
            <div class="management-avatar">
                <img src="image/avatar.png" alt="ชื่อบุคคล 3">
            </div>
            <div class="management-name">ตำแหน่ง</div>
            <div class="management-position">ชื่อ........................<br>เบอร์โทร...............</div>
        </div>
        <div class="management-card position-4">
            <div class="management-avatar">
                <img src="image/avatar.png" alt="ชื่อบุคคล 4">
            </div>
            <div class="management-name">ตำแหน่ง</div>
            <div class="management-position">ชื่อ........................<br>เบอร์โทร...............</div>
        </div>
        <div class="management-card position-5">
            <div class="management-avatar">
                <img src="image/avatar.png" alt="ชื่อบุคคล 5">
            </div>
            <div class="management-name">ตำแหน่ง</div>
            <div class="management-position">ชื่อ........................<br>เบอร์โทร...............</div>
        </div>
    </div>
</section>

<script>
function scrollServices(direction) {
    const container = document.getElementById('servicesGrid');
    const scrollAmount = 300;
    
    if (direction === 'left') {
        container.scrollLeft -= scrollAmount;
    } else {
        container.scrollLeft += scrollAmount;
    }
}
</script>