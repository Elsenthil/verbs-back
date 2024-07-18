<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VerbsFixture
 */
class VerbsFixture extends TestFixture
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
                'infinitive' => 'Lorem ipsum dolor sit amet',
                'preterit' => 'Lorem ipsum dolor sit amet',
                'past_participle' => 'Lorem ipsum dolor sit amet',
                'translation' => 'Lorem ipsum dolor sit amet',
                'created' => '2024-07-18 09:39:31',
                'modified' => '2024-07-18 09:39:31',
            ],
        ];
        parent::init();
    }
}
