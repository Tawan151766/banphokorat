<!-- Activities and News Section -->
<section class="activities-news-section">
    <div class="section-container-activities-news">
        <div class="tab-header">
            <button class="tab-btn active" onclick="switchTab('activities')">กิจกรรม</button>
            <button class="tab-btn" onclick="switchTab('news')">ข่าวประชาสัมพันธ์</button>
        </div>

        <!-- กิจกรรม -->
        <div class="tab-content" id="activitiesContent">
            <div class="content-layout">
                <div class="featured-item">
                    <div class="featured-content">
                        <div class="image-wrapper">
                            <img src="image/news.jpg" alt="Featured Activity" class="featured-image" />
                        </div>
                        <div class="item-info">
                            <h3 class="item-title">กิจกรรม</h3>
                            <p class="item-date">วันที่</p>
                            <p class="item-excerpt">ข้อความ</p>
                            <a href="#" class="read-more">อ่านต่อ</a>
                        </div>
                    </div>

                    <div class="side-items">
                        <div class="side-item">
                            <div class="side-image-wrapper">
                                <img src="image/news.jpg" alt="Activity 1" class="side-image" />
                            </div>
                            <div class="side-info">
                                <h4 class="side-title">กิจกรรม</h4>
                                <p class="side-date">วันที่</p>
                                <p class="side-excerpt">ข้อความ</p>
                                <a href="#" class="read-more">อ่านต่อ</a>
                            </div>
                        </div>

                        <div class="side-item">
                            <div class="side-image-wrapper">
                                <img src="image/news.jpg" alt="Activity 2" class="side-image" />
                            </div>
                            <div class="side-info">
                                <h4 class="side-title">กิจกรรม</h4>
                                <p class="side-date">วันที่</p>
                                <p class="side-excerpt">ข้อความ</p>
                                <a href="#" class="read-more">อ่านต่อ</a>
                            </div>
                        </div>

                        <div class="side-item">
                            <div class="side-image-wrapper">
                                <img src="image/news.jpg" alt="Activity 3" class="side-image" />
                            </div>
                            <div class="side-info">
                                <h4 class="side-title">กิจกรรม</h4>
                                <p class="side-date">วันที่</p>
                                <p class="side-excerpt">ข้อความ</p>
                                <a href="#" class="read-more">อ่านต่อ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ข่าวประชาสัมพันธ์ -->
        <div class="tab-content hidden" id="newsContent">
            <div class="content-layout">
                <div class="featured-item">
                    <div class="featured-content">
                        <div class="image-wrapper">
                            <img src="image/news.jpg" alt="Featured News" class="featured-image" />
                        </div>
                        <div class="item-info">
                            <h3 class="item-title">ข่าวประชาสัมพันธ์</h3>
                            <p class="item-date">วันที่</p>
                            <p class="item-excerpt">ข้อความ</p>
                            <a href="#" class="read-more">อ่านต่อ</a>
                        </div>
                    </div>

                    <div class="side-items">
                        <div class="side-item">
                            <div class="side-image-wrapper">
                                <img src="image/news.jpg" alt="News 1" class="side-image" />
                            </div>
                            <div class="side-info">
                                <h4 class="side-title">ข่าวประชาสัมพันธ์</h4>
                                <p class="side-date">วันที่</p>
                                <p class="side-excerpt">ข้อความ</p>
                                <a href="#" class="read-more">อ่านต่อ</a>
                            </div>
                        </div>

                        <div class="side-item">
                            <div class="side-image-wrapper">
                                <img src="image/news.jpg" alt="News 2" class="side-image" />
                            </div>
                            <div class="side-info">
                                <h4 class="side-title">ข่าวประชาสัมพันธ์</h4>
                                <p class="side-date">วันที่</p>
                                <p class="side-excerpt">ข้อความ</p>
                                <a href="#" class="read-more">อ่านต่อ</a>
                            </div>
                        </div>

                        <div class="side-item">
                            <div class="side-image-wrapper">
                                <img src="image/news.jpg" alt="News 3" class="side-image" />
                            </div>
                            <div class="side-info">
                                <h4 class="side-title">ข่าวประชาสัมพันธ์</h4>
                                <p class="side-date">วันที่</p>
                                <p class="side-excerpt">ข้อความ</p>
                                <a href="#" class="read-more">อ่านต่อ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="more-section">
            <button class="more-btn-center">เพิ่มเติม</button>
        </div>
    </div>
</section>

<script>
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab content
    if (tabName === 'activities') {
        document.getElementById('activitiesContent').classList.remove('hidden');
        document.querySelector('.tab-btn[onclick="switchTab(\'activities\')"]').classList.add('active');
    } else if (tabName === 'news') {
        document.getElementById('newsContent').classList.remove('hidden');
        document.querySelector('.tab-btn[onclick="switchTab(\'news\')"]').classList.add('active');
    }
}
</script>