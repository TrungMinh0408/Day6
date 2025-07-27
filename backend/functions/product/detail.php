<?php
include_once(__DIR__ . '/../../dbConnect.php');
$conn = connectDb();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID sản phẩm không hợp lệ!";
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Không tìm thấy sản phẩm.";
    exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Product Detail</title>
  <?php include_once(__DIR__ . '/../../layout/style.php'); ?>
</head>
<body>
<?php include_once(__DIR__ . '/../../layout/partials/header.php'); ?>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-3">
      <?php include_once(__DIR__ . '/../../layout/partials/sitebar.php'); ?>
    </div>
    <div class="col-md-9">
      <h3 class="mb-4 text-center">Detail</h3>
      <div class="card">
        <div class="row g-0">
          <div class="col-md-5">
            <img src="/Day6/assets/<?php echo htmlspecialchars($product['image_url']); ?>" 
                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                 class="img-fluid rounded-start">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
              <p class="card-text"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
              <p class="card-text"><strong>Giá:</strong> 
                <span class="text-danger fw-bold">
                  <?php echo number_format($product['price'], 0, ',', '.'); ?> đ
                </span>
              </p>
              <p class="card-text"><strong>Ngày tạo:</strong> <?php echo $product['create_at']; ?></p>
              <a href="../product/index.php" class="btn btn-secondary mt-3">Quay lại danh sách</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once(__DIR__ . '/../../layout/partials/footer.php'); ?>
<?php include_once(__DIR__ . '/../../layout/scripts.php'); ?>
</body>
</html>