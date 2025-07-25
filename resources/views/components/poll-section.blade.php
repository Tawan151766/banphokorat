<!-- Opinion Poll Section -->
<section class="poll-section">
    <div class="section-container">
        <div class="poll-card">
            <h3 class="poll-title">แสดงความคิดเห็น</h3>
            <p class="poll-subtitle">ความคิดเห็นต่อบ้านเมืองที่ท่านอยู่อาศัย</p>

            <div class="poll-options">
                <div class="poll-row">
                    <label class="poll-option">
                        <input type="checkbox" name="opinion" value="1">
                        <span class="checkmark"></span>
                        จัดการเรื่องการป้องกันน้ำท่วม
                    </label>
                    <label class="poll-option">
                        <input type="checkbox" name="opinion" value="2">
                        <span class="checkmark"></span>
                        แก้ไขปัญหาสิ่งแวดล้อม
                    </label>
                    <label class="poll-option">
                        <input type="checkbox" name="opinion" value="3">
                        <span class="checkmark"></span>
                        แก้ไขปัญหาไฟฟ้าดับบ่อย
                    </label>
                </div>
                <div class="poll-row">
                    <label class="poll-option">
                        <input type="checkbox" name="opinion" value="4">
                        <span class="checkmark"></span>
                        จัดมาตรการป้องกันน้ำท่วม
                    </label>
                    <label class="poll-option">
                        <input type="checkbox" name="opinion" value="5">
                        <span class="checkmark"></span>
                        แก้ไขปัญหายาเสพติด
                    </label>
                    <label class="poll-option">
                        <input type="checkbox" name="opinion" value="6">
                        <span class="checkmark"></span>
                        แก้ไขปัญหาลักขโมย
                    </label>
                </div>

                <button class="vote-btn" onclick="submitVote()">กดโหวต</button>
            </div>
        </div>
    </div>
</section>

<script>
function submitVote() {
    const checkedOptions = document.querySelectorAll('input[name="opinion"]:checked');
    if (checkedOptions.length === 0) {
        alert('กรุณาเลือกความคิดเห็นอย่างน้อย 1 ข้อ');
        return;
    }
    
    const selectedValues = Array.from(checkedOptions).map(option => option.value);
    console.log('Selected opinions:', selectedValues);
    
    // Here you would typically send the data to your server
    alert('ขอบคุณสำหรับความคิดเห็นของท่าน');
}
</script>

<style>
/* Poll Section Styles */
.poll-section {
  background: white;
  padding: 60px 0;
  width: 100%;
  display: flex;
  justify-content: center;
}

.poll-card {
  border-radius: 12px;
  padding: 40px;
  width: 100%;
  max-width: none;
  margin: 0 16px;
  box-sizing: border-box;
}

.poll-title {
  font-size: 32px;
  font-weight: 600;
  color: #0F52BA;
  text-align: left;
  margin-bottom: 10px;
}

.poll-subtitle {
  font-size: 24px;
  color: #1E1E1E;
  text-align: left;
  margin-bottom: 30px;
  font-weight: 400;
}

.poll-options {
  padding: 40px;
  border-radius: 35px;
  background: linear-gradient(180deg, #ADCDFF 0%, #538BE3 100%);
  box-shadow: 0px 4px 4px 0px #00000040;
  font-size: 24px;
  font-weight: 400;
}

.poll-row {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 20px;
  margin-bottom: 25px;
}

.poll-option {
  display: flex;
  align-items: center;
  cursor: pointer;
  font-size: 14px;
  color: #333;
}

.poll-option input[type="checkbox"] {
  display: none;
}

.checkmark {
  width: 20px;
  height: 20px;
  border: 2px solid #357abd;
  border-radius: 40px;
  margin-right: 10px;
  position: relative;
  flex-shrink: 0;
  background-color: #D9D9D9;
}

.poll-option input[type="checkbox"]:checked + .checkmark {
  background: #357abd;
}

.poll-option input[type="checkbox"]:checked + .checkmark::after {
  content: "✓";
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  font-weight: bold;
}

.vote-btn {
  display: block;
  margin: 0 auto;
  background: white;
  color: #0F52BA;
  border: none;
  font-size: 18px;
  font-weight: bold;
  cursor: pointer;
  width: 249px;
  height: 48px;
  border-radius: 24px;
  margin-top: 40px;
}

.vote-btn:hover {
  background: rgba(255, 255, 255, 0.329);
}
</style>