<nav
      class="navbar navbar-expand-lg bg-warning navbar-light shadow-sm">
      <div class="container-fluid mb-2">
        <a class="navbar-brand" href="index.php">
          <?php echo "<img src='azjov.png' width='30' height='24' />";?>
          Azjovi Bakery
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="chart.php">Chart</a>
            </li>

          <!-- jika sudah login -->
          <?php if (isset($_SESSION['pelanggan'])): ?>
                <li><a class="nav-link" href="riwayat.php">Riwayat Belanja</a></li>
                <li><a class="nav-link" href="logout.php">Logout</a></li>

          <!-- jika belum login -->
            <?php else: ?>
                <li><a class="nav-link" href="login.php">Login</a></li>
                <li><a class="nav-link" href="registration.php">Daftar</a></li>
            <?php endif ?>
            <li><a class="nav-link" href="checkout.php">Checkout</a></li>
          </ul>
          

          <form action="pencarian.php" method="get" class="d-flex" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Cari kue"
              name ="keyword"
            />
            <button class="btn btn-outline-dark" type="submit">
              Cari
            </button>
          </form>

        </div>
      </div>
    </nav>