<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Verb> $verbs
 */
?>
<div class="verbs index content">
    <div>
        <?= $this->Html->link(__('Add'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    </div>
    <div>
        <?= $this->Form->create(null, ['type' => 'file', 'url' => ['action' => 'import']]); ?>
            <?= $this->Form->control('json', ['type' => 'file']); ?>
            <?= $this->Form->submit('Import',  ['class' => 'button float-right']); ?>
        <?= $this->Form->end(); ?>
    </div>
    
    <h3><?= __('Verbs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('infinitive') ?></th>
                    <th><?= $this->Paginator->sort('preterit') ?></th>
                    <th><?= $this->Paginator->sort('past_participle') ?></th>
                    <th><?= $this->Paginator->sort('translation') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($verbs as $verb): ?>
                <tr>
                    <td><?= $this->Number->format($verb->id) ?></td>
                    <td><?= h($verb->infinitive) ?></td>
                    <td><?= h($verb->preterit) ?></td>
                    <td><?= h($verb->past_participle) ?></td>
                    <td><?= h($verb->translation) ?></td>
                    <td><?= h($verb->created) ?></td>
                    <td><?= h($verb->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $verb->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $verb->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $verb->id], ['confirm' => __('Are you sure you want to delete # {0}?', $verb->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
