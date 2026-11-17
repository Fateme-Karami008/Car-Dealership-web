<?php
require "../cars_shop_project/config.php";
$pageTitle = "ماشین‌های سال ۱۴۰۵";

$sql = "SELECT car_id, car_name, car_model_year, car_color, car_price FROM Cars WHERE car_model_year = ? ORDER BY car_id DESC";
$stmt = mysqli_prepare($conn, $sql);
$year = "1405";
mysqli_stmt_bind_param($stmt, "s", $year);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

require "../cars_shop_project/header.php";
?>
<section class="page-intro">
    <span class="eyebrow">فهرست بر اساس سال تولید</span>
    <h1>ماشین‌های تولید سال <span>۱۴۰۵</span></h1>
    <p>در این بخش، همه ماشین‌هایی که سال تولید آن‌ها ۱۴۰۵ ثبت شده است نمایش داده می‌شوند.</p>
</section>

<div class="table-card">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>شناسه</th><th>نام ماشین</th><th>سال تولید</th><th>رنگ</th><th>قیمت</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($car = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= (int)$car["car_id"] ?></td>
                        <td><?= htmlspecialchars($car["car_name"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><span class="year-pill"><?= htmlspecialchars($car["car_model_year"], ENT_QUOTES, "UTF-8") ?></span></td>
                        <td><?= htmlspecialchars($car["car_color"], ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= htmlspecialchars($car["car_price"], ENT_QUOTES, "UTF-8") ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <span>🚗</span>
            <h2>هنوز ماشینی برای این سال ثبت نشده</h2>
            <p>می‌توانید یک ماشین با سال تولید ۱۴۰۵ ثبت کنید.</p>
            <a class="button button-primary" href="../cars_shop_project/insert_car.php">ثبت ماشین</a>
        </div>
    <?php endif; ?>
</div>
<?php
require "../cars_shop_project/footer.php";
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>