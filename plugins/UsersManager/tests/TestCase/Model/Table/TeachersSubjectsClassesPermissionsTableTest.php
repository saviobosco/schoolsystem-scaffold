<?php
namespace UsersManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use UsersManager\Model\Table\TeachersSubjectsClassesPermissionsTable;

/**
 * UsersManager\Model\Table\TeachersSubjectsClassesPermissionsTable Test Case
 */
class TeachersSubjectsClassesPermissionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \UsersManager\Model\Table\TeachersSubjectsClassesPermissionsTable
     */
    public $TeachersSubjectsClassesPermissions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.users_manager.teachers_subjects_classes_permissions',
        'plugin.users_manager.users',
        'plugin.users_manager.classes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TeachersSubjectsClassesPermissions') ? [] : ['className' => TeachersSubjectsClassesPermissionsTable::class];
        $this->TeachersSubjectsClassesPermissions = TableRegistry::get('TeachersSubjectsClassesPermissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TeachersSubjectsClassesPermissions);

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
