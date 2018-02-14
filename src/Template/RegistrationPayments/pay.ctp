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

              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                  <dl class="dl-horizontal">
                    <dt><?= __('Student') ?>: </dt> 
                    <dd><?= h($payment->registration->student->name) ?><dd>
                    <dt><?= __('Course') ?>: </dt> 
                    <dd><?= h($payment->registration->course->name) ?></dd>    
                  </dl>

                </div>
                <!-- /.col -->
                <div class="col-sm-6 invoice-col">
                  <dl class="dl-horizontal">
                    <dt><?= __('Amount') ?>: </dt> 
                    <dd><?= $this->Number->currency($payment->amount) ?></dd>
                    <dt><?= __('Nr') ?>: </dt> 
                    <dd><?= ($payment->number == 0) ? __('Registration') : $payment->number ?></dd>
                  </dl>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            <div class="form-group">
              <label><?= __('Payment Date') ?></label>
              <?= $this->Form->control('payment_date', ['class' => 'form-control', 'label' => false]) ?>
            </div>

            <div class="form-group">
              <?= $this->Form->control('amount_paid', ['class' => 'form-control', 'type' => 'text']) ?>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
          </div>
        <?= $this->Form->end() ?>

        <?php else: ?>

            <div class="box-body">
                <h1 class="text-center"><?= __('Payback') ?></h1>
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
<script src="<?= $this->Url->build('/') ?>/js/jquery.mask.js"></script>
<script>
    $(document).ready(function(){
        $('#amount-paid').mask('000.000.000.000,00',{reverse:true});
    });
</script>