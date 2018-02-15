<?php use Cake\I18n\I18n; ?>
<?php $this->assign('title', __('Add Registration')); ?>
<div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <!-- form start -->
        <?= $this->Form->create($registration) ?>
          <div class="box-body">

            <div class="form-group">
              <?= $this->Form->control('student_name', ['class' => 'form-control']) ?>
              <?= $this->Form->unlockField('student_id') ?>
              <?= $this->Form->control('student_id', ['type' => 'hidden']) ?>
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
<link rel="stylesheet" href="<?= $this->Url->build('/') ?>/adminlte/bower_components/jquery-ui/themes/base/jquery-ui.css">
<script src="<?= $this->Url->build('/') ?>/js/jquery-migrate-3.0.0.min.js"></script>
<script src="<?= $this->Url->build('/') ?>/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $( function() {
    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
    }
 
    $( "#student-name" ).autocomplete({
      source: "<?= $this->Url->build(['controller' => 'Students', 'action' => 'searchList']) ?>",
      minLength: 3,
      select: function( event, ui ) {
        $('#student-id').val(ui.item.id);
      }
    });
  } );
</script>