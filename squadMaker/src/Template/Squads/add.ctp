<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Squad $squad
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Squads'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Players'), ['controller' => 'Players', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Player'), ['controller' => 'Players', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="squads form large-9 medium-8 columns content">
    <?= $this->Form->create($squad) ?>
    <fieldset>
        <legend><?= __('Add Squad') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('players._ids', ['options' => $players]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
