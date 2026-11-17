<?php
require "config.php";

$pageTitle = "ثبت ماشین";
$success = false;
$error = "";

$name = $year = $color = $price = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit_car"])) {
    $name = trim($_POST["car_name"] ?? "");
    $year = trim($_POST["car_model_year"] ?? "");
    $color = trim($_POST["car_color"] ?? "");
    $price = trim($_POST["car_price"] ?? "");

    if ($name === "" || $year === "" || $color === "" || $price === "") {
        $error = "لطفاً همه فیلدها را تکمیل کن.";
    } elseif (!preg_match('/^[0-9]{4}$/', $year)) {
        $error = "سال تولید باید دقیقاً ۴ رقم انگلیسی باشد؛ مثلاً 1405.";
    } elseif (mb_strlen($name, "UTF-8") > 50 || mb_strlen($color, "UTF-8") > 10 || strlen($price) > 10) {
        $error = "طول یکی از ورودی‌ها بیشتر از حد مجاز است.";
    } else {
        $sql = "INSERT INTO Cars (car_name, car_model_year, car_color, car_price) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $year, $color, $price);

        if (mysqli_stmt_execute($stmt)) {
            $success = true;
            $name = $year = $color = $price = "";
        } else {
            $error = "ثبت ماشین انجام نشد. لطفاً دوباره تلاش کن.";
        }
        mysqli_stmt_close($stmt);
    }
}

require "header.php";
?>
<section class="page-intro">
    <span class="eyebrow">افزودن به بانک اطلاعاتی</span>
    <h1>ثبت ماشین جدید <span>🚘</span></h1>
    <p>مشخصات ماشین را در فرم زیر وارد کن.</p>
</section>

<?php if ($success): ?>
    <div class="notice notice-success">✓ ماشین با موفقیت در بانک اطلاعاتی ذخیره شد.</div>
<?php endif; ?>
<?php if ($error !== ""): ?>
    <div class="notice notice-error"><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></div>
<?php endif; ?>

<section class="form-card">
    <form method="post" action="insert_car.php" class="car-form">
        <div class="form-field">
            <label for="car_name">نام ماشین</label>
            <input id="car_name" name="car_name" type="text" maxlength="50" placeholder="مثلاً سمند" value="<?= htmlspecialchars($name, ENT_QUOTES, "UTF-8") ?>" required>
        </div>
        <div class="form-field">
            <label for="car_model_year">سال تولید</label>
            <input id="car_model_year" name="car_model_year" type="text" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" placeholder="مثلاً 1405" value="<?= htmlspecialchars($year, ENT_QUOTES, "UTF-8") ?>" required>
        </div>
        <div class="form-field">
            <label for="car_color">رنگ ماشین</label>
            <input id="car_color" name="car_color" type="text" maxlength="10" placeholder="مثلاً سفید" value="<?= htmlspecialchars($color, ENT_QUOTES, "UTF-8") ?>" required>
        </div>
        <div class="form-field">
            <label for="car_price">قیمت</label>
            <input id="car_price" name="car_price" type="text" maxlength="10" inputmode="numeric" placeholder="مثلاً 850000" value="<?= htmlspecialchars($price, ENT_QUOTES, "UTF-8") ?>" required>
        </div>
        <button class="button button-primary button-full" type="submit" name="submit_car" value="1">ذخیره ماشین</button>
    </form>
</section>
<?php
require "footer.php";
mysqli_close($conn);
?>