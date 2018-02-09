<?php
use Migrations\AbstractSeed;

/**
 * ResultRemarkInputs seed.
 */
class ResultRemarkInputsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'main_value' => 'remark_1',
                'replacement' => 'Form Teacher',
                'output_order' => '1',
                'visibility' => '1',
            ],
            [
                'id' => '2',
                'main_value' => 'remark_2',
                'replacement' => 'Guidiance Counselor',
                'output_order' => '2',
                'visibility' => '1',
            ],
            [
                'id' => '3',
                'main_value' => 'remark_3',
                'replacement' => 'Rector',
                'output_order' => '3',
                'visibility' => '1',
            ],
            [
                'id' => '4',
                'main_value' => 'remark_4',
                'replacement' => '',
                'output_order' => NULL,
                'visibility' => '0',
            ],
            [
                'id' => '5',
                'main_value' => 'remark_5',
                'replacement' => '',
                'output_order' => NULL,
                'visibility' => '0',
            ],
            [
                'id' => '6',
                'main_value' => 'remark_6',
                'replacement' => '',
                'output_order' => NULL,
                'visibility' => '0',
            ],
        ];

        $table = $this->table('result_remark_inputs');
        $table->insert($data)->save();
    }
}
