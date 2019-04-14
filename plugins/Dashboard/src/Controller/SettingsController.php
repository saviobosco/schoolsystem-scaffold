<?php
namespace Dashboard\Controller;

use Cake\ORM\TableRegistry;
use Dashboard\Controller\AppController;
use Cake\Core\Configure;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Settings\Core\Setting;
/**
 * Settings Controller
 *
 * @property \Settings\Model\Table\ConfigurationsTable $Configurations
 */
class SettingsController extends AppController
{
    public function index()
    {
        //Setting::write('Application.school_motto', '');
        $this->loadModel('Settings.Configurations');
        $this->prefixes = Configure::read('Settings.Prefixes');
        $key = 'Application';
        $settings = $this->Configurations->find('all')->where([
            'name LIKE' => $key . '%',
            'editable' => 1,
        ])->order(['weight', 'id']);
        $SessionsTable = TableRegistry::get('ResultSystem.Sessions');
        $sessions = $SessionsTable->query()->find('list');
        $TermsTable = TableRegistry::get('ResultSystem.Terms');
        $terms = $TermsTable->query()->find('list');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $settings = $this->Configurations->patchEntities($settings, $this->request->data);
            foreach ($settings as $setting) {
                //$this->Flash->success('The settings has been saved.');
                if (!$this->Configurations->save($setting)) {
                    $this->Flash->error('The settings could not be saved. Please, try again.');
                }
            }
            $this->Flash->success('The settings has been saved.');
            Setting::clear(true);
            Setting::autoLoad();
            //return $this->redirect([]);
        }
        $this->set(compact('prefix', 'settings', 'sessions', 'terms'));

    }

    public function uploadBannerImage()
    {
        $dir = new Folder(WWW_ROOT.'img');
        $file = $dir->find('image-banner.png', true);
        if ( $this->request->is(['patch', 'post', 'put'])) {
            try {
                // check if upload
                //debug($this->request->data); exit;
                if (empty($this->request->getData('banner')['name'])) {
                    $this->Flash->error(__('No file selected.'));
                    return $this->redirect($this->request->referer());
                }
                $imageDetails = pathinfo($this->request->getData('banner')['name']);

                if ($imageDetails['extension'] !== 'png') {
                    $this->Flash->error(__('Image must be a .png file .'));
                    return $this->redirect($this->request->referer());
                }
                // check if folder is writable
                $file = new File(WWW_ROOT.'img/image-banner.png');
                if ( $file->exists() ) {
                    $file->delete();
                }
                if ( move_uploaded_file($this->request->getData('banner')['tmp_name'], WWW_ROOT.'img/image-banner.png') ) {
                    $this->Flash->success(__('File was successfully uploaded'));
                } else {
                    $this->Flash->error(__('An Error occurred uploading this image. Please try again.'));
                }
            } catch (\Exception $e ) {
                $this->Flash->success(__('An Error occurred uploading this image. Please try again.'));
            }
            return $this->redirect($this->referer());
        }
        $this->set(compact('file'));
    }

    public function uploadSchoolLogo()
    {
        $dir = new Folder(WWW_ROOT.'img');
        $file = $dir->find('school-logo.png', true);
        if ( $this->request->is(['patch', 'post', 'put'])) {
            try {
                // check if upload
                //debug($this->request->data); exit;
                if (empty($this->request->getData('logo')['name'])) {
                    $this->Flash->error(__('No file selected.'));
                    return $this->redirect($this->request->referer());
                }
                $imageDetails = pathinfo($this->request->getData('logo')['name']);

                if ($imageDetails['extension'] !== 'png') {
                    $this->Flash->error(__('Image must be a .png file .'));
                    return $this->redirect($this->request->referer());
                }
                // check if folder is writable
                $file = new File(WWW_ROOT.'img/school-logo.png');
                if ( $file->exists() ) {
                    $file->delete();
                }
                if ( move_uploaded_file($this->request->getData('logo')['tmp_name'], WWW_ROOT.'img/school-logo.png') ) {
                    $this->Flash->success(__('File was successfully uploaded'));
                } else {
                    $this->Flash->error(__('An Error occurred uploading this image. Please try again.'));
                }
            } catch (\Exception $e ) {
                $this->Flash->success(__('An Error occurred uploading this image. Please try again.'));
            }
            return $this->redirect($this->referer());
        }
        $this->set(compact('file'));
    }
}

