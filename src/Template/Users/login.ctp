<?php use Cake\Core\Configure; ?>
<?php $this->assign('title', __('Login')); ?>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= $this->Url->build('/') ?>/adminlte/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?= $this->Url->build('/') ?>/adminlte/extra/js/html5shiv.min.js"></script>
  <script src="<?= $this->Url->build('/') ?>/adminlte/extra/js/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= $this->Url->build('/') ?>"><?= Configure::read('Sys.titleHTML') ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?= __('Sign in to start your session') ?></p>

    <?= $this->Form->create(); ?>
      <!--<?= $this->Flash->render() ?>-->
      <div class="form-group has-feedback">
    <?= $this->Form->control('username', ['placeholder' => __('Username'), 'label' => false, 'class' => 'form-control']) ?>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?= $this->Form->control('password', ['placeholder' => __('Password'), 'label' => false, 'class' => 'form-control']) ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?= __('Sign In') ?></button>
        </div>
        <!-- /.col -->
      </div>
    <?= $this->Form->end() ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="<?= $this->Url->build('/') ?>/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= $this->Url->build('/') ?>/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>