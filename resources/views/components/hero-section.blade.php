<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-images" id="heroImages">
        <div class="hero-image active" style="background-image: url('https://picsum.photos/1920/1080?random=1')"></div>
        <div class="hero-image" style="background-image: url('https://picsum.photos/1920/1080?random=2')"></div>
        <div class="hero-image" style="background-image: url('https://picsum.photos/1920/1080?random=3')"></div>
        <div class="hero-image" style="background-image: url('https://picsum.photos/1920/1080?random=4')"></div>
    </div>
    
    <div class="hero-overlay"></div>
    
    <div class="hero-dots">
        <div class="dot active" onclick="currentSlide(1)"></div>
        <div class="dot" onclick="currentSlide(2)"></div>
        <div class="dot" onclick="currentSlide(3)"></div>
        <div class="dot" onclick="currentSlide(4)"></div>
    </div>
    
    <div class="hero-text-box">
        <h1 class="hero-title">
            ยินดีต้อนรับสู่เว็บไซต์เทศบาลตำบลบ้านโพธิ์<br>
            เพื่อให้บริการประชาชนอย่างมีประสิทธิภาพและโปร่งใส
        </h1>
    </div>
</section>

<!-- Promo Banner -->
<div class="promo-banner" id="promoBanner">
    <button class="close-promo-btn" onclick="closeBanner()">&times;</button>
    <div class="promo-image-placeholder">
        <img src="https://picsum.photos/275/349?random=5" alt="โปรโมชัน">
    </div>
</div>

<script>
let slideIndex = 1;
let slideInterval;

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    const slides = document.querySelectorAll('.hero-image');
    const dots = document.querySelectorAll('.dot');
    
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    slides[slideIndex - 1].classList.add('active');
    dots[slideIndex - 1].classList.add('active');
}

function nextSlide() {
    showSlides(slideIndex += 1);
}

function autoSlide() {
    slideInterval = setInterval(nextSlide, 5000);
}

function closeBanner() {
    document.getElementById('promoBanner').style.display = 'none';
}

// Initialize auto slide
document.addEventListener('DOMContentLoaded', function() {
    autoSlide();
});

// Pause auto slide on hover
document.querySelector('.hero-section').addEventListener('mouseenter', function() {
    clearInterval(slideInterval);
});

document.querySelector('.hero-section').addEventListener('mouseleave', function() {
    autoSlide();
});
</script>