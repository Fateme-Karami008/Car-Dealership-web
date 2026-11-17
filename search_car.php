<?php
require "config.php";
$pageTitle = "جست‌وجوی ماشین";

$year = "";
$price = "";
$searched = false;
$result = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search"])) {
    $year = trim($_POST["car_model_year"] ?? "");
    $price = trim($_POST["car_price"] ?? "");
    $searched = true;

    if (!preg_match('/^[0-9]{4}$/', $year)) {
        $error = "سال تولید باید دقیقاً ۴ رقم انگلیسی باشد؛ مثلاً 1405.";
    } elseif ($price === "") {
        $error = "لطفاً قیمت را وارد کن.";
    } else {
        $sql = "SELECT car_id, car_name, car_model_year, car_color, car_price FROM Cars WHERE car_model_year = ? AND car_price = ? ORDER BY car_id DESC";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $year, $price);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
}

require "header.php";
?>
<section class="page-intro">
    <span class="eyebrow">پیداکردن ماشین موردنظر</span>
    <h1>جست‌وجوی <span>ماشین‌ها</span> 🔎</h1>
    <p>سال تولید و قیمت را وارد کن تا ماشین‌هایی که هر دو مشخصه را دارند پیدا شوند.</p>
</section>

<section class="form-card search-card">
    <form method="post" action="search_car.php" class="car-form search-form">
        <div class="form-field">
            <label for="car_model_year">سال تولید</label>
            <input id="car_model_year" name="car_model_year" type="text" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" placeholder="مثلاً 1405" value="<?= htmlspecialchars($year, ENT_QUOTES, "UTF-8") ?>" required>
        </div>
        <div class="form-field">
            <label for="car_price">قیمت</label>
            <input id="car_price" name="car_price" type="text" inputmode="numeric" maxlength="10" placeholder="مثلاً 850000" value="<?= htmlspecialchars($price, ENT_QUOTES, "UTF-8") ?>" required>
        </div>
        <button class="button button-primary" type="submit" name="search" value="1">جست‌وجو</button>
    </form>
</section>

<?php if ($error !== ""): ?>
    <div class="notice notice-error"><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></div>
<?php endif; ?>

<?php if ($searched && $error === ""): ?>
    <section class="results-section">
        <div class="section-heading">
            <div>
                <span class="eyebrow">نتیجه جست‌وجو</span>
                <h2>ماشین‌های مطابق با مشخصات</h2>
            </div>
        </div>
        <div class="table-card">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <div class="table-scroll">
                    <table>
                        <thead><tr><th>شناسه</th><th>نام ماشین</th><th>سال تولید</th><th>رنگ</th><th>قیمت</th></tr></thead>
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
                    <span>🛞</span>
                    <h2>نتیجه‌ای پیدا نشد</h2>
                    <p>سال تولید یا قیمت را بررسی کن و دوباره جست‌وجو کن.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php
require "footer.php";
if (isset($stmt) && $stmt) {
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>