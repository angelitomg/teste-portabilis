<?php $this->assign('title', __('Student') . ' # ' . $this->Number->format($student->id)); ?>

<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-users"></i> 
        <?= __('Student Details') ?>
        <small class="pull-right"><?= __('Id') ?>: <?= $this->Number->format($student->id) ?></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-6 invoice-col">
      <dl class="dl-horizontal">
        <dt><?= __('Name') ?>: </dt> 
        <dd><?= h($student->name) ?><dd>
        <dt><?= __('Document1') ?>: </dt> 
        <dd><?= h($student->document1) ?></dd>
        <dt><?= __('Document2') ?>: </dt> 
        <dd><?= h($student->document2) ?></dd>
        <dt><?= __('Birthdate') ?>:</dt> 
        <dd><?= h($student->birthdate) ?></dd>
      </dl>
    </tr>

    </div>
    <!-- /.col -->
    <div class="col-sm-6 invoice-col">
      <dl class="dl-horizontal">
        <dt><?= __('Phone') ?>: </dt> 
        <dd><?= h($student->phone) ?><dd>
        <dt><?= __('Created') ?>: </dt> 
        <dd><?= h($student->created) ?></dd>
        <dt><?= __('Modified') ?>:</dt> 
        <dd><?= h($student->modified) ?></dd>
      </dl>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  </section>