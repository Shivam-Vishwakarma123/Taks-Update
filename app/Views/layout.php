<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>
    <?php
    if (session()->get('user_id') || session()->get('admin_id')):
      echo session()->get('admin_id') ? 'Task Manager Admin' : 'Task Manager';
    endif;
    ?>
  </title>

  <!-- Add CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/font.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/mdb.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/new-prism.css'); ?>">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />

  <style>
    @media (min-width: 1400px) {

      main,
      header,
      #main-navbar {
        padding-left: 240px;
      }
    }
  </style>
</head>

<body>
  <!-- Main Navigation -->
  <header>
    <!-- Sidenav -->
    <div id="sidenav-1" class="sidenav" role="navigation" data-hidden="false" data-accordion="true">
      <h2><a class="ripple d-flex justify-content-center py-4" href="/tasks" data-ripple-color="primary">Todo App</a></h2>

      <ul class="sidenav-menu">
        <li class="sidenav-item">
          <a class="sidenav-link" href="/tasks">
            <i class="fas fa-chart-area pr-3"></i><span>Task</span></a>
        </li>
        <li class="sidenav-item">
          <a class="sidenav-link" href="#">
            <i class="fas fa-chart-area pr-3"></i><span>Meetings</span></a>
        </li>
        <li class="sidenav-item">
          <a class="sidenav-link"><i class="fas fa-cogs pr-3"></i><span>Received Mail</span></a>
          <ul class="sidenav-collapse">
            <li class="sidenav-item">
              <a class="sidenav-link">Last Email</a>
            </li>
            <li class="sidenav-item">
              <a class="sidenav-link">Todays Urgent Mail</a>
            </li>
          </ul>
        </li>
        <li class="sidenav-item">
          <a class="sidenav-link"><i class="fas fa-lock pr-3"></i><span>Notifications</span></a>
          <ul class="sidenav-collapse">
            <li class="sidenav-item">
              <a class="sidenav-link">Mobile</a>
            </li>
            <li class="sidenav-item">
              <a class="sidenav-link">WhatsApp</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- Sidenav -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <div class="container-fluid">
        <!-- Toggler -->
        <button data-toggle="sidenav" data-target="#sidenav-1" class="btn shadow-0 p-0 mr-3 d-block d-xxl-none" aria-controls="#sidenav-1" aria-haspopup="true">
          <i class="fas fa-bars fa-lg"></i>
        </button>

        <!-- Search form -->
        <form class="d-none d-md-flex input-group w-auto my-auto">
          <input autocomplete="off" type="search" class="form-control rounded" placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
          <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
        </form>

        <!-- Right links -->
        <ul class="navbar-nav ml-auto d-flex flex-row">
          <p class="me-5 mt-2 text-dark font-weight-bold"><?= strtoupper(session()->get('username')) ?></p>
          <!-- Notification dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link mr-3 mr-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-bell"></i>
              <span class="badge rounded-pill badge-notification bg-danger">1</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Some news</a></li>
              <li><a class="dropdown-item" href="#">Another news</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>

          <!-- Avatar -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
              <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22" alt="" loading="lazy" />
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">My profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><?php if (session()->get('user_id') || session()->get('admin_id')): ?>
                  <a class="dropdown-item" href="<?= session()->get('admin_id') ? '/admin_logout' : '/logout' ?>">Logout</a>
                <?php endif; ?>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Navbar -->
  </header>
  <!-- Main Navigation -->

  <!-- Flash Message Display -->
  <?php if (session()->getFlashdata('message')): ?>
    <div class="position-fixed top-1 end-0 p-3" style="z-index: 1050;">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="position-fixed top-1 end-0 p-3" style="z-index: 1050;">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  <?php endif; ?>

  <!-- Main content -->
  <div class="container mt-5 pt-5">
    <?= $this->renderSection('content') ?>
  </div>

  <!-- Add JS -->
  <script src="<?= base_url('assets/js/custom.js'); ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/proper.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/jquery.js'); ?>"></script>
  <script src="<?= base_url('assets/js/dataTables.js'); ?>"></script>
  <script src="<?= base_url('assets/js/new-prism.js'); ?>"></script>
  <script src="<?= base_url('assets/js/mdbsnippet.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/mdb.min.js'); ?>"></script>

  <script>
    $('#usersTable').DataTable();

    $(".alert").each(function() {
      var $msg = $(this);
      setTimeout(function() {
        var alert = new bootstrap.Alert($msg[0]);
        alert.close();
      }, 200000);
    });
  </script>

  <!-- Custom scripts -->
  <script type="text/javascript">
    const sidenav = document.getElementById("sidenav-1");
    const instance = mdb.Sidenav.getInstance(sidenav);

    let innerWidth = null;

    const setMode = (e) => {
      // Check necessary for Android devices
      if (window.innerWidth === innerWidth) {
        return;
      }

      innerWidth = window.innerWidth;

      if (window.innerWidth < 1400) {
        instance.changeMode("over");
        instance.hide();
      } else {
        instance.changeMode("side");
        instance.show();
      }
    };

    setMode();

    // Event listeners
    window.addEventListener("resize", setMode);
  </script>

</body>

</html>