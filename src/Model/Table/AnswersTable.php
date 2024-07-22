<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Event\EventInterface;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;

class AnswersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('answers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Tests' => [
                'answer_count',
                'answer_not_done_count' => [
                    'conditions' => ['Answers.is_done' => false]
                ],
                'answer_done_count' => [
                    'conditions' => ['Answers.is_done' => true]
                ],
                'wrong_answer_count' => [
                    'conditions' => ['Answers.is_correct' => false]
                ],
                'right_answer_count' => [
                    'conditions' => ['Answers.is_correct' => true]
                ]
            ]
        ]);

        $this->belongsTo('Tests', [
            'foreignKey' => 'test_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Verbs', [
            'foreignKey' => 'verb_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('test_id')
            ->notEmptyString('test_id');

        $validator
            ->integer('verb_id')
            ->notEmptyString('verb_id');

        $validator
            ->boolean('infinitive_given')
            ->notEmptyString('infinitive_given');

        $validator
            ->scalar('infinitive')
            ->maxLength('infinitive', 50)
            ->allowEmptyString('infinitive');

        $validator
            ->boolean('preterit_given')
            ->notEmptyString('preterit_given');

        $validator
            ->scalar('preterit')
            ->maxLength('preterit', 50)
            ->allowEmptyString('preterit');

        $validator
            ->boolean('past_participle_given')
            ->notEmptyString('past_participle_given');

        $validator
            ->scalar('past_participle')
            ->maxLength('past_participle', 50)
            ->allowEmptyString('past_participle');

        $validator
            ->boolean('translation_given')
            ->notEmptyString('translation_given');

        $validator
            ->scalar('translation')
            ->maxLength('translation', 50)
            ->allowEmptyString('translation');

        $validator
            ->boolean('is_done')
            ->notEmptyString('is_done');

        $validator
            ->boolean('is_correct')
            ->notEmptyString('is_correct');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['test_id'], 'Tests'), ['errorField' => 'test_id']);
        $rules->add($rules->existsIn(['verb_id'], 'Verbs'), ['errorField' => 'verb_id']);

        return $rules;
    }

    public function afterSave(EventInterface $event, $entity, ArrayObject $options)
    {
        if (!$entity->isNew()) {
            // Vérifier si toutes les réponses associées au test sont marquées comme `is_done`
            $countNotDone = $this->find()
                ->where(['test_id' => $entity->test_id, 'is_done' => false])
                ->count();

            if ($countNotDone == 0) {
                // Si toutes les réponses sont marquées comme `is_done`, mettre à jour le test parent
                $test = $this->Tests->get($entity->test_id);
                $test->is_finished = true;
                $this->Tests->save($test);
            }
        }
    }
}
