<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Test> $tests
 */
?>
<div class="tests index content">
    <?= $this->Html->link(__('New Test'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tests') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('mark') ?></th>
                    <th><?= $this->Paginator->sort('answer_not_done_count') ?></th>
                    <th><?= $this->Paginator->sort('answer_done_count') ?></th>
                    <th><?= $this->Paginator->sort('wrong_answer_count') ?></th>
                    <th><?= $this->Paginator->sort('right_answer_count') ?></th>
                    <th><?= $this->Paginator->sort('answer_count') ?></th>
                    <th><?= $this->Paginator->sort('is_finished') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tests as $test): ?>
                <tr>
                    <td><?= $this->Number->format($test->id) ?></td>
                    <td><?= h($test->name) ?></td>
                    <td><?= $this->Number->format($test->mark) ?></td>
                    <td><?= $this->Number->format($test->answer_not_done_count) ?></td>
                    <td><?= $this->Number->format($test->answer_done_count) ?></td>
                    <td><?= $this->Number->format($test->wrong_answer_count) ?></td>
                    <td><?= $this->Number->format($test->right_answer_count) ?></td>
                    <td><?= $test->answer_count === null ? '' : $this->Number->format($test->answer_count) ?></td>
                    <td><?= h($test->is_finished) ?></td>
                    <td><?= h($test->created) ?></td>
                    <td><?= h($test->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $test->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $test->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $test->id], ['confirm' => __('Are you sure you want to delete # {0}?', $test->id)]) ?>
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
