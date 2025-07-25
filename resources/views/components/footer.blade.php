<!-- Statistics Footer Section -->
<section class="statistics-footer-section">
    <div class="statistics-content">
        <div class="statistics-footer-grid">
            <div class="stat-grid">
                <div class="stat-header stat-left">สถิติผู้เข้าชม</div>
                <div class="stat-header">วันนี้</div>
                <div class="stat-header">เมื่อวาน</div>
                <div class="stat-header">สัปดาห์นี้</div>
                <div class="stat-header">เดือนนี้</div>
                <div class="stat-header">ปีนี้</div>
                <div class="stat-header">ทั้งหมด</div>
                
                <div class="stat-footer-item-header stat-left">จำนวนผู้เข้าชม</div>
                <div class="stat-footer-item">1,234</div>
                <div class="stat-footer-item">2,345</div>
                <div class="stat-footer-item">12,345</div>
                <div class="stat-footer-item">45,678</div>
                <div class="stat-footer-item">123,456</div>
                <div class="stat-footer-item">987,654</div>
            </div>
        </div>
    </div>
</section>

<!-- Main Footer -->
<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <!-- Left Column -->
            <div class="footer-column-left">
                <div class="footer-logo">
                    <img src="image/logo.png" alt="Logo" class="footer-logo-img">
                </div>
                <div class="footer-contact">
                    <div class="contact-item">
                        <span class="contact-icon">📍</span>
                        <span>123 ถนนบ้านโพธิ์ ตำบลบ้านโพธิ์ อำเภอเมือง จังหวัดชลบุรี 20000</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📞</span>
                        <span>038-123-456</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📠</span>
                        <span>038-123-457</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">✉️</span>
                        <span>info@banpho.go.th</span>
                    </div>
                </div>
            </div>

            <!-- Middle Column -->
            <div class="footer-column">
                <h4 class="footer-title">เมนูหลัก</h4>
                <ul class="footer-menu">
                    <li><a href="#" class="footer-link">หน้าแรก</a></li>
                    <li><a href="#" class="footer-link">เกี่ยวกับเรา</a></li>
                    <li><a href="#" class="footer-link">ข้อมูลข่าวสาร</a></li>
                    <li><a href="#" class="footer-link">บริการ</a></li>
                    <li><a href="#" class="footer-link">ติดต่อเรา</a></li>
                </ul>
            </div>

            <!-- Right Column -->
            <div class="footer-column">
                <h4 class="footer-title">บริการออนไลน์</h4>
                <ul class="footer-menu">
                    <li><a href="#" class="footer-link">E-Service</a></li>
                    <li><a href="#" class="footer-link">แจ้งเหตุร้องเรียน</a></li>
                    <li><a href="#" class="footer-link">E-Library</a></li>
                    <li><a href="#" class="footer-link">คู่มือประชาชน</a></li>
                </ul>
                
                <div class="footer-social">
                    <a href="#" class="social-link">📘</a>
                    <a href="#" class="social-link">📷</a>
                    <a href="#" class="social-link">🐦</a>
                    <a href="#" class="social-link">📺</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="footer-bottom-content">
            <h2 class="municipality-name">เทศบาลตำบลบ้านโพธิ์</h2>
            <p class="municipality-address">123 ถนนบ้านโพธิ์ ตำบลบ้านโพธิ์ อำเภอเมือง จังหวัดชลบุรี 20000</p>
            <p class="municipality-details">โทรศัพท์: 038-123-456 | โทรสาร: 038-123-457 | อีเมล: info@banpho.go.th</p>
        </div>
    </div>
</footer>

<style>
/* Statistics Footer Section */
.statistics-footer-section {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: 0;
  min-height: 663px;
  background-image: linear-gradient(180deg, rgba(135, 182, 255, 0.4) 0%, rgba(15, 82, 186, 0.4) 100%), url(image/whitecastle.jpg);
  background-size: cover;
  background-position: center;
  width: 100%;
}

.statistics-content {
  width: 100%;
  background-color: rgba(255, 255, 255, 0.65);
  padding: 15px;
  box-sizing: border-box;
}

.statistics-footer-grid {
  width: 100%;
  max-width: 1300px;
  margin: 0 auto;
  padding: 15px;
  display: flex;
  justify-content: center;
}

.stat-grid {
  display: grid;
  grid-template-columns: minmax(180px, 1.5fr) repeat(6, minmax(80px, 1fr));
  gap: 10px 20px;
  width: 100%;
  align-items: center;
}

.stat-header {
  font-size: 18px;
  font-weight: bold;
  color: #0F52BA;
  text-align: center;
  white-space: nowrap;
  padding-bottom: 5px;
}

.stat-footer-item-header {
  font-size: 16px;
  font-weight: 500;
  color: #000;
  text-align: center;
  white-space: nowrap;
}

.stat-footer-item {
  font-size: 16px;
  font-weight: 600;
  color: #0F52BA;
  text-align: center;
  white-space: nowrap;
  border-right: 2px solid #0F52BA80;
}

.stat-left {
  text-align: left;
  padding-left: 10px;
}

/* Main Footer */
.main-footer {
  background: linear-gradient(180deg, #87B6FF 0%, #0F52BA 100%);
  color: white;
  padding: 60px 0 0;
  width: 100%;
}

.footer-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.footer-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 40px;
  margin-bottom: 40px;
  margin-top: 50px;
  margin-right: 120px;
}

.footer-column {
  display: flex;
  flex-direction: column;
  max-width: fit-content;
  margin-left: 100px;
}

.footer-column-left {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  max-width: fit-content;
}

.footer-logo {
  margin-bottom: 20px;
}

.footer-logo-img {
  width: 146px;
  height: 146px;
  background: white;
  border-radius: 50%;
}

.footer-contact {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.contact-item {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 14px;
  line-height: 1.5;
  white-space: nowrap;
  margin-left: 150px;
}

.contact-icon {
  font-size: 16px;
  width: 20px;
}

.footer-title {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 20px;
  color: #ffffff;
  border-bottom: 2px solid #ffffff;
}

.footer-menu {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.footer-link {
  color: white;
  text-decoration: none;
  font-size: 14px;
  transition: color 0.3s;
  padding: 5px 0;
}

.footer-link:hover {
  color: #87ceeb;
  text-decoration: underline;
}

.footer-social {
  display: flex;
  gap: 15px;
  margin-top: 20px;
  margin-bottom: 30px;
  margin-right: 40px;
}

.social-link {
  display: inline-block;
  width: 40px;
  height: 40px;
  background: none;
  border-radius: 50%;
  text-align: center;
  line-height: 40px;
  font-size: 18px;
  color: white;
  text-decoration: none;
  transition: all 0.3s;
}

.social-link:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: translateY(-2px);
}

/* Footer Bottom */
.footer-bottom {
  background: none;
  padding: 40px 0;
}

.footer-bottom-content {
  text-align: center;
}

.municipality-name {
  font-size: 32px;
  font-weight: 500;
  margin-bottom: 10px;
  color: #ffffff;
}

.municipality-address {
  font-size: 16px;
  margin-bottom: 5px;
  opacity: 0.9;
}

.municipality-details {
  font-size: 14px;
  opacity: 0.8;
  line-height: 1.5;
}
</style>