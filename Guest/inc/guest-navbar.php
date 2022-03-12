<?php
include_once('../../php/Database.php');

try{
    $getdynamiccatergories = new Database();
    $chksql = "SELECT * FROM app_catergories";
    $chkarg = null;
    $res = $getdynamiccatergories->executesql('selectall',$chksql,$chkarg);
}catch(Exception $e){
    return 'An error occured with catergory'.$e;
}

?>

<!--Navbar-->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark primary-color">

<a class="navbar-brand" href="#">
    <img src="../../../h4/assets/Logo.png" height="30" class="d-inline-block align-top"
      alt="mdb logo"><b class="ml-1">Habarusite</b>
  </a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="Home.php">Home
        </a>
      </li>

            <!-- Dropdown -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Catergories</a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">

            <?php 
                foreach($res as $catergory){
                    echo "<a class='dropdown-item' href='Articles.php?catergoryid=".$catergory['id']."'>".$catergory['name']."</a>";
                }
            ?>
        <!--

        -->
        </div>
      </li>

      
      <li class="nav-item">
        <a class="nav-link" href="Timelines.php">Timelines</a>
      </li>

    </ul>
    <!-- Links -->


      <div class="md-form my-0">
          <a class="btn btn-success" href="Login.php">Login</a>
          <a class="btn btn-secondary" href="Register.php">Register</a>

      </div>

  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->