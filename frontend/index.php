<?php
session_start();
$page = $_GET['page'] ?? 'home';
$allowedPages = ['home', 'viewCart'];

if (!in_array($page, $allowedPages)) {
    $page = 'home';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Day6</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include_once(__DIR__ . '/layouts/styles.php'); ?>
    </head>
    <body class="d-flex flex-column min-vh-100">

        <?php include_once(__DIR__ . '/layouts/partials/header.php'); ?>

        <?php
        $paths = [
            'home' => __DIR__ . '/layouts/partials/home.php',
            'viewCart' => __DIR__ . '/pages/viewCart.php'
        ];

        if (array_key_exists($page, $paths)) {
            include_once($paths[$page]);
        } else {
            include_once($paths['home']);
        }
        ?>


        <?php include_once(__DIR__ . '/layouts/partials/footer.php'); ?>
        <?php include_once(__DIR__ . '/layouts/scripts.php'); ?>

        <script>
        $(document).ready(function () {
          $('.btn-add-cart').click(function (e) {
            e.preventDefault();

            const id = $(this).data('id');
            const name = $(this).data('name');
            const price = $(this).data('price');
            const image_url = $(this).data('image');

            
            const data = {
              id,
              name,
              price,
              image_url,
              quantity: 1
            };

            $.ajax({
              url: '/Day6/frontend/api/add_cart_item.php',
              method: 'post',
              dataType: 'json',
              data: data,
              success: function (res) {
                alert('Add product to cart success.');
                console.log(res);
              },
              error: function (jqXHR, textStatus, errorThrown) {
                alert("Add to cart failed: " + textStatus);
                console.log(errorThrown);
              }
            });
          });
        });
        </script>


        
    </body>
</html>
