<!-- Content Sections -->
<section class="content-sections">
    <div class="content-grid">
        <!-- Video Section -->
        <div class="content-card">
            <div class="content-header">
                <h3 class="content-title">วิดีทัศน์แนะนำ</h3>
            </div>
            <div class="video-container">
                <iframe class="video-player" src="https://www.youtube.com/embed/J---aiyznGQ?rel=0" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <div class="video-nav">
                <button class="nav-arrow-video left" onclick="changeVideo('prev')">‹</button>
                <div class="video-dot active" data-video="https://www.youtube.com/embed/J---aiyznGQ?rel=0"
                    onclick="selectVideo(0)"></div>
                <div class="video-dot" data-video="https://www.youtube.com/embed/9bZkp7q19f0?rel=0"
                    onclick="selectVideo(1)"></div>
                <div class="video-dot" data-video="https://www.youtube.com/embed/J---aiyznGQ?rel=0"
                    onclick="selectVideo(2)"></div>
                <div class="video-dot" data-video="https://www.youtube.com/embed/9bZkp7q19f0?rel=0"
                    onclick="selectVideo(3)"></div>
                <button class="nav-arrow-video right" onclick="changeVideo('next')">›</button>
            </div>
            <button class="more-btn-content-left">เพิ่มเติม</button>
        </div>

        <!-- Library Section -->
        <div class="content-card">
            <div class="content-header">
                <h3 class="content-title">E-LIBRARY</h3>
            </div>
            <div class="library-content">
                <img src="image/Online_Library.jpg" alt="EIT">
            </div>
            <button class="more-btn-content-right">เพิ่มเติม</button>
        </div>
    </div>
</section>

<script>
let currentVideoIndex = 0;
const videos = [
    "https://www.youtube.com/embed/J---aiyznGQ?rel=0",
    "https://www.youtube.com/embed/9bZkp7q19f0?rel=0",
    "https://www.youtube.com/embed/J---aiyznGQ?rel=0",
    "https://www.youtube.com/embed/9bZkp7q19f0?rel=0"
];

function changeVideo(direction) {
    if (direction === 'prev') {
        currentVideoIndex = (currentVideoIndex - 1 + videos.length) % videos.length;
    } else {
        currentVideoIndex = (currentVideoIndex + 1) % videos.length;
    }
    selectVideo(currentVideoIndex);
}

function selectVideo(index) {
    currentVideoIndex = index;
    const videoPlayer = document.querySelector('.video-player');
    const dots = document.querySelectorAll('.video-dot');
    
    videoPlayer.src = videos[index];
    
    dots.forEach(dot => dot.classList.remove('active'));
    dots[index].classList.add('active');
}
</script>