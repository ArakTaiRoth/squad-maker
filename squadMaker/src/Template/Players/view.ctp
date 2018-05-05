<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Player $player
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Player'), ['action' => 'edit', $player->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Player'), ['action' => 'delete', $player->id], ['confirm' => __('Are you sure you want to delete # {0}?', $player->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Players'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Player'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Squads'), ['controller' => 'Squads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Squad'), ['controller' => 'Squads', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="players view large-9 medium-8 columns content">
    <h3><?= h($player->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('FirstName') ?></th>
            <td><?= h($player->firstName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LastName') ?></th>
            <td><?= h($player->lastName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($player->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shooting') ?></th>
            <td><?= $this->Number->format($player->shooting) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skating') ?></th>
            <td><?= $this->Number->format($player->skating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Checking') ?></th>
            <td><?= $this->Number->format($player->checking) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td><?= $this->Number->format($player->total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($player->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($player->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Squads') ?></h4>
        <?php if (!empty($player->squads)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($player->squads as $squads): ?>
            <tr>
                <td><?= h($squads->id) ?></td>
                <td><?= h($squads->name) ?></td>
                <td><?= h($squads->created) ?></td>
                <td><?= h($squads->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Squads', 'action' => 'view', $squads->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Squads', 'action' => 'edit', $squads->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Squads', 'action' => 'delete', $squads->id], ['confirm' => __('Are you sure you want to delete # {0}?', $squads->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
