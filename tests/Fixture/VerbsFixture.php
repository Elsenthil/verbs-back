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
                'infinitive' => 'be',
                'preterit' => 'was/were',
                'past_participle' => 'been',
                'translation' => 'être',
                'created' => '2024-07-18 09:39:31',
                'modified' => '2024-07-18 09:39:31',
            ],
        ];
        parent::init();
    }
}
