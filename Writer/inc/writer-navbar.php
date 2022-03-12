<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
    <img src="../../../h4/assets/Logo-dark.png" height="30" class="d-inline-block align-top"
      alt="mdb logo"><b class="ms-2">Habarusite - Writer</b>
  </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="WDashboard.php" aria-current="page">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
          </a>
         
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="WYArticle.php">Your Articles</a></li>
            <li><a class="dropdown-item" href="WAddArticle.php"><p class="btn btn-info mt-2">Add New Article</p></a></li>
          </ul>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="WSettings.php" aria-current="page">Settings</a>
        </li>
      </ul>
    </div>
    <form class="d-flex">
        <?php echo  '<p class="m-2">@'.$_SESSION['username'].'</p>' ;?>
        <a class="btn btn-danger" href="../php/logout.php">Logout</a>
    </form>
  </div>
</nav>