<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistrationPayment $registrationPayment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Registration Payments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Registrations'), ['controller' => 'Registrations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Registration'), ['controller' => 'Registrations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="registrationPayments form large-9 medium-8 columns content">
    <?= $this->Form->create($registrationPayment) ?>
    <fieldset>
        <legend><?= __('Add Registration Payment') ?></legend>
        <?php
            echo $this->Form->control('registration_id', ['options' => $registrations]);
            echo $this->Form->control('date');
            echo $this->Form->control('amount');
            echo $this->Form->control('status');
            echo $this->Form->control('is_registration_tax');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
