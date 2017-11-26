<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Client $client
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Client'), ['action' => 'edit', $client->person_no]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Client'), ['action' => 'delete', $client->person_no], ['confirm' => __('Are you sure you want to delete # {0}?', $client->person_no)]) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clients view large-9 medium-8 columns content">
    <h3><?= h($client->person_no) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name Initial') ?></th>
            <td><?= h($client->name_initial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Img Name') ?></th>
            <td><?= h($client->img_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Person No') ?></th>
            <td><?= $this->Number->format($client->person_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Press Return') ?></th>
            <td><?= $this->Number->format($client->press_return) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Del Flg') ?></th>
            <td><?= $client->del_flg ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
