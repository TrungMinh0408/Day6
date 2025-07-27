<!-- home.php -->
<!-- Carousel -->
<div id="myCarousel" class="carousel slide mb-5" data-bs-ride="carousel" style="margin-top: 80px;">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/Day6/assets/images/img1.png" class="d-block w-100" alt="Banner">
    </div>
  </div>
</div>

<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();
$sql = "SELECT * FROM products LIMIT 6";
$result = $conn->query($sql);
?>

<div class="container marketing mt-5">
  <div class="row text-center mb-4">
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="col-lg-4 mb-4">
        <img src="/Day6/assets/<?= $row['image_url'] ?>" 
             alt="<?= $row['name'] ?>" 
             class="img-fluid" 
             style="height: 200px; object-fit: cover;">
        <h2><?= $row['name'] ?></h2>
        <p><?= $row['description'] ?></p>
        <p><strong><?= number_format($row['price'], 0) ?>₫</strong></p>
        <p>
          <a class="btn btn-outline-primary" 
             href="/Day6/frontend/pages/productDetail.php?id=<?= $row['id'] ?>">
            Chi tiết
          </a>
        </p>
        <button class="btn btn-primary btn-add-cart"
                data-id="<?= $row['id'] ?>"
                data-name="<?= $row['name'] ?>"
                data-price="<?= $row['price'] ?>"
                data-image="<?= $row['image_url'] ?>">
          Add to Cart
        </button>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<style>
.carousel-item img {
  width: 100%;
  height: 300px;
  object-fit: cover;
}
</style>
