<?php use Cake\Core\Configure; ?>
<?php $params = $this->request->params; ?>
<?php $controller = $params['controller']; ?>
<?php $action = $params['action']; ?>
<?php $report = (isset($params['pass'][0]) && $params['pass'][0] == 'report') ? true : false; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= Configure::read('Sys.titleText') ?> | <?= $this->fetch('title') ?></title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?= $this->Url->build('/') ?>/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $this->Url->build('/') ?>/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= $this->Url->build('/') ?>/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $this->Url->build('/') ?>/adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->

  <link rel="icon" 
      type="image/png" 
      href="<?= $this->Url->build('/') ?>/webroot/favicon.png">
  <link rel="stylesheet" href="<?= $this->Url->build('/') ?>/adminlte/dist/css/skins/skin-blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?= $this->Url->build('/') ?>/adminlte/extra/js/html5shiv.min.js"></script>
  <script src="<?= $this->Url->build('/') ?>/adminlte/extra/js/respond.min.js"></script>
  <![endif]-->
  
  <!-- REQUIRED JS SCRIPTS -->

  <script src="<?= $this->Url->build('/') ?>/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?= $this->Url->build('/') ?>/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- AdminLTE App -->
  <script src="<?= $this->Url->build('/') ?>/adminlte/dist/js/adminlte.min.js"></script>

  
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?= $this->Url->build('/') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?= Configure::read('Sys.titleShort') ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?= Configure::read('Sys.titleHTML') ?></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only"><?= __('Toggle navigation') ?></span>
      </a>
      <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <li class="dropdown user user-menu open">
        <a href="#">
          <span><?= date('d/m/Y') ?></span>
        </a>
        
      </li>
    </ul>
  </div>
    </nav>
  

  
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">

        <li <?php if ($controller == 'Students') echo 'class="active"'; ?>>
          <a href="<?= $this->Url->build(['controller' => 'Students', 'action' => 'index']) ?>">
            <i class="fa fa-users"></i> <span><?= __('Students') ?></span>
          </a>
        </li>

        <li <?php if ($controller == 'Courses') echo 'class="active"'; ?>>
          <a href="<?= $this->Url->build(['controller' => 'Courses', 'action' => 'index']) ?>">
            <i class="fa fa-graduation-cap"></i> <span><?= __('Courses') ?></span>
          </a>
        </li>

        <li <?php if ($controller == 'Registrations') echo 'class="active"'; ?>>
          <a href="<?= $this->Url->build(['controller' => 'Registrations', 'action' => 'index']) ?>">
            <i class="fa fa-files-o"></i> <span><?= __('Registrations') ?></span>
          </a>
        </li>

        <li <?php if ($controller == 'RegistrationPayments') echo 'class="active"'; ?>>
          <a href="<?= $this->Url->build(['controller' => 'RegistrationPayments', 'action' => 'index']) ?>">
            <i class="fa fa-dollar"></i> <span><?= __('RegistrationPayments') ?></span>
          </a>
        </li>

        <li <?php if ($controller == 'Users') echo 'class="active"'; ?>>
          <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">
            <i class="fa fa-unlock-alt"></i> <span><?= __('Users') ?></span>
          </a>
        </li>

        <li>
          <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">
            <i class="fa fa-sign-out"></i> <span><?= __('Logout') ?></span>
          </a>
        </li>
    
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php if ($action != 'view'): ?>
        <h1>
          <?= $this->fetch('title'); ?>
          <small><?= $this->fetch('description'); ?></small>
        </h1> 
      <?php endif; ?>
    </section>
    
    <section style="margin: 1em;">
        <?= $this->Flash->render() ?>
      </section>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
    <?= $this->fetch('content') ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      &nbsp;
    </div>
    <!-- Default to the left -->
    <strong> 
    <a target="_blank" href="http://amglabs.net"><i class="fa fa-flask"></i>MG Labs</a>
  </strong>
  </footer>

</div>
<!-- ./wrapper -->

</body>
</html>