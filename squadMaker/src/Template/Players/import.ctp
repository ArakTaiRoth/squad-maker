<div class="container col-6 float-left">
    <div class="card">
        <div class="card-header">Import via File</div>
        <div class="card-body">
            <?php
                $this->Form->setTemplates($formTemplates['file']);

                echo $this->Form->create(false, [
                    'type' => 'file'
                ]);

                echo $this->Form->control('playerFile', [
                    'label' => __('Player File'),
                    'type' => 'file'
                ]);

                echo $this->Form->button('Import', [
                    'type' => 'submit'
                ]);

                echo $this->Form->end();
            ?>
        </div>
    </div>

    <div class="card my-4">
        <div class="card-header">Import via API</div>
        <div class="card-body">
            <?php
                $this->Form->setTemplates($formTemplates['default']);
                echo $this->Form->create(false);

                echo $this->Form->control('api', [
                    'type' => 'hidden',
                    'value' => true
                ]);

                echo $this->Form->button('Import', [
                    'type' => 'submit'
                ]);
            ?>
        </div>
    </div>
</div>
