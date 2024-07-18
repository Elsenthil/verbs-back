<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Verb $verb
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Verb'), ['action' => 'edit', $verb->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Verb'), ['action' => 'delete', $verb->id], ['confirm' => __('Are you sure you want to delete # {0}?', $verb->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Verbs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Verb'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="verbs view content">
            <h3><?= h($verb->infinitive) ?></h3>
            <table>
                <tr>
                    <th><?= __('Infinitive') ?></th>
                    <td><?= h($verb->infinitive) ?></td>
                </tr>
                <tr>
                    <th><?= __('Preterit') ?></th>
                    <td><?= h($verb->preterit) ?></td>
                </tr>
                <tr>
                    <th><?= __('Past Participle') ?></th>
                    <td><?= h($verb->past_participle) ?></td>
                </tr>
                <tr>
                    <th><?= __('Translation') ?></th>
                    <td><?= h($verb->translation) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($verb->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($verb->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($verb->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
