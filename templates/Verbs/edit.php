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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $verb->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $verb->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Verbs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="verbs form content">
            <?= $this->Form->create($verb) ?>
            <fieldset>
                <legend><?= __('Edit Verb') ?></legend>
                <?php
                    echo $this->Form->control('infinitive');
                    echo $this->Form->control('preterit');
                    echo $this->Form->control('past_participle');
                    echo $this->Form->control('translation');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
