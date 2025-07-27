<nav class="col-md-2 d-none d-md-block bg-light sidebar border-end">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">

      <!-- ########## Admin Section ########## -->
      <li class="nav-item sidebar-heading px-3 text-muted text-uppercase small fw-bold">Admin</li>
      <li class="nav-item">
        <a href="/Day6/backend/pages/index.php" class="nav-link px-3">
          <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
      </li>

      <hr class="my-2" />

      <!-- ########## Product Section ########## -->
      <li class="nav-item sidebar-heading px-3 text-muted text-uppercase small fw-bold">Product</li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle px-3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-box-seam me-2"></i> Product
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item dynamic-load" data-url="/Day6/backend/functions/product/productlist.php" href="#">Product List</a></li>
          <li><a class="dropdown-item dynamic-load" data-url="/Day6/backend/functions/product/create.php" href="#">Create</a></li>
        </ul>
      </li>

       <!-- ########## Orders Section ########## -->
      <li class="nav-item sidebar-heading px-3 text-muted text-uppercase small fw-bold mt-4">Orders</li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle px-3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-receipt-cutoff me-2"></i> Orders
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item dynamic-load" data-url="/Day6/backend/functions/orders/orderslist.php" href="#">Orders List</a></li>
        </ul>
      </li>

      <!-- ########## User Section ########## -->
      <li class="nav-item sidebar-heading px-3 text-muted text-uppercase small fw-bold mt-4">User</li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle px-3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-people me-2"></i> User
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item dynamic-load" data-url="/Day6/backend/functions/user/userlist.php" href="#">User List</a></li>
          <li><a class="dropdown-item dynamic-load" data-url="/Day6/backend/functions/user/createuser.php" href="#">Create</a></li>
        </ul>
      </li>

    </ul>
  </div>
</nav>

