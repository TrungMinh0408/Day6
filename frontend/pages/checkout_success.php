<?php
session_start();
if (!isset($_SESSION['order_just_placed'])) {
    header("Location: /Day6/frontend/index.php");
    exit;
}
unset($_SESSION['order_just_placed']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>
<body class="d-flex flex-column min-vh-100">
<?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

<main class="container mt-5">
    <h2>Thank you for your order!</h2>
    <p>We are processing your order. You will be redirected shortly.</p>
    <a href="/Day6/frontend/index.php" class="btn btn-primary">Back to Home</a>
</main>

<?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
<?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>

<script>
    function showNotification() {
        if ("Notification" in window) {
            if (Notification.permission === "granted") {
                new Notification(" Đặt hàng thành công!", {
                    body: "Cảm ơn bạn đã mua hàng tại cửa hàng chúng tôi.",
                    icon: "/Day6/assets/images/success-icon.png" 
                });
            } else if (Notification.permission !== "denied") {
                Notification.requestPermission().then(function (permission) {
                    if (permission === "granted") {
                        new Notification(" Đặt hàng thành công!", {
                            body: "Cảm ơn bạn đã mua hàng tại cửa hàng chúng tôi."
                        });
                    }
                });
            }
        } else {
            alert("Đặt hàng thành công!");
        }
    }

    window.onload = showNotification;
</script>

</body>
</html>
