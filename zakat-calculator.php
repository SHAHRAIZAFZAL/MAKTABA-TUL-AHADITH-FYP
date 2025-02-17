<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $goldRate = $_POST['gold-rate'];
    $silverRate = $_POST['silver-rate'];
    $nisabType = $_POST['choose-nisab'];
    $valueCash = $_POST['cash-value'];
    if ($valueCash === '')
        $valueCash = 0;
    $valueProperty = $_POST['property-value'];
    if ($valueProperty === '')
        $valueProperty = 0;
    $valueGold = $_POST['gold-value'];
    if ($valueGold === '')
        $valueGold = 0;
    $valueSilver = $_POST['silver-value'];
    if ($valueSilver === '')
        $valueSilver = 0;
    $debts = $_POST['debts-value'];
    if ($debts === '')
        $debts = 0;
    $liabilities = $_POST['liabilities-value'];
    if ($liabilities === '')
        $liabilities = 0;

    $nisabAmount = 0;
    if ($nisabType == 'gold') {
        $nisabAmount = $goldRate * 7.5;
    } else if ($nisabType == 'silver') {
        $nisabAmount = $silverRate * 52.5;
    }

    $totalAssets = $valueCash + $valueProperty + $valueGold + $valueSilver;
    $totalDeductions = $debts + $liabilities;
    $netAmount = $totalAssets - $totalDeductions;

    $payableZakat = 0;
    if ($netAmount >= $nisabAmount) {
        $payableZakat = $netAmount * 0.025;
        $payableZakat = number_format($payableZakat, 2, '.', ',');
    }
} else {
    $payableZakat = 0;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Zakat Calculator page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zakat Calculator - مكتبة الأحاديث</title>
    <link rel="icon" href="<?php echo BASE_URL ?>images/logo-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>style.css">
    <noscript>
        <style>
            .page-container {
                display: none;
            }
        </style>
        <div class="no-javascript-div">
            You don't have javascript enabled. Please enable to continue with the website.
        </div>
    </noscript>
</head>

<body>
    <div class="page-container">
        <?php include SITE_PATH . '/header-aside.php' ?>
        <main>
            <div class="main">
                <article class="container container-major">
                    <img src="<?php echo BASE_URL ?>images/zakat-calculator-background.png" alt="Zakat Calculator Icon"
                        height="600" width="600" title="Zakat Calculator Section">
                    <h2 class="langDiv langDiv-en">Zakat Calculator</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">زکوٰۃ کیلکولیٹر</h2>
                    <img src="<?php echo BASE_URL ?>images/zakat-calculator-background.png" alt="Zakat Calculator Icon"
                        height="600" width="600" title="Zakat Calculator Section">
                </article>

                <article class="container">
                    <div class="zakat-payable">
                        <p class="langDiv langDiv-en fontDiv fontDiv-m">Payable Zakat = <span>
                                <?php echo htmlspecialchars($payableZakat) ?>
                            </span></p>
                        <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">قابلِ ادائیگی زکوٰۃ = <span>
                                <?php echo htmlspecialchars($payableZakat) ?>
                            </span></p>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post"
                        class="zakat-form">
                        <div class="zakat-form__div flex-row">
                            <div class="zakat-form__heading">
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Enter Gold & Silver Rates</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">سونا اور چاندی کے
                                    ریٹ
                                    لکھیں</span>
                            </div>
                            <div class="flex-column">
                                <label for="gold-rate">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Gold Price per Tola (11.67
                                        g)</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">ایک تولہ سونے
                                        کی
                                        قیمت (11.67
                                        گرام)</span>
                                </label>
                                <input required class="input-without-label fontDiv fontDiv-m" type="number"
                                    id="gold-rate" name="gold-rate" placeholder="Enter Price..." autocomplete="on">
                            </div>
                            <div class="flex-column">
                                <label for="silver-rate">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Silver Price per Tola (11.67
                                        g)</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">ایک تولہ
                                        چاندی کی
                                        قیمت (11.67
                                        گرام)</span>
                                </label>
                                <input required class="input-without-label fontDiv fontDiv-m" type="number"
                                    id="silver-rate" name="silver-rate" placeholder="Enter Price..." autocomplete="on">
                            </div>
                        </div>
                        <div class="zakat-form__div flex-row">
                            <div class="zakat-form__heading">
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Choose Nisab</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">نصاب منتخب
                                    کریں</span>
                            </div>
                            <div>
                                <input required type="radio" id="gold-nisab" name="choose-nisab" value="gold">
                                <label for="gold-nisab">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">7.5 Tola Gold (87.48 g)</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">ساڑھے سات
                                        تولے
                                        سونا (87.48
                                        گرام)</span>
                                </label>
                            </div>
                            <div>
                                <input required type="radio" id="silver-nisab" name="choose-nisab" value="silver">
                                <label for="silver-nisab">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">52.5 Tola Silver (612.36
                                        g)</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">ساڑھے باون
                                        تولے
                                        چاندی (612.36
                                        گرام)</span>
                                </label>
                            </div>
                        </div>
                        <div class="zakat-form__div flex-row">
                            <div class="zakat-form__heading">
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Cash, Properties, Investments</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">نقد، جائیداد،
                                    سرمایہ</span>
                            </div>
                            <div class="flex-column">
                                <label for="gold-rate">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Cash Money</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">نقد
                                        رقم</span>
                                </label>
                                <input class="input-without-label fontDiv fontDiv-m" type="number" id="cash-value"
                                    name="cash-value" placeholder="Enter Value...">
                            </div>
                            <div class="flex-column">
                                <label for="silver-rate">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Property Value</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">جائیداد کی
                                        قیمت</span>
                                </label>
                                <input class="input-without-label fontDiv fontDiv-m" type="number" id="property-value"
                                    name="property-value" placeholder="Enter Value...">
                            </div>
                        </div>
                        <div class="zakat-form__div flex-row">
                            <div class="zakat-form__heading">
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Gold & Silver</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">سونا اور
                                    چاندی</span>
                            </div>
                            <div class="flex-column">
                                <label for="gold-value">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Gold Value</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">سونے کی
                                        قیمت</span>
                                </label>
                                <input class="input-without-label fontDiv fontDiv-m" type="number" id="gold-value"
                                    name="gold-value" placeholder="Enter Value...">
                            </div>
                            <div class="flex-column">
                                <label for="silver-value">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Silver Value</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">چاندی کی
                                        قیمت</span>
                                </label>
                                <input class="input-without-label fontDiv fontDiv-m" type="number" id="silver-value"
                                    name="silver-value" placeholder="Enter Value...">
                            </div>
                        </div>
                        <div class="zakat-form__div flex-row">
                            <div class="zakat-form__heading">
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Debts & Liabilities</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">قرض اور
                                    واجبات</span>
                            </div>
                            <div class="flex-column">
                                <label for="debts-value">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Debts & Borrowed Amount</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">قرض اور ادھار
                                        رقم</span>
                                </label>
                                <input class="input-without-label fontDiv fontDiv-m" type="number" id="debts-value"
                                    name="debts-value" placeholder="Enter Value...">
                            </div>
                            <div class="flex-column">
                                <label for="liabilities-value">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Payments Due Immediately</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">فوری واجب
                                        الادا
                                        رقم</span>
                                </label>
                                <input class="input-without-label fontDiv fontDiv-m" type="number"
                                    id="liabilities-value" name="liabilities-value" placeholder="Enter Value...">
                            </div>
                        </div>
                        <div class="flex-row">
                            <button class="button-type-1 zakat-calculate-btn hover-effect" type="submit">
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Calculate</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">حساب
                                    لگائیں</span>
                            </button>
                        </div>
                    </form>
                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php'; ?>
    </div>
    <script src="<?php echo BASE_URL; ?>script.js"></script>
</body>

</html>