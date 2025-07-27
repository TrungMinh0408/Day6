<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  <?php include_once(__DIR__ . '/../layouts/style.php'); ?>
</head>
<body>
  <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

  <div class="container-fluid">
    <div class="row">
      <?php include_once(__DIR__ . '/../layouts/partials/sidebar.php'); ?>

      <main id="main-content" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php include_once(__DIR__ . '/../layouts/partials/Dashboard.php'); ?>
      </main>
    </div>

    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
  </div>

  <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const links = document.querySelectorAll('.dynamic-load');

      links.forEach(link => {
        link.addEventListener('click', function (e) {
          e.preventDefault();
          const targetURL = this.getAttribute('data-url');

          fetch(targetURL)
            .then(response => response.text())
            .then(html => {
              document.getElementById('main-content').innerHTML = html;
            })
            .catch(error => {
              console.error("❌ Error loading content:", error);
              document.getElementById('main-content').innerHTML = '<p class="text-danger">Không thể tải nội dung.</p>';
            });
        });
      });
    });
  </script>
</body>
</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
