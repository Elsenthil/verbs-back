<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Test $test
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Test'), ['action' => 'edit', $test->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Test'), ['action' => 'delete', $test->id], ['confirm' => __('Are you sure you want to delete # {0}?', $test->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tests'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Test'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tests view content">
            <h3><?= h($test->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($test->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($test->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mark') ?></th>
                    <td><?= $this->Number->format($test->mark) ?></td>
                </tr>
                <tr>
                    <th><?= __('Answer Not Done Count') ?></th>
                    <td><?= $this->Number->format($test->answer_not_done_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Answer Done Count') ?></th>
                    <td><?= $this->Number->format($test->answer_done_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Wrong Answer Count') ?></th>
                    <td><?= $this->Number->format($test->wrong_answer_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Right Answer Count') ?></th>
                    <td><?= $this->Number->format($test->right_answer_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Answer Count') ?></th>
                    <td><?= $test->answer_count === null ? '' : $this->Number->format($test->answer_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($test->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($test->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Finished') ?></th>
                    <td><?= $test->is_finished ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Answers') ?></h4>
                <?php if (!empty($test->answers)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Test Id') ?></th>
                            <th><?= __('Verb Id') ?></th>
                            <th><?= __('Infinitive Given') ?></th>
                            <th><?= __('Infinitive') ?></th>
                            <th><?= __('Preterit Given') ?></th>
                            <th><?= __('Preterit') ?></th>
                            <th><?= __('Past Participle Given') ?></th>
                            <th><?= __('Past Participle') ?></th>
                            <th><?= __('Translation Given') ?></th>
                            <th><?= __('Translation') ?></th>
                            <th><?= __('Is Done') ?></th>
                            <th><?= __('Is Correct') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($test->answers as $answer) : ?>
                        <tr>
                            <td><?= h($answer->id) ?></td>
                            <td><?= h($answer->test_id) ?></td>
                            <td><?= h($answer->verb_id) ?></td>
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
                                <?= $this->Html->link(__('View'), ['controller' => 'Answers', 'action' => 'view', $answer->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Answers', 'action' => 'edit', $answer->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Answers', 'action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
