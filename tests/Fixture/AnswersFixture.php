<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AnswersFixture
 */
class AnswersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'test_id' => 1,
                'verb_id' => 1,
                'infinitive_given' => 1,
                'infinitive' => 'Lorem ipsum dolor sit amet',
                'preterit_given' => 1,
                'preterit' => 'Lorem ipsum dolor sit amet',
                'past_participle_given' => 1,
                'past_participle' => 'Lorem ipsum dolor sit amet',
                'translation_given' => 1,
                'translation' => 'Lorem ipsum dolor sit amet',
                'is_done' => 1,
                'is_correct' => 1,
                'created' => '2024-07-22 14:35:34',
                'modified' => '2024-07-22 14:35:34',
            ],
        ];
        parent::init();
    }
}
