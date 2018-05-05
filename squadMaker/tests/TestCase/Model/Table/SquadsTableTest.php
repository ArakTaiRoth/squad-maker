<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SquadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SquadsTable Test Case
 */
class SquadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SquadsTable
     */
    public $Squads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.squads',
        'app.players'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Squads') ? [] : ['className' => SquadsTable::class];
        $this->Squads = TableRegistry::get('Squads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Squads);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
