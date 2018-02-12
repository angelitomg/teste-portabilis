<?php
    $this->Form->templates(
      ['dateWidget' => '{{day}}{{month}}{{year}}']
    );
?>
<?php $this->assign('title', __('Pay')); ?>
<div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <?php if (empty($payback)): ?>

        <!-- form start -->
        <?= $this->Form->create($payment) ?>
          <div class="box-body">

            <div class="text-center">
                <p><b><?= __('Student') ?>:</b> <?= h($payment->registration->student->name) ?></p>
                <p><b><?= __('Course') ?>:</b>  <?= h($payment->registration->course->name) ?></p>
                <p><b><?= __('Amount') ?>:</b> <?= $this->Number->currency($payment->amount) ?></p>
                <p><b><?= __('Nr') ?>: </b><?= ($payment->number == 0) ? __('Registration') : $payment->number ?></p>
            </div>

            <div class="form-group">
              <label><?= __('Payment Date') ?></label>
              <?= $this->Form->control('payment_date', ['class' => 'form-control', 'label' => false]) ?>
            </div>

            <div class="form-group">
              <?= $this->Form->control('amount_paid', ['class' => 'form-control']) ?>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
          </div>
        <?= $this->Form->end() ?>

        <?php else: ?>

            <div class="box-body">
                <h1><?= __('Payback') ?></h1>
                <div class="text-center">
                <?php foreach ($payback as $amount => $total): ?>
                    <p><b><?= $this->Number->currency($amount) ?>:</b> <?= $total ?></p>
                <?php endforeach; ?>
                </div>
                <div class="text-center">
                    <?= $this->Html->link(__('Finish'), ['controller' => 'Registrations', 'action' => 'index'], ['class' => 'btn btn-success']); ?>
                </div>
            </div>

        <?php endif; ?>

      </div>
      <!-- /.box -->
    </div>
</div>
