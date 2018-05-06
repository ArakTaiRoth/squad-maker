<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Player[]|\Cake\Collection\CollectionInterface $players
 */
?>
<div class="card">
    <div class="card-header">Waiting List</div>
    <div class="card-body">
        <table id="players" class="table table-striped">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Shooting</th>
                    <th>Skating</th>
                    <th>Checking</th>
                    <th>Total</th>
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
                        <td><?= $player->total; ?></td>
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
                    <th>Total</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>