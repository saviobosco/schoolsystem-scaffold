<?php
namespace Dashboard\Controller;

use Dashboard\Controller\AppController;
use Saviobosco\Core\Updater\AppUpdater;
/**
 * Updater Controller
 *
 */
class UpdaterController extends AppController
{

    public function index()
    {
        if ($this->request->is(['POST'])) {

            if (!extension_loaded('zip')) {
                $this->Flash->error('Please this feature requires the zip extension to work. Install php zip extension and try again');
                return;
            }
            $submittedFile = $this->request->getData('file');

            $submittedFile = pathinfo($submittedFile['name']);

            if ( empty($submittedFile['extension']) OR $submittedFile['extension'] !== 'zip' ) {
                $this->Flash->error('Please the update is a zip file and not '.$submittedFile['extension']);
                return;
            }
            // extracting the files
            $zip = new \ZipArchive();
            if ($zip->open($this->request->getData('file')['tmp_name'] ) === TRUE) {
                $zip->extractTo(TMP);
                $zip->close();
                // read the file from the temp dir

                $updater = new AppUpdater(TMP.$submittedFile['filename']);
                try {
                    /*if ( !$updater->copyMigrationsAndSeeds()) {
                        throw new \Exception('Could not copy migrations and seeds files. Please try again.');
                    }
                    if (!$updater->runMigrations()) {
                        throw new \Exception('Could not run migrations. Please try again.');
                    }*/
                    if ( !$updater->copyAppFiles()) {
                        throw new \Exception('Could not copy files. Please try again.');
                    }
                    //$updater->finalizeUpdate();

                    if ( $updater->removeUpdateFile()) {
                        $this->Flash->success(__('The application has been successfully updated'));
                    }
                } catch ( \Exception $e ) {
                    $this->Flash->error($e->getMessage());
                    //$updater->rollBackMigrations();
                    $updater->removeUpdateFile();
                }
            } else {
                $this->Flash->error(__('The files could not be extracted'));
            }
        }
    }
}
