<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistrationPayment[]|\Cake\Collection\CollectionInterface $registrationPayments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Registration Payment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Registrations'), ['controller' => 'Registrations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Registration'), ['controller' => 'Registrations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="registrationPayments index large-9 medium-8 columns content">
    <h3><?= __('Registration Payments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('registration_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_registration_tax') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registrationPayments as $registrationPayment): ?>
            <tr>
                <td><?= $this->Number->format($registrationPayment->id) ?></td>
                <td><?= $registrationPayment->has('registration') ? $this->Html->link($registrationPayment->registration->id, ['controller' => 'Registrations', 'action' => 'view', $registrationPayment->registration->id]) : '' ?></td>
                <td><?= h($registrationPayment->date) ?></td>
                <td><?= $this->Number->format($registrationPayment->amount) ?></td>
                <td><?= h($registrationPayment->status) ?></td>
                <td><?= h($registrationPayment->is_registration_tax) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $registrationPayment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $registrationPayment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $registrationPayment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registrationPayment->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
