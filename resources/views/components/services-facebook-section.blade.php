<!-- Services and Facebook Section -->
<section class="services-facebook-section">
    <div class="services-facebook-grid">
        <div class="services-left">
            <div class="service-buttons-grid">
                <!-- Child Center -->
                <div class="service-button child-center">
                    <img src="image/mom.png" alt="Mom" class="service-icon-large">
                    <div class="text-content">
                        <span class="main-title">ศูนย์พัฒนาเด็กเล็ก</span>
                        <span class="sub-title">องค์การบริหารส่วนตำบลบ้านโพธิ์</span>
                    </div>
                </div>

                <!-- Oil Price -->
                <div class="service-button oil-price">
                    <img src="image/gas.png" alt="Gas" class="oil-icon">
                    <div class="text-content">
                        <span class="oil-title">ราคาน้ำมัน</span>
                    </div>
                </div>

                <!-- Gold Price -->
                <div class="gold-card">
                    <div class="header-gold">ราคาทอง</div>
                    <div class="gold-lower">
                        <div class="price-section">
                            <div class="label">รับซื้อ<br><span>(บาท)</span></div>
                            <div class="price">42,000</div>
                        </div>
                        <div class="divider"></div>
                        <div class="price-section">
                            <div class="label">ขายออก<br><span>(บาท)</span></div>
                            <div class="price">43,000</div>
                        </div>
                    </div>
                </div>

                <!-- Line Friend -->
                <div class="service-button line-friend">
                    <div class="text-area">
                        <div class="main-text">มาเป็นเพื่อน<br>กับเราที่นี่</div>
                        <div class="sub-text">Line@</div>
                    </div>
                    <div class="qr-box"></div>
                </div>

                <!-- E-Service -->
                <div class="service-button e-service">
                    <div class="e-service-content">
                        <img src="image/E-service.jpg" alt="E-service" class="e-service-icon">
                    </div>
                </div>
            </div>
        </div>

        <!-- Facebook Widget -->
        <div class="facebook-right">
            <div class="facebook-widget">
                <div class="facebook-header">
                    <img src="image/facebook.png" alt="Facebook Cover" class="facebook-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Services and Facebook Section Styles */
.services-facebook-section {
  background: #f8f9fa;
  padding: 60px 0;
  width: 100%;
  display: flex;
  justify-content: center;
}

.services-facebook-grid {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 90px;
  display: flex;
  justify-content: center;
}

.service-buttons-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-template-rows: auto auto auto;
  gap: 20px 30px;
  max-width: 750px;
  margin: 0 auto;
  padding: 10px;
}

.service-button {
  border-radius: 12px;
  text-align: center;
  cursor: pointer;
  transition: transform 0.3s;
}

.service-button:hover {
  transform: translateY(-5px);
}

/* Child Center Button */
.service-button.child-center {
  width: 335px;
  height: 120px;
  border-radius: 35px;
  background: linear-gradient(180deg, #B7D3FF 0%, #5A89D0 100%);
  box-shadow: 0px 4px 4px 0px #00000040;
  color: white;
  display: flex;
  align-items: center;
  padding: 0 20px;
  gap: 15px;
  width: 100%;
  max-width: 335px;
  box-sizing: border-box;
  grid-column: 1 / 2;
  grid-row: 1 / 2;
}

.service-icon-large {
  width: 94px;
  height: 94px;
  object-fit: cover;
}

.text-content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  text-align: left;
}

.main-title {
  font-weight: 600;
  font-size: 24px;
  color: #1E1E1E;
  white-space: nowrap;
}

.sub-title {
  font-weight: 400;
  font-size: 16px;
  color: white;
}

/* Oil Price Button */
.service-button.oil-price {
  width: 386px;
  height: 120px;
  border-radius: 35px;
  background: linear-gradient(180deg, #B7D3FF 0%, #5A89D0 100%);
  box-shadow: 0px 4px 4px 0px #00000040;
  display: flex;
  align-items: center;
  padding: 10px 20px;
  gap: 15px;
  cursor: pointer;
  color: #333;
  grid-column: 2 / 3;
  grid-row: 1 / 2;
  width: 100%;
  max-width: 386px;
  box-sizing: border-box;
}

.oil-icon {
  width: 101px;
  height: 101px;
  object-fit: cover;
}

.oil-title {
  font-weight: 600;
  font-size: 32px;
  letter-spacing: 0;
  color: #1E1E1E;
}

/* Gold Card */
.gold-card {
  background: linear-gradient(to bottom, #fdf3ae 0%, #c4932c 100%);
  border-radius: 20px;
  width: 280px;
  padding: 0;
  color: #5c3b0c;
  box-shadow: 0 4px 20px rgba(0,0,0,0.3);
  text-align: center;
  overflow: hidden;
  grid-column: 1 / 2;
  grid-row: 2 / 3;
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 260px;
}

.header-gold {
  background: #fdf3ae;
  padding: 16px;
  font-size: 35px;
  font-weight: bold;
  border-bottom: 1px solid #ffffff55;
}

.gold-content {
  background: linear-gradient(to right, #f4eca4, #f3eba3, #f4eca4);
  padding: 16px 20px;
}

.price-section {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 20px 0;
  position: relative;
}

.price-section .label {
  text-align: left;
  font-size: 16px;
  font-weight: bold;
  color: #5c3b0c;
  flex: 1;
}

.price-section .label span {
  font-size: 13px;
  font-weight: normal;
}

.price-section .price {
  flex: 1;
  text-align: center;
  font-size: 34px;
  font-weight: 700;
  color: #5c3b0c;
  transform: translateX(-48px);
  letter-spacing: 2px;
}

.divider {
  border-top: 1.5px dashed #5c3b0c;
  margin: 10px 0;
}

.gold-lower {
  background: linear-gradient(to right, #d6ac4f 0%, #fceba6 50%, #d6ac4f 100%);
  padding: 20px;
  border-bottom-left-radius: 20px;
  border-bottom-right-radius: 20px;
}

/* Line Friend Button */
.service-button.line-friend {
  width: 386px;
  height: 260px;
  border-radius: 35px;
  background: linear-gradient(180deg, #ACFFA4 0%, #73CC6B 100%);
  box-shadow: 0px 4px 4px 0px #00000040;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
  position: relative;
  font-family: "Prompt", sans-serif;
  grid-column: 2 / 3;
  grid-row: 2 / 3;
  width: 100%;
  max-width: 386px;
  box-sizing: border-box;
}

.service-button.line-friend .text-area {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 6px;
  width: 100%;
  padding-right: 200px;
  box-sizing: border-box;
  text-align: left;
}

.service-button.line-friend .main-text {
  font-size: 32px;
  font-weight: 600;
  color: #1E1E1E;
  white-space: nowrap;
  line-height: 1.2;
  margin-bottom: 20px;
}

.service-button.line-friend .sub-text {
  font-size: 20px;
  font-weight: 500;
  color: #1E1E1E;
  margin-bottom: 75px;
}

.service-button.line-friend .qr-box {
  width: 180px;
  height: 173px;
  border-radius: 23px;
  background: #FFFFFF;
  box-shadow: 0px 4px 4px 0px #00000040;
  position: absolute;
  bottom: 20px;
  right: 20px;
}

/* E-Service Button */
.service-button.e-service {
  background: none;
  grid-column: 1 / 3;
  grid-row: 3 / 4;
}

.e-service-content {
  width: 100%;
  max-width: 750px;
  border-radius: 20px;
  overflow: hidden;
  box-sizing: border-box;
}

.e-service-icon {
  width: 100%;
  height: auto;
  display: block;
  object-fit: contain;
  border-radius: 20px;
}

/* Facebook Widget */
.facebook-widget {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.facebook-header {
  height: 640px;
  width: 459px;
}

.facebook-header img {
  width: 100%;
  height: 640px;
  display: block;
  object-fit: cover;
  border-radius: 12px;
  border: solid #0F52BA 5px;
}
</style>