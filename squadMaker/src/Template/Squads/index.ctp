<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Squad[]|\Cake\Collection\CollectionInterface $squads
 */
?>
<div class="row">
    <?php foreach ($squads as $squad): ?>
        <div class="col my-2">
            <div class="card">
                <div class="card-header"><?= $squad->name; ?></div>
                <div class="card-body">
                    <table class="squad table table-striped">
                        <thead>
                            <tr>
                                <th>Player Name</th>
                                <th>Shooting</th>
                                <th>Skating</th>
                                <th>Checking</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($squad->players as $player): ?>
                                <tr>
                                    <td><?= $player->firstName . ' ' . $player->lastName; ?></td>
                                    <td><?= $player->shooting; ?></td>
                                    <td><?= $player->skating; ?></td>
                                    <td><?= $player->checking; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Averages:</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
