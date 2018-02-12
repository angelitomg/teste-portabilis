<?php

    $params = $this->request->query;
    $values['course_id'] = (isset($params['course_id'])) ? $params['course_id'] : '';
    $values['student_id'] = (isset($params['student_id'])) ? $params['student_id'] : '';
    $values['year'] = (isset($params['year'])) ? $params['year'] : '';
    $values['active'] = (isset($params['active'])) ? $params['active'] : 1;
    $values['registration_tax_paid'] = (isset($params['registration_tax_paid'])) ? $params['registration_tax_paid'] : 2;

?>

<?php $this->assign('title', __('Registrations')); ?>
<?php $this->assign('description', __('This section controls all course registrations.')); ?>

<div class="row">

  <div class="col-md-12">    

    <p><?= $this->Html->link(__('New Registration'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?></p>

    <?= $this->Form->create('Registrations', ['type' => 'get']) ?>

    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title"><?= __('Search Registrations') ?></h3>
      </div><!-- /.box-header -->
      <div class="box-body">

        <div class="row">

          <div class="col-xs-6">
            <div class="form-group">
              <?= $this->Form->input('course_id', ['class' => 'form-control', 'options' => $courses, 'empty' => __('All'), 'value' => $values['course_id']]) ?>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group">
              <?= $this->Form->input('student_id', ['class' => 'form-control', 'options' => $students, 'empty' => __('All'),  'value' => $values['student_id']]) ?>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-xs-4">
            <div class="form-group">
              <?= $this->Form->input('year', ['class' => 'form-control', 'min' => 2000, 'max' => 2100, 'type' => 'number', 'value' => $values['year']]) ?>
            </div>
          </div>

          <div class="col-xs-4">
            <div class="form-group">
              <?= $this->Form->input('active', ['class' => 'form-control', 'options' => $activeOptions, 'value' => $values['active']]) ?>
            </div>
          </div>
          
          <div class="col-xs-4">
            <div class="form-group">
              <?= $this->Form->input('registration_tax_paid', ['class' => 'form-control', 'options' => $registrationTaxPaidOptions, 'value' => $values['registration_tax_paid']]) ?>
            </div>
          </div>

        </div>

      </div><!-- /.box-body -->

      <div class="box-footer">
          <?= $this->Form->button(__('Search'), ['class' => 'btn btn-primary']) ?>
      </div>

    </div><!-- /.box -->

    <?= $this->Form->end() ?>

    <div class="box">

        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered" width="100%">
            <tbody><tr>
              <th style="width: 10px"><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('Students.name', __('Student')) ?></th>
              <th><?= $this->Paginator->sort('Courses.name', __('Course')) ?></th>
              <th><?= $this->Paginator->sort('year') ?></th>
              <th><?= $this->Paginator->sort('active') ?></th>
              <th><?= $this->Paginator->sort('registration_tax_paid') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($registrations as $registration): ?>
                <tr>
                    <td><?= $this->Number->format($registration->id) ?></td>
                    <td><?= $registration->has('student') ? $this->Html->link($registration->student->name, ['controller' => 'Students', 'action' => 'view', $registration->student_id]) : '' ?></td>
                    <td><?= $registration->has('course') ? $this->Html->link($registration->course->name, ['controller' => 'Courses', 'action' => 'view', $registration->course_id]) : '' ?></td>
                    <td width="10%"><?= h($registration->year) ?></td>
                    <td width="10%"><?= ($registration->active) ? __('Yes') : __('No') ?></td>
                    <td width="10%"><?= ($registration->registration_tax_paid) ? __('Yes') : __('No') ?></td>
                    <td width="10%" class="actions">
                        <?= $this->Html->link(__('<i class="fa fa-arrow-right" aria-hidden="true"></i>'), ['action' => 'view', $registration->id], ['escape' => false, 'title' => __('View')]) ?>
                        <?= $this->Form->postLink(__('<i class="fa fa-remove" aria-hidden="true"></i>'), ['action' => 'delete', $registration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registration->id), 'escape' => false, 'title' => __('Delete')]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <li><?= $this->Paginator->prev('< ' . __('previous')) ?></li>
            <li><?= $this->Paginator->numbers() ?></li>
            <li><?= $this->Paginator->next(__('next') . ' >') ?></li>
          </ul>
        </div>
    </div>

  </div>

</div>