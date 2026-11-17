<?php
if (!isset($pageTitle)) {
    $pageTitle = "مدیریت ماشین‌ها";
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?> | Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="loader.css">
    <script src="loader.js" defer></script>
</head>
<body>
    <div id="page-loader" class="page-loader" aria-live="polite" aria-label="در حال بارگذاری">
        <div class="loader-content">
            <div class="wheel">
                <svg class="wheel-spin" viewBox="0 0 120 120" role="img" aria-label="چرخ ماشین در حال چرخیدن">
                    <circle cx="60" cy="60" r="54" fill="#292D36" stroke="#15171C" stroke-width="4"/>
                    <circle cx="60" cy="60" r="47" fill="none" stroke="#565C68" stroke-width="3" stroke-dasharray="8 6"/>
                    <circle cx="60" cy="60" r="36" fill="#63D6E8" stroke="#FFFFFF" stroke-width="4"/>
                    <g stroke="#FFFFFF" stroke-width="7" stroke-linecap="round">
                        <line x1="60" y1="31" x2="60" y2="45"/>
                        <line x1="60" y1="75" x2="60" y2="89"/>
                        <line x1="31" y1="60" x2="45" y2="60"/>
                        <line x1="75" y1="60" x2="89" y2="60"/>
                        <line x1="40" y1="40" x2="49" y2="49"/>
                        <line x1="71" y1="71" x2="80" y2="80"/>
                        <line x1="80" y1="40" x2="71" y2="49"/>
                        <line x1="49" y1="71" x2="40" y2="80"/>
                    </g>
                    <circle cx="60" cy="60" r="12" fill="#FFB84D" stroke="#FFFFFF" stroke-width="3"/>
                    <circle cx="60" cy="60" r="4" fill="#FFFFFF"/>
                </svg>
            </div>
            <div class="mini-car" aria-hidden="true">🚗</div>
            <h2>در حال گشتن!</h2>
            <p id="loader-message">داریم ماشین‌ها را آماده می‌کنیم...</p>
            <div class="loading-track"><div class="loading-bar"></div></div>
        </div>
    </div>

    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="index.php" aria-label="صفحه اصلی">
                <span class="brand-icon">🚘</span>
                <span>Cars<span class="brand-light">Shop</span></span>
            </a>
            <nav class="main-nav">
                <a href="index.php">صفحه اصلی</a>
                <a href="insert_car.php">ثبت ماشین</a>
                <a href="cars_1405.php">ماشین‌های ۱۴۰۵</a>
                <a href="search_car.php">جست‌وجو</a>
            </nav>
        </div>
    </header>
    <main class="container main-content">