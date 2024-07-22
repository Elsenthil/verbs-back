<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TestsFixture
 */
class TestsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'mark' => 1.5,
                'answer_not_done_count' => 1,
                'answer_done_count' => 1,
                'wrong_answer_count' => 1,
                'right_answer_count' => 1,
                'answer_count' => 1,
                'is_finished' => 1,
                'created' => '2024-07-22 15:14:16',
                'modified' => '2024-07-22 15:14:16',
            ],
        ];
        parent::init();
    }
}
