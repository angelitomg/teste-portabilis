<?php $this->assign('title', __('Courses')); ?>
<?php $this->assign('description', __('This sections allows you to manage all offered courses.')); ?>

<div class="row">

  <div class="col-md-12">    

    <p>
        <?= $this->Html->link(__('New Course'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="box">

        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered">
            <tbody><tr>
              <th style="width: 10px"><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('name') ?></th>
              <th><?= $this->Paginator->sort('monthly_amount') ?></th>
              <th><?= $this->Paginator->sort('registration_tax') ?></th>
              <th><?= $this->Paginator->sort('period') ?></th>
              <th><?= $this->Paginator->sort('duration') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?= $this->Number->format($course->id) ?></td>
                    <td><?= h($course->name) ?></td>
                    <td><?= $this->Number->currency($course->monthly_amount) ?></td>
                    <td><?= $this->Number->currency($course->registration_tax) ?></td>
                    <td><?= $course->getPeriod($course->period) ?></td>
                    <td><?= h($course->duration) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('<i class="fa fa-arrow-right" aria-hidden="true"></i>'), ['action' => 'view', $course->id], ['escape' => false, 'title' => __('View')]) ?>
                        <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i>'), ['action' => 'edit', $course->id], ['escape' => false, 'title' => __('Edit')]) ?>
                        <?= $this->Form->postLink(__('<i class="fa fa-remove" aria-hidden="true"></i>'), ['action' => 'delete', $course->id], ['confirm' => __('Are you sure you want to delete # {0}?', $course->id), 'escape' => false, 'title' => __('Delete')]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
          </tbody></table>
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