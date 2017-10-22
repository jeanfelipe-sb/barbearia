<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Imgservico'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="imgservicos index large-9 medium-8 columns content">
    <h3><?= __('Imgservicos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('img') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descricao') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($imgservicos as $imgservico): ?>
            <tr>
                <td><?= $this->Number->format($imgservico->id) ?></td>
                <td><?= h($imgservico->nome) ?></td>
                <td><?php echo $this->Html->image($imgservico->img, array('class' => 'img')); ?></td>
                <td><?= h($imgservico->descricao) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $imgservico->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $imgservico->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $imgservico->id], ['confirm' => __('Are you sure you want to delete # {0}?', $imgservico->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
