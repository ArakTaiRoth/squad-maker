<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Player[]|\Cake\Collection\CollectionInterface $players
 */
?>
<?php if (count($players) > 0): ?>
    <div class="card">
        <?php if ($squadCount === 0): ?>
            <div class="card-header">Create Squads</div>
            <div class="card-body">
                <?php
                    $this->Form->setTemplates($formTemplates['default']);

                    echo $this->Form->create(false, [
                        'url' => ['controller' => 'Squads', 'action' => 'add']
                    ]);

                    echo $this->Form->control('squadCount', [
                        'label' => '# of Squads',
                        'type' => 'text'
                    ]);

                    echo $this->Form->button('Create Squads', [
                        'type' => 'submit'
                    ]);

                    echo $this->Form->end();
                ?>
            </div>
        <?php else: ?>
            <div class="card-header">Reset Squads</div>
            <div class="card-body">
                <a href="/squads/reset" class="btn btn-danger"><i class="fas fa-ban mr-2"></i>Reset Squads</a>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
<div class="card my-2">
    <div class="card-header">Waiting List</div>
    <div class="card-body">
        <table id="players" class="table table-striped">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Shooting</th>
                    <th>Skating</th>
                    <th>Checking</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($players as $player): ?>
                    <tr>
                        <td><?= $player->firstName . ' ' . $player->lastName; ?></td>
                        <td><?= $player->shooting; ?></td>
                        <td><?= $player->skating; ?></td>
                        <td><?= $player->checking; ?></td>
                        <td class="text-center"><a href="/players/edit/<?= $player->id; ?>"><i class="fas fa-edit"></i></a></td>
                        <td class="text-center"><a href="/players/delete/<?= $player->id; ?>"><i class="fas fa-ban"></i></a></td>
                    </td>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Full Name</th>
                    <th>Shooting</th>
                    <th>Skating</th>
                    <th>Checking</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
