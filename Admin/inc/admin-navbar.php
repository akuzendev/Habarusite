<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
    <img src="../../../h4/assets/Logo-dark.png" height="30" class="d-inline-block align-top"
      alt="mdb logo"><b class="ms-2">Habarusite - Admin</b>
  </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="AdminDashboard.php" aria-current="page">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Consoles
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="UsersDashboard.php">Users Console</a></li>
            <li><a class="dropdown-item" href="ArticleDashboard.php">Article Console</a></li>
            <li><a class="dropdown-item" href="TimelinesDashboard.php">Timelines Console</a></li>
            <li><a class="dropdown-item" href="CommentsDashboard.php">Comments Console</a></li>
            <li><a class="dropdown-item" href="ReportsDashboard.php">Reports Console</a></li>
            <li><a class="dropdown-item" href="AppSettings.php">Application Settings Console</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="AdminSettings.php" aria-current="page">Settings</a>
        </li>
      </ul>
    </div>
    <form class="d-flex">
        <?php ?>
        <?php echo  '<p class="m-2">@'.$_SESSION['username'].'</p>' ;?>
        <a class="btn btn-danger" href="../php/logout.php">Logout</a>
    </form>
  </div>
</nav>