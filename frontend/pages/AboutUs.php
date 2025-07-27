<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>
<body>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

    <div class="container my-5 d-flex flex-column align-items-center justify-content-center text-center">
        <h2 class="mb-4">HUTECH</h2>
        <p><strong>475A Điện Biên Phủ, Quận Bình Thạnh, TP.HCM</strong></p>
        <div class="ratio ratio-16x9" style="max-width: 800px; width: 100%;">
            <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.065990517477!2d106.71304817490543!3d10.804896858723876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528c244af4c8d%3A0xd3b7cf7b2bd6e5f5!2zSFRVVEVDSCAtIEPGsOG7n25nIHPhu5EgQSAtIDQ3NUEgxJDDtG5nIELDrG5oIFBo4bqldQ!5e0!3m2!1svi!2s!4v1721721159123!5m2!1svi!2s" 
            width="600" height="450" style="border:0;" 
            allowfullscreen="" loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
        <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
        <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>
</html>