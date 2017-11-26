<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Client[]|\Cake\Collection\CollectionInterface $clients
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Client'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clients index large-9 medium-8 columns content">
    <h3><?= __('Clients') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('person_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name_initial') ?></th>
                <th scope="col"><?= $this->Paginator->sort('press_return') ?></th>
                <th scope="col"><?= $this->Paginator->sort('img_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('del_flg') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
            <tr>
                <td><?= $this->Number->format($client->person_no) ?></td>
                <td><?= h($client->name_initial) ?></td>
                <td><?= $this->Number->format($client->press_return) ?></td>
                <td><?= h($client->img_name) ?></td>
                <td><?= h($client->del_flg) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $client->person_no]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $client->person_no]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $client->person_no], ['confirm' => __('Are you sure you want to delete # {0}?', $client->person_no)]) ?>
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
