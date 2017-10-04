<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $imgservico->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $imgservico->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Imgservicos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="imgservicos form large-9 medium-8 columns content">
    <?= $this->Form->create($imgservico) ?>
    <fieldset>
        <legend><?= __('Edit Imgservico') ?></legend>
        <?php
            echo $this->Form->control('nome');
            echo $this->Form->control('descricao');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
