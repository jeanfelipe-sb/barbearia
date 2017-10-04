<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Banner'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="banner form large-9 medium-8 columns content">
    <?= $this->Form->create($banner, array('type' => 'file')) ?>
    <fieldset>
        <legend><?= __('Add Banner') ?></legend>
        <?php
        echo $this->Form->control('nome');
        echo $this->Form->control('descricao');
        echo $this->Form->file('img[]', ['label' => 'Image', 'type' => 'file', 'multiple' => 'false']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
