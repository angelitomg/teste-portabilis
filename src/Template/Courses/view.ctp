<?php $this->assign('title', __('Course') . ' # ' . $this->Number->format($course->id)); ?>

<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-graduation-cap"></i> 
        <?= __('Course Details') ?>
        <small class="pull-right"><?= __('Id') ?>: <?= $this->Number->format($course->id) ?></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-6 invoice-col">
      <dl class="dl-horizontal">
        <dt><?= __('Name') ?>: </dt> 
        <dd><?= h($course->name) ?><dd>
        <dt><?= __('Monthly Amount') ?>: </dt> 
        <dd><?= $this->Number->currency($course->monthly_amount) ?></dd>
        <dt><?= __('Registration Tax') ?>: </dt> 
        <dd><?= $this->Number->currency($course->registration_tax) ?></dd>
        <dt><?= __('Period') ?>: </dt> 
        <dd><?= $course->getPeriod($course->period) ?><dd>
      </dl>
    </tr>

    </div>
    <!-- /.col -->
    <div class="col-sm-6 invoice-col">
      <dl class="dl-horizontal">
        <dt><?= __('Duration') ?>: </dt> 
        <dd><?= h($course->duration) ?></dd>
        <dt><?= __('Created') ?>: </dt> 
        <dd><?= h($course->created) ?></dd>
        <dt><?= __('Modified') ?>:</dt> 
        <dd><?= h($course->modified) ?></dd>
      </dl>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  </section>