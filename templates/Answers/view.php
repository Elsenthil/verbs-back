<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Answer $answer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Answer'), ['action' => 'edit', $answer->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Answer'), ['action' => 'delete', $answer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Answers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Answer'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="answers view content">
            <h3><?= h($answer->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Test') ?></th>
                    <td><?= $answer->hasValue('test') ? $this->Html->link($answer->test->name, ['controller' => 'Tests', 'action' => 'view', $answer->test->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Verb') ?></th>
                    <td><?= $answer->hasValue('verb') ? $this->Html->link($answer->verb->infinitive, ['controller' => 'Verbs', 'action' => 'view', $answer->verb->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Infinitive') ?></th>
                    <td><?= h($answer->infinitive) ?></td>
                </tr>
                <tr>
                    <th><?= __('Preterit') ?></th>
                    <td><?= h($answer->preterit) ?></td>
                </tr>
                <tr>
                    <th><?= __('Past Participle') ?></th>
                    <td><?= h($answer->past_participle) ?></td>
                </tr>
                <tr>
                    <th><?= __('Translation') ?></th>
                    <td><?= h($answer->translation) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($answer->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($answer->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($answer->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Infinitive Given') ?></th>
                    <td><?= $answer->infinitive_given ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Preterit Given') ?></th>
                    <td><?= $answer->preterit_given ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Past Participle Given') ?></th>
                    <td><?= $answer->past_participle_given ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Translation Given') ?></th>
                    <td><?= $answer->translation_given ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Done') ?></th>
                    <td><?= $answer->is_done ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Correct') ?></th>
                    <td><?= $answer->is_correct ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
