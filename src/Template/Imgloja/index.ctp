<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Imgloja'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="imgloja index large-9 medium-8 columns content">
    <h3><?= __('Imgloja') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descricao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('img') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($imgloja as $imgloja): ?>
                <tr>
                    <td><?= $this->Number->format($imgloja->id) ?></td>
                    <td><?= h($imgloja->nome) ?></td>
                    <td><?= h($imgloja->descricao) ?></td>
                    <td><?php echo $this->Html->image($imgloja->img, array('class' => 'img')); ?></td>                <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $imgloja->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $imgloja->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $imgloja->id], ['confirm' => __('Are you sure you want to delete # {0}?', $imgloja->id)]) ?>
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
