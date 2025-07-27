<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Details</title>
  <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
    }
    img {
      max-width: 100%;
      height: auto;
      object-fit: contain;
    }
    .preview {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .preview-pic {
      max-height: 450px;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      background: #fff;
    }
    .preview-pic img {
      width: 100%;
      max-height: 450px;
      object-fit: contain;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card {
      background: #f8f9fa;
      padding: 2em;
    }
    .product-title, .price, .sizes, .colors {
      text-transform: uppercase;
      font-weight: bold;
    }
    .checked {
      color: #ff9f1a;
    }
    .add-to-cart, .like {
      background: #ff9f1a;
      padding: 1.2em 1.5em;
      border: none;
      text-transform: uppercase;
      font-weight: bold;
      color: #fff;
      transition: background .3s ease;
    }
    .add-to-cart:hover, .like:hover {
      background: #b36800;
    }
  </style>
</head>
<body>
<?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

<main role="main" class="container" style="margin-top: 120px;">
  <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
    <div id="message">&nbsp;</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

<?php
include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();

$id = intval($_GET['id'] ?? 0);
$sql = "SELECT id, name, price, description, stock_quantity, image_url, category FROM products WHERE id = $id";
$result = $conn->query($sql);
$prod = $result->fetch_array(MYSQLI_ASSOC);
$result->free_result();
$conn->close();
?>

  <div class="card">
    <div class="row">
      <div class="col-md-6 preview">
        <div class="preview-pic">
          <img src="<?= empty($prod['image_url']) ? '/Day6/assets/shared/img/default-image_600.png' : '/Day6/assets/' . htmlspecialchars($prod['image_url']) ?>" alt="Product Image">
        </div>
      </div>
      <div class="col-md-6 details">
        <h3 class="product-title"><?= htmlspecialchars($prod['name']) ?></h3>
        <div class="rating mb-2">
          <div class="stars">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
          </div>
          <span class="review-no">999 ratings</span>
        </div>
        <p class="product-description"><?= nl2br(htmlspecialchars($prod['description'])) ?></p>
        <h4 class="price">Price: <span><?= number_format($prod['price'], 0) ?> VND</span></h4>
        <input type="hidden" id="id" value="<?= $prod['id'] ?>">
        <input type="hidden" id="name" value="<?= htmlspecialchars($prod['name']) ?>">
        <input type="hidden" id="price" value="<?= $prod['price'] ?>">
        <input type="hidden" id="image_url" value="<?= htmlspecialchars($prod['image_url']) ?>">
        <input type="hidden" id="category" value="<?= htmlspecialchars($prod['category']) ?>">

        <div class="form-group mb-3">
          <label for="quantity">Quantity:</label>
          <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1">
        </div>
        <div class="action">
          <button class="add-to-cart btn" id="btnAddCart">Add to Cart</button>
          <a class="like btn btn-outline-secondary" href="#"><span class="fa fa-heart"></span></a>
        </div>
      </div>
    </div>
  </div>

  <div class="card mt-4">
    <div class="container-fluid">
      <h3>Product Details</h3>
      <div class="row">
        <div class="col">
          <p><?= nl2br(htmlspecialchars($prod['description'])) ?></p>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
<?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>

<script>
function handleAddCart() {
  var data = {
    id: $('#id').val(),
    name: $('#name').val(),
    price: $('#price').val(),
    image_url: $('#image_url').val(),
    category: $('#category').val(),
    quantity: $('#quantity').val()
  };
  console.log("Sending data:", data);

  $.ajax({
    url: '/Day6/frontend/pages/addCart.php',
    method: 'POST',
    dataType: 'json',
    data: data,
    success: function(response) {
      $('#message').html(`Product added to Cart. <a href="/Day6/frontend/pages/viewCart1.php">View Cart</a>.`);
      $('.alert').removeClass('d-none').addClass('show');
    },
    error: function(jqXHR, textStatus, errorThrown) {
      $('#message').html(`<h5>Vui lòng đăng nhập</h5>`);
      $('.alert').removeClass('d-none').addClass('show');
    }
  });
}

$('#btnAddCart').click(function(event) {
  event.preventDefault();
  handleAddCart();
});
</script>
</body>
</html>