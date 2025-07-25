<!-- Announcement Section -->
<section class="announcement-section">
    <div class="section-container-announcement">
        <div class="announcement-card">
            <div class="announcement-header">
                <div class="announcement-info">
                    <h3 class="announcement-title-section">ป้ายประกาศ</h3>
                    <div class="announcement-subtitle-section">องค์การบริหารส่วนตำบล</div>
                </div>
                <button class="more-btn-announcement">เพิ่มเติม</button>
            </div>
            <div style="color: white; padding: 20px; text-align: center;">
                <button class="nav-arrow-contact left" onclick="changeContact('prev')">‹</button>
                <button class="nav-arrow-contact right" onclick="changeContact('next')">›</button>

                <div class="contact-card">
                    <img src="image/annu.jpg" alt="announcement-pic">
                </div>
            </div>
        </div>
    </div>
</section>

<script>
let currentContactIndex = 0;
const contactImages = [
    "image/annu.jpg",
    "image/annu2.jpg",
    "image/annu3.jpg"
];

function changeContact(direction) {
    if (direction === 'prev') {
        currentContactIndex = (currentContactIndex - 1 + contactImages.length) % contactImages.length;
    } else {
        currentContactIndex = (currentContactIndex + 1) % contactImages.length;
    }
    
    const contactImg = document.querySelector('.contact-card img');
    contactImg.src = contactImages[currentContactIndex];
}
</script>