<nav class="navbar navbar-main navbar-expand-lg border-bottom">
  <div class="container">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main_nav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="index.php" class="nav-link">Home</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-md-auto">
        <?php
        //Display logout if logged in
        if (isset($_SESSION['email'])) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="home.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
          <?php
            }else{
              ?>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
              <?php
            }
        ?>
          <li class="nav-item">
                  <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a>
          </li>
      </ul>
    </div> <!-- collapse .// -->
  </div> <!-- container .// -->
</nav>
</div> <!-- container.// -->
</header> <!-- section-header.// -->