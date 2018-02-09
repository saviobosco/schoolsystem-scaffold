<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 2/7/18
 * Time: 11:25 PM
 */

namespace Saviobosco\Core\Updater;

use Cake\Console\Shell;
use Cake\Filesystem\Folder;
use Migrations\Migrations;

/**
 * Class AppUpdater
 * @package Saviobosco\Core\Updater
 */
class AppUpdater
{
    private $updateSrcPath ;

    private $updateDestinationPath = ROOT;
    public $composerHomeDir;
    public $composerFilename;
    public $composerPath;
    public $migration;
    public $migrationSuccessful;
    /**
     * @param $updateSrcPath
     * @param $updateDestinationPath
     */
    public function __construct($updateSrcPath,$updateDestinationPath = null )
    {
        $this->currentDir = ROOT. DS;
        $this->composerHomeDir = $this->currentDir . '.composer';
        $this->composerFilename = 'composer.phar';
        $this->composerPath = $this->currentDir . $this->composerFilename;

        $this->setUpdateSrcPath($updateSrcPath);

        if ( !is_null($updateDestinationPath)) {
            $this->setUpdateDestinationPath($updateDestinationPath);
        }
        // check if migrations folder exists
        $this->migration = new UpdateMigrations($this->getUpdateSrcPath().DS.'config'.DS);
    }

    public function copyMigrationsAndSeeds()
    {
        if (!$this->migration->copyMigrationFiles()) {
            return false;
        }
        if (!$this->migration->copySeedsFiles()) {
            return false;
        }
        return true;
    }

    public function runMigrations()
    {
        if ($this->migration->migrate()) {
            $this->migrationSuccessful = true; //Todo: review to check if no migration was ran
            return true;
        }
    }

    public function rollBackMigrations()
    {
        if ( $this->migrationSuccessful === true) {
            $this->migration->rollback();
        }
    }

    public function copyAppFiles()
    {
        $folder = new Folder($this->getUpdateSrcPath());
        $status = $folder->copy([
            'to' => $this->getUpdateDestinationPath(),
            'scheme' => Folder::MERGE
        ]);
        if ($status) {
            return true;
        }
        return false;
    }

    public function removeUpdateFile()
    {
        $folder = new Folder($this->getUpdateSrcPath());
        if ($folder->delete()) {
            return true;
        }
    }

    protected function _runComposer($input)
    {
        putenv("OSTYPE=OS400");
        if (!getenv('COMPOSER_HOME')) {
            putenv("COMPOSER_HOME={$this->composerHomeDir}");
        }
        $input = new \Symfony\Component\Console\Input\ArrayInput($input);
        $output = new \Symfony\Component\Console\Output\BufferedOutput();
        $application = new \Composer\Console\Application();
        $application->setAutoExit(true);
        $application->run($input, $output);
        return $output->fetch();
        /*putenv("OSTYPE=OS400");
        if (!getenv('COMPOSER_HOME')) {
            putenv("COMPOSER_HOME={$this->composerHomeDir}");
            echo 'Ran this';
        }

        if (substr($this->composerPath, -5) == '.phar') {
            echo 'Ran this';
            require_once "phar://{$this->composerPath}/src/bootstrap.php";

            $input = new \Symfony\Component\Console\Input\ArrayInput($input);
            $output = new \Symfony\Component\Console\Output\BufferedOutput();
            $application = new \Composer\Console\Application();
            $application->setAutoExit(false);
            $application->run($input, $output);
            dd($application);
            return $output->fetch();
        } else {
            $command = $this->_buildComposerCommand($this->composerPath, $input);
            ob_start();
            // Todo: add the path to php here
            passthru($command);
            return ob_get_clean();
        }*/
    }

    protected function _buildComposerCommand($path, $input)
    {
        $command = [escapeshellcmd($path)];

        foreach ($input as $k => $v) {
            if (substr($k, 0, 2) == '--') {
                $command[] = escapeshellcmd($k . ($v === true ? '' : "={$v}"));
            } elseif (is_array($v)) {
                $command[] = escapeshellcmd(implode(' ', $v));
            } else {
                $command[] = escapeshellcmd($v);
            }
        }

        return implode(' ', $command);
    }

    public function finalizeUpdate()
    {
        $input = [
            'command' => 'dumpautoload',
            '--optimize' => true
        ];
        /*$output = $this->_runComposer($input);
        if (strpos($output, 'Generating autoload files') === false) {
            throw new \Exception("Error : Could not run composer dumpautoload");
        }*/
        // clear the database cache to prevent any error
        $shell = new Shell();
        $shell->dispatchShell('cake','orm_cache','clear');
    }



    /**
     * @return mixed
     */
    public function getUpdateSrcPath()
    {
        return $this->updateSrcPath;
    }

    /**
     * @param mixed $updateSrcPath
     */
    public function setUpdateSrcPath($updateSrcPath)
    {
        $this->updateSrcPath = $updateSrcPath;
    }

    /**
     * @return string
     */
    public function getUpdateDestinationPath()
    {
        return $this->updateDestinationPath;
    }

    /**
     * @param string $updateDestinationPath
     */
    public function setUpdateDestinationPath($updateDestinationPath)
    {
        $this->updateDestinationPath = $updateDestinationPath;
    }

}