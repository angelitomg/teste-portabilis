<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RegistrationPaymentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RegistrationPaymentsTable Test Case
 */
class RegistrationPaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RegistrationPaymentsTable
     */
    public $RegistrationPayments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.registration_payments',
        'app.registrations',
        'app.students',
        'app.courses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RegistrationPayments') ? [] : ['className' => RegistrationPaymentsTable::class];
        $this->RegistrationPayments = TableRegistry::get('RegistrationPayments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RegistrationPayments);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
