<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Player $player
 */
?>
<div class="container col-6 float-left">
    <div class="card">
        <div class="card-header">Edit Player</div>
        <div class="card-body">
            <?php
                $this->Form->setTemplates($formTemplates['default']);

                echo $this->Form->create($player);

                echo $this->Form->control('firstName');
                echo $this->Form->control('lastName');
                echo $this->Form->control('shooting');
                echo $this->Form->control('skating');
                echo $this->Form->control('checking');

                echo $this->Form->button('Add Player');

                echo $this->Form->end();
            ?>
        </div>
    </div>
</div>
