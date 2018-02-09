<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistrationPayment $registrationPayment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Registration Payment'), ['action' => 'edit', $registrationPayment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Registration Payment'), ['action' => 'delete', $registrationPayment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registrationPayment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Registration Payments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Registration Payment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Registrations'), ['controller' => 'Registrations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Registration'), ['controller' => 'Registrations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="registrationPayments view large-9 medium-8 columns content">
    <h3><?= h($registrationPayment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Registration') ?></th>
            <td><?= $registrationPayment->has('registration') ? $this->Html->link($registrationPayment->registration->id, ['controller' => 'Registrations', 'action' => 'view', $registrationPayment->registration->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($registrationPayment->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($registrationPayment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($registrationPayment->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($registrationPayment->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Registration Tax') ?></th>
            <td><?= $registrationPayment->is_registration_tax ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
