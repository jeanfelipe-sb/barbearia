<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Imgservico'), ['action' => 'edit', $imgservico->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Imgservico'), ['action' => 'delete', $imgservico->id], ['confirm' => __('Are you sure you want to delete # {0}?', $imgservico->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Imgservicos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Imgservico'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="imgservicos view large-9 medium-8 columns content">
    <h3><?= h($imgservico->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Img') ?></th>
            <td><?= h($imgservico->img) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descricao') ?></th>
            <td><?= h($imgservico->descricao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($imgservico->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= $this->Number->format($imgservico->nome) ?></td>
        </tr>
    </table>
</div>
