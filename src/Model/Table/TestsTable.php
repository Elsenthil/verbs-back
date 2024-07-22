<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tests Model
 *
 * @property \App\Model\Table\AnswersTable&\Cake\ORM\Association\HasMany $Answers
 *
 * @method \App\Model\Entity\Test newEmptyEntity()
 * @method \App\Model\Entity\Test newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Test> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Test get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Test findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Test patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Test> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Test|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Test saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Test>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Test>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Test>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Test> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Test>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Test>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Test>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Test> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TestsTable extends Table
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

        $this->setTable('tests');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Answers', [
            'foreignKey' => 'test_id',
        ]);
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->decimal('mark')
            ->notEmptyString('mark');

        $validator
            ->integer('answer_not_done_count')
            ->requirePresence('answer_not_done_count', 'create')
            ->notEmptyString('answer_not_done_count');

        $validator
            ->integer('answer_done_count')
            ->requirePresence('answer_done_count', 'create')
            ->notEmptyString('answer_done_count');

        $validator
            ->integer('wrong_answer_count')
            ->requirePresence('wrong_answer_count', 'create')
            ->notEmptyString('wrong_answer_count');

        $validator
            ->integer('right_answer_count')
            ->requirePresence('right_answer_count', 'create')
            ->notEmptyString('right_answer_count');

        $validator
            ->integer('answer_count')
            ->allowEmptyString('answer_count');

        $validator
            ->boolean('is_finished')
            ->notEmptyString('is_finished');

        return $validator;
    }
}
