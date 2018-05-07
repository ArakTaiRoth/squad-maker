<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Squad $squad
 */
?>
<div class="container col-6 float-left">
    <div class="card">
        <div class="card-header">Edit Squad</div>
        <div class="card-body">
            <?php
                $this->Form->setTemplates($formTemplates['default']);

                echo $this->Form->create($squad);

                echo $this->Form->control('name');

                echo $this->Form->button('Edit Squad');

                echo $this->Form->end();
            ?>
        </div>
    </div>
</div>
