<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Answer> $answers
 */
?>
<div class="answers index content">
    <?= $this->Html->link(__('New Answer'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Answers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('test_id') ?></th>
                    <th><?= $this->Paginator->sort('verb_id') ?></th>
                    <th><?= $this->Paginator->sort('infinitive_given') ?></th>
                    <th><?= $this->Paginator->sort('infinitive') ?></th>
                    <th><?= $this->Paginator->sort('preterit_given') ?></th>
                    <th><?= $this->Paginator->sort('preterit') ?></th>
                    <th><?= $this->Paginator->sort('past_participle_given') ?></th>
                    <th><?= $this->Paginator->sort('past_participle') ?></th>
                    <th><?= $this->Paginator->sort('translation_given') ?></th>
                    <th><?= $this->Paginator->sort('translation') ?></th>
                    <th><?= $this->Paginator->sort('is_done') ?></th>
                    <th><?= $this->Paginator->sort('is_correct') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($answers as $answer): ?>
                <tr>
                    <td><?= $this->Number->format($answer->id) ?></td>
                    <td><?= $answer->hasValue('test') ? $this->Html->link($answer->test->name, ['controller' => 'Tests', 'action' => 'view', $answer->test->id]) : '' ?></td>
                    <td><?= $answer->hasValue('verb') ? $this->Html->link($answer->verb->infinitive, ['controller' => 'Verbs', 'action' => 'view', $answer->verb->id]) : '' ?></td>
                    <td><?= h($answer->infinitive_given) ?></td>
                    <td><?= h($answer->infinitive) ?></td>
                    <td><?= h($answer->preterit_given) ?></td>
                    <td><?= h($answer->preterit) ?></td>
                    <td><?= h($answer->past_participle_given) ?></td>
                    <td><?= h($answer->past_participle) ?></td>
                    <td><?= h($answer->translation_given) ?></td>
                    <td><?= h($answer->translation) ?></td>
                    <td><?= h($answer->is_done) ?></td>
                    <td><?= h($answer->is_correct) ?></td>
                    <td><?= h($answer->created) ?></td>
                    <td><?= h($answer->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $answer->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $answer->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?>
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
