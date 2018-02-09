<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Registration $registration
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Registration'), ['action' => 'edit', $registration->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Registration'), ['action' => 'delete', $registration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registration->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Registrations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Registration'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Registration Payments'), ['controller' => 'RegistrationPayments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Registration Payment'), ['controller' => 'RegistrationPayments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="registrations view large-9 medium-8 columns content">
    <h3><?= h($registration->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $registration->has('student') ? $this->Html->link($registration->student->name, ['controller' => 'Students', 'action' => 'view', $registration->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Course') ?></th>
            <td><?= $registration->has('course') ? $this->Html->link($registration->course->name, ['controller' => 'Courses', 'action' => 'view', $registration->course->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Year') ?></th>
            <td><?= h($registration->year) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($registration->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($registration->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($registration->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $registration->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Registration Payments') ?></h4>
        <?php if (!empty($registration->registration_payments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Registration Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Is Registration Tax') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($registration->registration_payments as $registrationPayments): ?>
            <tr>
                <td><?= h($registrationPayments->id) ?></td>
                <td><?= h($registrationPayments->registration_id) ?></td>
                <td><?= h($registrationPayments->date) ?></td>
                <td><?= h($registrationPayments->amount) ?></td>
                <td><?= h($registrationPayments->status) ?></td>
                <td><?= h($registrationPayments->is_registration_tax) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RegistrationPayments', 'action' => 'view', $registrationPayments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RegistrationPayments', 'action' => 'edit', $registrationPayments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RegistrationPayments', 'action' => 'delete', $registrationPayments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registrationPayments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
