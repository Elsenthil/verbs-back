<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Verbs Model
 *
 * @method \App\Model\Entity\Verb newEmptyEntity()
 * @method \App\Model\Entity\Verb newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Verb> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Verb get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Verb findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Verb patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Verb> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Verb|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Verb saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Verb>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Verb>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Verb>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Verb> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Verb>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Verb>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Verb>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Verb> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VerbsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('verbs');
        $this->setDisplayField('infinitive');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
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
}
