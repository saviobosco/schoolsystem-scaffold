<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 2/8/18
 * Time: 8:10 AM
 */

namespace Saviobosco\Core\Updater;


use Cake\Filesystem\Folder;
use Migrations\Migrations;

class UpdateMigrations
{
    public $migrationUpdatePath;


    public function __construct($migrationUpdatePath)
    {
        if (is_null($migrationUpdatePath) || empty($migrationUpdatePath)) {
            throw new \Exception('No migration specified.');
        }
        $this->migrationUpdatePath = $migrationUpdatePath;
        $this->migrationDestPath = ROOT.DS.'config'.DS;
        $this->Migration = new Migrations();
    }

    public function copyMigrationFiles()
    {
        $folder = new Folder($this->migrationUpdatePath.'Migrations');
        $files = $folder->find('.*\.php');
        if (is_array($files) && count($files) > 0) {
            $status = $folder->copy([
                'to' => $this->migrationDestPath.'Migrations'.DS,
                'scheme' => Folder::MERGE
            ]);
            if ($status) {
                return true;
            }else {
                return false;
            }
        }
        return true;
    }

    public function copySeedsFiles()
    {
        $folder = new Folder($this->migrationUpdatePath.'Seeds');
        $files = $folder->find('.*\.php');
        if (is_array($files) && count($files) > 0) {
            $status = $folder->copy([
                'to' => $this->migrationDestPath.'Seeds'.DS,
                'scheme' => Folder::MERGE
            ]);
            if ($status) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    public function migrate()
    {
        $this->Migration->migrate();
        return true;
    }

    public function rollback()
    {
        $this->Migration->rollback();
        return true;
    }

    public function seeds()
    {
        $this->Migration->seed();
        return true;
    }

}