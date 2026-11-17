<?php
$pageTitle = "صفحه اصلی";
require "header.php";
?>
<section class="hero">
    <div class="hero-copy">
        <span class="eyebrow">سامانه مدیریت خودرو</span>
        <h1>ماشین‌هایت را <span>مدیریت کن!</span></h1>
        <p>در این سایت می‌توانید مشخصات ماشین‌ها را ثبت کنید، ماشین‌های تولید سال ۱۴۰۵ را ببینید و بر اساس سال تولید و قیمت جست‌وجو انجام دهید.</p>
        <div class="hero-actions">
            <a class="button button-primary" href="insert_car.php">＋ ثبت ماشین جدید</a>
            <a class="button button-secondary" href="search_car.php">⌕ جست‌وجوی ماشین</a>
        </div>
    </div>
    <div class="hero-art" aria-hidden="true">
        <div class="sun"></div>
        <div class="road"></div>
        <div class="hero-car">🚙</div>
        <div class="floating-wheel">⚙️</div>
    </div>
</section>

<section class="section-heading">
    <div>
        <span class="eyebrow">امکانات سایت</span>
        <h2>از کجا شروع کنیم؟</h2>
    </div>
</section>
<div class="feature-grid">
    <a class="feature-card" href="insert_car.php">
        <span class="feature-icon">🚗</span>
        <h3>ثبت ماشین</h3>
        <p>نام، سال تولید، رنگ و قیمت ماشین را وارد و ذخیره کن.</p>
        <span class="feature-link">رفتن به ثبت ←</span>
    </a>
    <a class="feature-card" href="cars_1405.php">
        <span class="feature-icon">📅</span>
        <h3>ماشین‌های سال ۱۴۰۵</h3>
        <p>فهرست تمام ماشین‌هایی را ببینید که سال تولیدشان ۱۴۰۵ است.</p>
        <span class="feature-link">مشاهده فهرست ←</span>
    </a>
    <a class="feature-card" href="search_car.php">
        <span class="feature-icon">🔎</span>
        <h3>جست‌وجوی دقیق</h3>
        <p>با واردکردن سال تولید و قیمت، ماشین موردنظرت را پیدا کنید.</p>
        <span class="feature-link">جست‌وجو ←</span>
    </a>
</div>
<?php require "footer.php"; ?>