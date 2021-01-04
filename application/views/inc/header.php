<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="https://png.pngtree.com/element_our/sm/20180305/sm_5a9ce23cd1561.png" type="image/gif">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

  <title><?= $title?> - Beach Villas</title>
  <style>
    input.form-control[type="text"], select.form-control, input.form-control[type="number"]{
      background-color:#f2f2f2;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3 shadow-sm sticky-top">
      <a class="navbar-brand" href="/portfolio_projects/rentvillas">RentVillas</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/portfolio_projects/rentvillas/index">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/portfolio_projects/rentvillas/search">Search</a>
          </li>
        </ul>

        <?php if (!isset($_SESSION['loggedIn'])){?>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="/portfolio_projects/rentvillas/login/index">Login</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/portfolio_projects/rentvillas/register/index">Register</a>
          </li>
        </ul> 
        <?php } else { ?>
          <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
              <a class="nav-link" href="/portfolio_projects/rentvillas/login/logout">Logout <?= $_SESSION['username']; ?></a>
          </li>
          <li class="nav-item active">
              <a class="nav-link" href="/portfolio_projects/rentvillas/login/validation">User panel</a>
          </li>

          <?php if (isset($_SESSION['admin'])){?>
            <li class="nav-item active">
              <a class="nav-link" href="/portfolio_projects/rentvillas/adminPanel/index">Admin Panel</a>
          </li>
          <?php } ?>
          </ul> 
        <?php } ?>


      </div>
    </nav>

