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
                ['action' => 'delete', $imgloja->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $imgloja->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Imgloja'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="imgloja form large-9 medium-8 columns content">
    <?= $this->Form->create($imgloja) ?>
    <fieldset>
        <legend><?= __('Edit Imgloja') ?></legend>
        <?php
            echo $this->Form->control('nome');
            echo $this->Form->control('descricao');
            echo $this->Form->control('img');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
