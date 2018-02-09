<?php $this->assign('title', __('Students')); ?>
<?php $this->assign('description', __('All students can be managed in this section.')); ?>

<div class="row">

  <div class="col-md-12">    

    <p>
        <?= $this->Html->link(__('New Student'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="box">

        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered">
            <tbody><tr>
              <th style="width: 10px"><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('name') ?></th>
              <th><?= $this->Paginator->sort('birthdate') ?></th>
              <th><?= $this->Paginator->sort('document1') ?></th>
              <th><?= $this->Paginator->sort('document2') ?></th>
              <th><?= $this->Paginator->sort('phone') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $this->Number->format($student->id) ?></td>
                    <td><?= h($student->name) ?></td>
                    <td><?= h($student->birthdate) ?></td>
                    <td><?= h($student->document1) ?></td>
                    <td><?= h($student->document2) ?></td>
                    <td><?= h($student->phone) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('<i class="fa fa-arrow-right" aria-hidden="true"></i>'), ['action' => 'view', $student->id], ['escape' => false, 'title' => __('View')]) ?>
                        <?= $this->Html->link(__('<i class="fa fa-pencil" aria-hidden="true"></i>'), ['action' => 'edit', $student->id], ['escape' => false, 'title' => __('Edit')]) ?>
                        <?= $this->Form->postLink(__('<i class="fa fa-remove" aria-hidden="true"></i>'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id), 'escape' => false, 'title' => __('Delete')]) ?>
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