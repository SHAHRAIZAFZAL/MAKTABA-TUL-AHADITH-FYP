<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';
$stmt = "SELECT * FROM biographies";
$result = $conn->query($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Biographies page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biographies - مكتبة الأحاديث</title>
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
        <?php include SITE_PATH . '/header-aside.php'; ?>
        <main>
            <div class="main">
                <article class="container container-major">
                    <img src="<?php echo BASE_URL ?>images/biography-background.png" alt="Biographies Icon" height="600"
                        width="600" title="Biographies Section">
                    <h2 class="langDiv langDiv-en">Biographies</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">سوانح حیات</h2>
                    <img src="<?php echo BASE_URL ?>images/biography-background.png" alt="Biographies Icon" height="600"
                        width="600" title="Biographies Section">
                </article>

                <article class="container container-without-pad-bg biographies-container">
                    <form action="" method="get" id="bio-form">
                        <?php
                        $totalCount = $result->num_rows;
                        $rowCount = 1;
                        while ($row = $result->fetch_assoc()):
                            $bioID = htmlspecialchars($row['bio_id']);
                            $bioNameEn = htmlspecialchars($row['bio_name_en']);
                            $bioNameUr = htmlspecialchars($row['bio_name_ur']);
                            $bioImage = htmlspecialchars($row['bio_image']);
                            $bioNameDashed = str_replace(" ", "-", $bioNameEn);
                            if ($bioID == 1 || $bioID == 2 || $bioID == 6) {
                                echo "<div>";
                            }
                            ?>
                            <a class="biography-links"
                                href="<?php echo BASE_URL . "biographies/biography.php?bioID=" . $bioID . "&bioName=" . $bioNameDashed ?>">
                                <img src="images/bio-images/<?php echo $bioImage ?>.png" title="<?php echo $bioNameEn ?>"
                                    alt="<?php echo $bioNameEn ?> Calligraphy" height="180" width="180">
                                <div>
                                    <p class="langDiv langDiv-en fontDiv fontDiv-s">
                                        <?php echo $bioNameEn ?>
                                    </p>
                                    <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">
                                        <?php echo $bioNameUr ?>
                                    </p>
                                </div>
                            </a>
                            <?php if ($bioID == 1 || $bioID == 5 || $rowCount === $totalCount) {
                                echo "</div>";
                            }
                            $rowCount++;
                        endwhile ?>
                    </form>
                </article>

            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>