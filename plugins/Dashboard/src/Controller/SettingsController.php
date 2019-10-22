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
        $selectOptions = []; // Initialised the form select options
        //Setting::write('Application.school_motto', '');
        $this->loadModel('Settings.Configurations');
        $this->prefixes = Configure::read('Settings.Prefixes');
        $key = 'Application';
        $settings = $this->Configurations->find('all')->where([
            'name LIKE' => $key . '%',
            'editable' => 1,
        ])->order(['weight', 'id'])->toArray();
        $sessions = TableRegistry::get('ResultSystem.Sessions')->query()->find('list')->toArray();
        $terms = TableRegistry::get('ResultSystem.Terms')->query()->find('list',['limit' => 3])->toArray();
        foreach ($settings as $setting) {
            if ($setting->type === 'select') {
                $nameArray = explode('.',$setting->name);
                $name = end($nameArray);
                switch($name) {
                    case 'current_session':
                        $selectOptions[$setting->id] = $sessions;
                        break;
                    case 'current_term':
                        $selectOptions[$setting->id] = $terms;
                        break;
                    default: // do nothing
                }
            }
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $settings = $this->Configurations->patchEntities($settings, $this->request->getData());
            if (!$this->Configurations->saveMany($settings)) {
                $this->Flash->error('The settings could not be saved. Please, try again.');
            } else {
                $this->Flash->success('The settings has been saved.');
            }
            Setting::clear(true);
            Setting::autoLoad();
        }
        $this->set(compact('prefix', 'settings', 'sessions', 'terms','selectOptions'));
    }


    public function uploadBannerImage()
    {
        if (!Setting::check('Application.image_banner')) {
            Setting::register('Application.image_banner', '',['editable' => 0]);
        }
        if ( $this->request->is(['patch', 'post', 'put'])) {
            $settingsTable = Setting::model();
            $bannerImage = $settingsTable->findByName('Application.image_banner')->first();
            try {
                // check if upload
                //debug($this->request->data); exit;
                if (empty($this->request->getData('banner')['name'])) {
                    $this->Flash->error(__('No file selected.'));
                    return $this->redirect($this->request->referer());
                }
                $imageDetails = pathinfo($this->request->getData('banner')['name']);
                if ( !in_array($imageDetails['extension'], ['png', 'jpg', 'jpeg'])) {
                    $this->Flash->error(__('banner must be a valid image.'));
                    return $this->redirect($this->request->referer());
                }
                // check if folder is writable
                if ($bannerImage) {
                    $file = new File(WWW_ROOT.'img/schools/'.Configure::read('sub_domain').'/'.$bannerImage['value']);
                    if ( $file->exists() ) {
                        $file->delete();
                    }
                }
                $imageBannerName = 'image-banner.'. $imageDetails['extension'];
                if ( move_uploaded_file($this->request->getData('banner')['tmp_name'], WWW_ROOT.'img/schools/'.Configure::read('sub_domain').'/'.$imageBannerName) ) {
                    if ($bannerImage) {
                        $bannerImage = $settingsTable->patchEntity($bannerImage, ['value' => $imageBannerName]);
                        $settingsTable->save($bannerImage);
                    }
                    $this->Flash->success(__('File was successfully uploaded'));
                } else {
                    $this->Flash->error(__('An Error occurred uploading this image. Please try again.'));
                }
            } catch (\Exception $e ) {
                $this->Flash->success(__('An Error occurred uploading this image. Please try again.'));
            }
            return $this->redirect($this->referer());
        }
    }


    public function uploadSchoolLogo()
    {
        $dir = new Folder(WWW_ROOT.'img/schools/'.Configure::read('sub_domain').'/');
        $file = $dir->find('school-logo.jpg', true);
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
                $file = new File(WWW_ROOT.'img/schools/'. Configure::read('sub_domain').'school-logo.jpg');
                if ( $file->exists() ) {
                    $file->delete();
                }
                if ( move_uploaded_file($this->request->getData('logo')['tmp_name'], WWW_ROOT.'img/schools/'.Configure::read('sub_domain') .'/school-logo.jpg') ) {
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
