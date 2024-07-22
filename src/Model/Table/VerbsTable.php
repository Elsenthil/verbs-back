<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class VerbsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('verbs');
        $this->setDisplayField('infinitive');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('infinitive')
            ->maxLength('infinitive', 50)
            ->requirePresence('infinitive', 'create')
            ->notEmptyString('infinitive');

        $validator
            ->scalar('preterit')
            ->maxLength('preterit', 50)
            ->requirePresence('preterit', 'create')
            ->notEmptyString('preterit');

        $validator
            ->scalar('past_participle')
            ->maxLength('past_participle', 50)
            ->requirePresence('past_participle', 'create')
            ->notEmptyString('past_participle');

        $validator
            ->scalar('translation')
            ->maxLength('translation', 50)
            ->requirePresence('translation', 'create')
            ->notEmptyString('translation');

        return $validator;
    }

    public function getRandomVerbs($limit = 5)
    {
        return $this->find()
            ->order('RAND()')
            ->limit($limit)
            ->all();
    }
}
