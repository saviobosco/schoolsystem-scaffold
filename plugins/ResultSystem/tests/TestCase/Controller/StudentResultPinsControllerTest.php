<?php
namespace ResultSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\Controller\StudentResultPinsController;

/**
 * ResultSystem\Controller\StudentResultPinsController Test Case
 */
class StudentResultPinsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_result_pins',
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.terms',
    ];

    public function setUp()
    {
        parent::setUp();
        // Set session data
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testing',
                    'role' => 'admin',
                    'super_user' => 1
                    // other keys.
                ]
            ]
        ]);
        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/result-system/student-result-pins/delete/123456');
        $this->assertRedirect();
        $this->assertSession('The student result pin has been deleted.', 'Flash.flash.0.message');
    }

    /**
     * Test generatePin method
     *
     * @return void
     */
    public function testGeneratePin()
    {
        $data = [
            'number_to_generate' => 10,
            'save_to_database' => 1
        ];
        $this->post('/result-system/student-result-pins/generate-pin',$data);
        $this->assertResponseOk();
        $this->assertSession('10 pins were successfully generated', 'Flash.flash.0.message');
    }

    /**
     * Test printPin method
     *
     * @return void
     */
    public function testPrintPin()
    {
        $this->get('/result-system/student-result-pins/print-pin');
        $this->assertResponseOk();
        $this->assertResponseContains('123456');
    }

    /**
     * Test excelFormat method
     *
     * @return void
     */
    /*public function testExcelFormat()
    {
        $this->disableErrorHandlerMiddleware();
        $data = [
            'created' => '2017-07-17'
        ];
        $this->post('/result-system/student-result-pins/excel_format.xlsx',$data);
        $this->assertSession('No pin found', 'Flash.flash.0.message');
        //$this->assertContentType('application');
        //$this->assertHeaderContains('Content-Disposition','attachment; filename="result-system-student-result-pins-excel-format-xlsx.xlsx"');
        //$this->assertFileResponse('result-system-student-result-pins-excel-format-xlsx.xlsx');
    }*/
}
