<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Answer $answer
 * @var \Cake\Collection\CollectionInterface|string[] $tests
 * @var \Cake\Collection\CollectionInterface|string[] $verbs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Answers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="answers form content">
            <?= $this->Form->create($answer) ?>
            <fieldset>
                <legend><?= __('Add Answer') ?></legend>
                <?php
                    echo $this->Form->control('test_id', ['options' => $tests]);
                    echo $this->Form->control('verb_id', ['options' => $verbs]);
                    echo $this->Form->control('infinitive_given');
                    echo $this->Form->control('infinitive');
                    echo $this->Form->control('preterit_given');
                    echo $this->Form->control('preterit');
                    echo $this->Form->control('past_participle_given');
                    echo $this->Form->control('past_participle');
                    echo $this->Form->control('translation_given');
                    echo $this->Form->control('translation');
                    echo $this->Form->control('is_done');
                    echo $this->Form->control('is_correct');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>