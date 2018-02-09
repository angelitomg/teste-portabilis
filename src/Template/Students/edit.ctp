<?php
    $this->Form->templates(
      ['dateWidget' => '{{day}}{{month}}{{year}}']
    );
?>
<?php $this->assign('title', __('Edit Student')); ?>
<div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <!-- form start -->
        <?= $this->Form->create($student) ?>
          <div class="box-body">

            <div class="form-group">
              <?= $this->Form->control('name', ['class' => 'form-control']) ?>
            </div>

            <div class="form-group">
              <label for="birthdate"><?= __('Birthdate') ?></label>
              <?= $this->Form->control('birthdate', ['label' => false, 'minYear' => date('Y') - 100, 'maxYear' => date('Y')]) ?>
            </div>

            <div class="form-group">
              <?= $this->Form->control('document1', ['class' => 'form-control']) ?>
            </div>

            <div class="form-group">
              <?= $this->Form->control('document2', ['class' => 'form-control']) ?>
            </div>

            <div class="form-group">
              <?= $this->Form->control('phone', ['class' => 'form-control']) ?>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
      <!-- /.box -->
    </div>
</div>
<script src="<?= $this->Url->build('/') ?>/js/jquery.mask.js"></script>js
<script>
    $(document).ready(function(){
        $('#document1').mask('000.000.000-00');
        $('#phone').mask('(00) 00000-0000');
    });
</script>