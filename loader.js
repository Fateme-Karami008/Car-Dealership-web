document.addEventListener("DOMContentLoaded", function () {
    const loader = document.getElementById("page-loader");
    const message = document.getElementById("loader-message");

    if (!loader) return;

    function showLoader(text) {
        if (message && text) message.textContent = text;
        loader.classList.remove("loader-hidden");
    }

    function hideLoader() {
        loader.classList.add("loader-hidden");
    }

    // صفحه اول تا زمان تکمیل منابع در حال بارگذاری می‌ماند.
    if (document.readyState === "complete") {
        hideLoader();
    } else {
        window.addEventListener("load", hideLoader, { once: true });
    }

    // نمایش لودر هنگام ارسال فرم‌های معتبر
    document.querySelectorAll("form").forEach(function (form) {
        form.addEventListener("submit", function () {
            if (!form.checkValidity()) return;

            const isSearch = form.querySelector('[name="search"]') !== null;
            showLoader(isSearch
                ? "در حال جست‌وجوی ماشین‌ها..."
                : "در حال ذخیره اطلاعات ماشین...");
        });
    });

    // نمایش لودر هنگام رفتن به صفحات داخلی سایت
    document.querySelectorAll("a[href]").forEach(function (link) {
        link.addEventListener("click", function (event) {
            const href = link.getAttribute("href");
            const target = link.getAttribute("target");
            const isModifiedClick = event.ctrlKey || event.metaKey ||
                event.shiftKey || event.altKey || event.button !== 0;

            if (
                !href ||
                href.startsWith("#") ||
                href.startsWith("javascript:") ||
                target === "_blank" ||
                link.hasAttribute("download") ||
                isModifiedClick
            ) {
                return;
            }

            // فقط لینک‌های همین سایت که در همین پنجره باز می‌شوند
            try {
                const destination = new URL(href, window.location.href);
                if (destination.origin !== window.location.origin) return;
            } catch (e) {
                return;
            }

            showLoader("در حال بارگذاری صفحه...");
        });
    });

    // اگر مرورگر صفحه را از حافظه بازگرداند، لودر نباید باقی بماند.
    window.addEventListener("pageshow", function () {
        hideLoader();
    });
});