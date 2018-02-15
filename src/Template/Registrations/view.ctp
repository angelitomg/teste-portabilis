<?php $this->assign('title', __('Registration') . ' # ' . $this->Number->format($registration->id)); ?>

<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-files-o"></i> 
        <?= __('Registration') ?>
        <small class="pull-right"><?= __('Id') ?>: <?= $this->Number->format($registration->id) ?></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-6 invoice-col">
      <dl class="dl-horizontal">
        <?php if ($registration->has('course')): ?>
            <dt><?= __('Course') ?>: </dt> 
            <dd><?= h($registration->course->name) ?><dd>
            <dt><?= __('Period') ?>: </dt> 
            <dd><?= $registration->course->getPeriod($registration->course->period); ?><dd>
            <dt><?= __('Registration Tax') ?>: </dt> 
            <dd><?= $this->Number->currency($registration->course->registration_tax) ?><dd>
            <dt><?= __('Monthly Amount') ?>: </dt> 
            <dd><?= $this->Number->currency($registration->course->monthly_amount) ?><dd>
            <dt><?= __('Duration') ?>: </dt> 
            <dd><?= h($registration->course->duration) ?><dd>
            <dt><?= __('Year') ?>: </dt> 
            <dd><?= h($registration->year) ?></dd>
            <dt><?= __('Status') ?>: </dt> 
            <dd>
              <?php if ($registration->active): ?>
                <span class="text-green"><?= __('Active') ?></span>
              <?php else: ?>
                <span class="text-danger">
                  <?= __('Cancelled in ') ?>
                  <?= h($registration->cancellation_date) ?>
                </span>
              <?php endif; ?>
            </dd>
        <?php endif; ?>
      </dl>

    </div>
    <!-- /.col -->
    <div class="col-sm-6 invoice-col">
      <dl class="dl-horizontal">
        <?php if ($registration->has('student')): ?>
            <dt><?= __('Student') ?>: </dt> 
            <dd><?= h($registration->student->name) ?></dd>
            <dt><?= __('Document1') ?>: </dt> 
            <dd><?= h($registration->student->document1) ?></dd>
            <dt><?= __('Document2') ?>: </dt> 
            <dd><?= h($registration->student->document2) ?></dd>
            <dt><?= __('Birthdate') ?>: </dt> 
            <dd><?= h($registration->student->birthdate) ?></dd>
            <dt><?= __('Phone') ?>: </dt> 
            <dd><?= h($registration->student->phone) ?></dd>
            <dt><?= __('Created') ?>: </dt> 
            <dd><?= h($registration->created) ?></dd>
            <dt><?= __('Modified') ?>:</dt> 
            <dd><?= h($registration->modified) ?></dd>
        <?php endif; ?>
      </dl>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <?php if (!empty($registration->registration_payments)): ?>
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <p class="lead"><?= __('Related Payments') ?></p>
        <table class="table table-striped" cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Number') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Due Date') ?></th>
                <th><?= __('Payment Date') ?></th>
                <th><?= __('Amount') ?></th>
                <th><?= __('Status') ?></th>
            </tr>
            <?php foreach ($registration->registration_payments as $payment): ?>
            <tr>
                <td><?= ($payment->number == 0) ? __('Registration') : $payment->number ?></td>
                <td><?= h($payment->date) ?></td>
                <td><?= h($payment->due_date) ?></td>
                <td><?= h($payment->payment_date) ?></td>
                <td><?= $this->Number->currency($payment->amount) ?></td>
                <td>
                    <?php if ($payment->status == 0): ?>
                        <?php if ($registration->active): ?>
                          <?= $this->Html->link(__('<i class="fa fa-dollar" aria-hidden="true"></i>' .  ' ' . __('Pay')), ['controller' => 'RegistrationPayments', 'action' => 'pay', $payment->id], ['escape' => false, 'title' => __('Pay')]) ?>
                        <?php else: ?>
                          <span class="text-danger">
                            <?= __('Cancelled in ') ?>
                            <?= h($registration->cancellation_date) ?>
                          </span>
                        <?php endif; ?>

                    <?php else: ?>
                        <span class="text-green"><?= __('Already Paid') ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
      </div>
    </div>
  <?php else: ?>
    <?php if ($registration->active): ?>
    <div class="row">
      <div class="col-xs-12 text-center">
          <?= $this->Form->postLink(__('Generate Payments'), ['controller' => 'Registrations', 'action' => 'generatePayments', $registration->id], ['confirm' => __('Are you sure you want to generate payments?', $registration->id), 'escape' => false, 'title' => __('Generate Payments'), 'class' => 'btn btn-success']) ?>
      </div>
    </div>
    <?php endif; ?>
  <?php endif; ?>
  <br>

  <?php if ($registration->active): ?>
    <div class="row">
      <div class="col-xs-12 text-center">
          <?= $this->Form->postLink(__('Cancel Registration'), ['action' => 'cancel', $registration->id], ['confirm' => __('Are you sure you want to cancel the registration # {0}?', $registration->id), 'escape' => false, 'title' => __('Delete'), 'class' => 'btn btn-danger']) ?>
      </div>
    </div>
  <?php endif; ?>

  </section>