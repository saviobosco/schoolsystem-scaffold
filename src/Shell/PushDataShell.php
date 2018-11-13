<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Http\Client;

/**
 * PushData shell command.
 * @property \StudentsManager\Model\Table\StudentsTable $Students
 */
class PushDataShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->out($this->OptionParser->help());
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('StudentsManager.Students');
    }

    public function sync()
    {
        $students = $this->Students
            ->find()
            ->toArray();

        $http = new Client();
        foreach($students as $student) {
            $student->hiddenProperties(['created', 'modified']);
            $response = $http->post('http://localhost:3000/api/student',
                json_encode($student),
                ['type' => 'json']
            );
            debug($response->body());
        }
    }
}
