<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

$bioID = htmlspecialchars($_GET["bioID"]);
$bioNameDashed = htmlspecialchars($_GET["bioName"]);
$stmt = $conn->prepare("SELECT * FROM biographies WHERE bio_id = ?");
$stmt->bind_param("i", $bioID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$row = $result->fetch_assoc();

$bioNameEn = htmlspecialchars($row['bio_name_en']);
$bioNameUr = htmlspecialchars($row['bio_name_ur']);
$bioImage = htmlspecialchars($row['bio_image']);
$bioContentEn = htmlspecialchars($row['bio_content_en']);
$bioContentUr = htmlspecialchars($row['bio_content_ur']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description"
        content="Biography of <?php echo $bioNameEn ?>, in the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $bioNameEn . " " ?> - مكتبة الأحاديث
    </title>
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
                    <img src="<?php echo BASE_URL . "images/bio-images/" . $bioImage ?>.png"
                        title="<?php echo $bioNameEn ?>" alt="<?php echo $bioNameEn ?> Calligraphy" height="600"
                        width="600">
                    <h2 class="langDiv langDiv-en">
                        <?php echo $bioNameEn ?>
                    </h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">
                        <?php echo $bioNameUr ?>
                    </h2>
                    <img src="<?php echo BASE_URL . "images/bio-images/" . $bioImage ?>.png"
                        title="<?php echo $bioNameEn ?>" alt="<?php echo $bioNameEn ?> Calligraphy" height="600"
                        width="600">
                </article>

                <article class="container less-width justify">
                    <p class="langDiv langDiv-en english-text fontDiv fontDiv-m">
                        <?php echo nl2br($bioContentEn) ?>
                    </p>
                    <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">
                        <?php echo nl2br($bioContentUr) ?>
                    </p>
                </article>

                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>