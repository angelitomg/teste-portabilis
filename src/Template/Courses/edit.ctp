<?php $this->assign('title', __('Edit Course')); ?>
<div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <!-- form start -->
        <?= $this->Form->create($course) ?>
          <div class="box-body">

            <div class="form-group">
              <?= $this->Form->control('name', ['class' => 'form-control']) ?>
            </div>

            <div class="form-group">
              <?= $this->Form->control('monthly_amount', ['class' => 'form-control']) ?>
            </div>

            <div class="form-group">
              <?= $this->Form->control('registration_tax', ['class' => 'form-control']) ?>
            </div>

            <div class="form-group">
              <?= $this->Form->control('period', ['class' => 'form-control', 'options' => $course->getPeriodsList()]) ?>
            </div>

            <div class="form-group">
              <?= $this->Form->control('duration', ['class' => 'form-control']) ?>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'save-button']) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
      <!-- /.box -->
    </div>
</div>