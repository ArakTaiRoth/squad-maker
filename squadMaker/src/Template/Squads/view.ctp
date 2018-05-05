<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Squad $squad
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Squad'), ['action' => 'edit', $squad->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Squad'), ['action' => 'delete', $squad->id], ['confirm' => __('Are you sure you want to delete # {0}?', $squad->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Squads'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Squad'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Players'), ['controller' => 'Players', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Player'), ['controller' => 'Players', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="squads view large-9 medium-8 columns content">
    <h3><?= h($squad->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($squad->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($squad->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($squad->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($squad->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Players') ?></h4>
        <?php if (!empty($squad->players)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('FirstName') ?></th>
                <th scope="col"><?= __('LastName') ?></th>
                <th scope="col"><?= __('Shooting') ?></th>
                <th scope="col"><?= __('Skating') ?></th>
                <th scope="col"><?= __('Checking') ?></th>
                <th scope="col"><?= __('Total') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($squad->players as $players): ?>
            <tr>
                <td><?= h($players->id) ?></td>
                <td><?= h($players->firstName) ?></td>
                <td><?= h($players->lastName) ?></td>
                <td><?= h($players->shooting) ?></td>
                <td><?= h($players->skating) ?></td>
                <td><?= h($players->checking) ?></td>
                <td><?= h($players->total) ?></td>
                <td><?= h($players->created) ?></td>
                <td><?= h($players->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Players', 'action' => 'view', $players->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Players', 'action' => 'edit', $players->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Players', 'action' => 'delete', $players->id], ['confirm' => __('Are you sure you want to delete # {0}?', $players->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
