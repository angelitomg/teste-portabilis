<?php $this->assign('title', __('Add Registration')); ?>
<div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <!-- form start -->
        <?= $this->Form->create($registration) ?>
          <div class="box-body">

            <div class="form-group">
              <?= $this->Form->control('student_id', ['class' => 'form-control', 'options' => $students]) ?>
            </div>

            <div class="form-group">
              <?= $this->Form->control('course_id', ['class' => 'form-control', 'options' => $courses]) ?>
            </div>

            <div class="form-group">
              <?= $this->Form->control('year', ['class' => 'form-control', 'type' => 'number', 'min' => 2000, 'max' => 2100]) ?>
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