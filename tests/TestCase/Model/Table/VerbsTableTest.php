<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VerbsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VerbsTable Test Case
 */
class VerbsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VerbsTable
     */
    protected $Verbs;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Verbs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Verbs') ? [] : ['className' => VerbsTable::class];
        $this->Verbs = $this->getTableLocator()->get('Verbs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Verbs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\VerbsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
