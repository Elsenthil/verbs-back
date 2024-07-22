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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $test->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $test->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Tests'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tests form content">
            <?= $this->Form->create($test) ?>
            <fieldset>
                <legend><?= __('Edit Test') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('mark');
                    echo $this->Form->control('answer_not_done_count');
                    echo $this->Form->control('answer_done_count');
                    echo $this->Form->control('wrong_answer_count');
                    echo $this->Form->control('right_answer_count');
                    echo $this->Form->control('answer_count');
                    echo $this->Form->control('is_finished');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
